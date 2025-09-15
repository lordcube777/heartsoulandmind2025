<?php
add_filter( 'wp_handle_upload', 'hsm_image_resize', 10, 1 );
function hsm_image_resize( $upload ) {
    $is_image = strpos( $upload['type'], 'image' ) !== false;
    if ( $is_image ) {
        $sizes = array(128, 256, 512, 768, 1024, 1536, 2048);
        $info = pathinfo( $upload['file'] );
        $image = new Imagick($upload['file']);
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
                $output_filename = $info['dirname'] . "/" . $info['filename'] . "-" . $size . "w." . $extension;
                $image->scaleImage( $size, $size, true );
                $image->stripImage();
                $image->writeImage( $output_filename );
            }
        }
        $image->clear();
        return $upload;
    } else {
        return $upload;
    }
}