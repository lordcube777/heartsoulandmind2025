<?php
add_filter( 'wp_handle_upload_overrides', 'upload_overrides', 10 , 2 );
function upload_overrides( $overrides, $file ) {
    if ( preg_match( '#^image#', $file['type'] ) ) {
        $overrides['unique_filename_callback'] = 'image_filename_override';
        return $overrides;
    }
}
function image_filename_override( $dir, $name, $ext ) {
    preg_match('/^(.*)-?(verse|quote|carousel|reel)?-?(light|dark)?-?(landscape|square|standard|portrait-short|portrait-tall).[a-z0-9]+$/U', $name, $name_parts);
    // if ( $name_parts[4] == 'landscape' ) {
    //     $name = pathinfo( $name, PATHINFO_FILENAME ) . "-1280w" . $ext;
    // }
    $unique_name = "$name_parts[1]/$name";
    return $unique_name;
}
add_filter( 'pre_move_uploaded_file', 'create_upload_dir', 10, 3 );
function create_upload_dir( $move_new_file, $file, $new_file ) {
    if ( ! is_writable( dirname( $new_file ) ) ) {
        mkdir( dirname( $new_file ), 0755 );
    }
}
add_filter( 'wp_handle_upload', 'hsm_image_resize', 10, 2 );
function hsm_image_resize( $upload, $context ) {
    $featured_image = false;
    if ( preg_match( '#^image#', $upload['type'] ) ) {
        $sizes = array(128, 256, 512, 768, 1024, 1536, 2048);
        $filename = pathinfo( $upload['file'], PATHINFO_FILENAME );
        $dirname = pathinfo( $upload['file'], PATHINFO_DIRNAME );
        $image = new Imagick($upload['file']);
        $height = $image->getImageHeight();
        if ( $image->getImageAlphaChannel() ) {
            $extensions = array( 'png', 'webp' );
        } else {
            $extensions = array( 'jpg', 'avif' );
        }
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
            foreach ( $sizes as $size ) {
                $output_filename = $dirname . "/" . $filename . "-" . $size . "w." . $extension;
                $new_height = ceil( $height / ( 2048 / $size ) );
                $image->scaleImage( $size, $new_height );
                $image->stripImage();
                $image->writeImage( $output_filename );
            }
            preg_match('/^(.*)-?(verse|quote|carousel|reel)?-?(light|dark)?-?(landscape|square|standard|portrait-short|portrait-tall).[a-z0-9]+$/U', $upload['file'], $name_parts);
            if ( $name_parts[4] == 'landscape' && $extension == 'jpg' || $extension == 'png' ) {
                 $output_filename = $dirname . "/" . $filename . "-1280w." . $extension;
                $image->scaleImage( 1280, 720, true );
                $image->stripImage();
                $image->writeImage( $output_filename );
                $featured_image = true;
            }
        }
        $image->clear();
        if ( ! $featured_image ) {
            unlink( $upload['file'] );
            $upload['error'] = "The file was sucsessfully upload, resized, and deleted.";
        }
    }
    return $upload;
}