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
    if ( $name_parts[4] == 'landscape' ) {
        $name = pathinfo( $name, PATHINFO_FILENAME ) . "-1280w" . $ext;
    }
    $unique_name = "$name_parts[1]/$name";
    return $unique_name;
}
add_filter( 'pre_move_uploaded_file', 'hsm_image_resize', 10, 4 );
function hsm_image_resize( $move_new_file, $file, $new_file, $type ) {
    $move_new_file = false;
    if ( ! is_writable( dirname( $new_file ) ) ) {
        mkdir( dirname( $new_file ), 0755 );
    }
    if ( preg_match( '#^image#', $file['type'] ) ) {
        $sizes = array(128, 256, 512, 768, 1024, 1536, 2048);
        $filename = pathinfo( $file['name'], PATHINFO_FILENAME );
        $dirname = pathinfo( $new_file, PATHINFO_DIRNAME );
        $image = new Imagick($file['tmp_name']);
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
                $image->scaleImage( $size, $size, true );
                $image->stripImage();
                $image->writeImage( $output_filename );
            }
            if ( preg_match('/^.*-1280w.[a-z0-9]+$/', $new_file ) && $extension == 'jpg' || $extension == 'png' ) {
                $output_filename = $new_file;
                $image->scaleImage( 1280, 720, true );
                $image->stripImage();
                $image->writeImage( $output_filename );
                //$move_new_file = null;
            }
        }
        $image->clear();
        if ( ! $move_new_file ) {
            unlink( $file['tmp_name'] );
        }
        return $move_new_file;
    } else {
        return null;
    }
}