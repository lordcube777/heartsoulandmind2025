<?php
add_filter( 'wp_handle_upload_overrides', 'upload_overrides', 10 , 2 );
function upload_overrides( $overrides, $file ) {
    if ( preg_match( '#^image#', $file['type'] ) ) {
        $overrides['unique_filename_callback'] = 'image_filename_override';
        return $overrides;
    }
}
function image_filename_override( $dir, $name, $ext ) {
    preg_match('/^(.*)-?(verse|quote|carousel|reel)?-?(light|dark)?-?(landscape|square|standard|portrait-short|portrait-tall)-?([0-9]+)?-?([0-9]+w)?.([a-z0-9]+)$/U', $name, $name_parts);
    if ( $name_parts[4] == 'landscape' ) {
        $name = pathinfo( $name, PATHINFO_FILENAME ) . "-1280w" . $ext;
    }
    $new_dir = $name_parts[1];
    if ( is_writable( $dir . "/" . $new_dir ) ) {
        return $new_dir . "/" . wp_unique_filename( $dir . "/" . $new_dir, $name );
    } else {
        return $new_dir . "/" . $name;
    }
}
add_filter( 'pre_move_uploaded_file', 'hsm_image_resize', 20, 3 );
function hsm_image_resize( $move_new_file, $file, $new_file ) {
    $move_new_file = false;
    if ( preg_match( '#^image#', $file['type'] ) ) {
        $widths = array(2048,1536,1024,768,512,256,128);
        preg_match('/^(.*)-?(verse|quote|carousel|reel)?-?(light|dark)?-?(landscape|square|standard|portrait-short|portrait-tall)-?([0-9]+)?-?([0-9]+w)?.([a-z0-9]+)$/U', $new_file, $name_parts);
        $filename = pathinfo( $file['name'], PATHINFO_FILENAME );
        $dirname = pathinfo( $new_file, PATHINFO_DIRNAME );
        if ( ! is_writable( $dirname ) ) {
            mkdir( $dirname, 0755 );
        }
        $image = new Imagick($file['tmp_name']);
        $height = $image->getImageHeight();
        if ( $image->getImageAlphaChannel() ) {
            $extensions = array( 'png', 'webp' );
        } else {
            $extensions = array( 'jpg', 'avif' );
        }
        foreach ( $widths as $width ) {
            $new_height = ceil( $height / ( 2048 / $width ) );
            foreach ( $extensions as $extension ) {
                switch( $extension ) {
                case 'avif':
                    $image->setImageCompressionQuality(70);
                    break;
                case 'jpg':
                    $image->setImageCompressionQuality(70);
                    break;
                case 'png':
                    $image->setImageCompressionQuality(7);
                    break;
                case 'webp':
                    $image->setImageCompressionQuality(90);
                    break;
                default:
                    error_log("Only the file extensions avif, jpg, png, and webp are currently supported.");
                    exit;
                }
                if ( $name_parts[6] == '1280w' && $width == 1024 && $extension == 'jpg' || $extension == 'png' ) {
                    error_log( "creating the featured image." );
                    $output_filename = $new_file;
                    $move_new_file = null;
                    $image->scaleImage( 1280, 720, true );
                    $image->stripImage();
                    $image->writeImage( $output_filename );
                }
                $output_filename = $dirname . "/" . $filename . "-" . $width . "w." . $extension;
                $image->scaleImage( $width, $new_height );
                $image->stripImage();
                $image->writeImage( $output_filename );
            }
        }
        $image->clear();
        if ( $move_new_file == false ) {
            unlink( $file['tmp_name'] );
            $upload['error'] = "The file was sucsessfully upload, resized, and deleted.";
        }
    }
    return $move_new_file;
}