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
function image_transparency_check( $image, $width, $height ) {
    for ($y = 0; $y < $height; $y++) {
        for ($x = 0; $x < $width; $x++) {
            $rgb = imagecolorat($image, $x, $y);
            $colors = imagecolorsforindex($image, $rgb);
            // Alpha value ranges from 0 (opaque) to 127 (fully transparent)
            if ($colors['alpha'] > 0 && $colors['alpha'] < 127) {
                imagedestroy($image);
                return true; // Found a partially or fully transparent pixel
            }
        }
    }
    return false;
}
add_filter( 'pre_move_uploaded_file', 'hsm_image_resize', 20, 3 );
function hsm_image_resize( $move_new_file, $file, $new_file ) {
    $move_new_file = false;
    if ( preg_match( '#^image#', $file['type'] ) ) {
        $widths = array(2048,1536,1024,768,512,256,128);
        preg_match('/^(.*)-?(verse|quote|carousel|reel)?-?(light|dark)?-?(landscape|square|standard|portrait-short|portrait-tall)-?([0-9]+)?-?([0-9]+w)?.([a-z0-9]+)$/U', $new_file, $name_parts);
        if ( $name_parts[6] == '1280w' ) {
            $move_new_file = true;
        }
        $filename = pathinfo( $file['name'], PATHINFO_FILENAME );
        $dirname = pathinfo( $new_file, PATHINFO_DIRNAME );
        $ext = pathinfo( $file['name'], PATHINFO_EXTENSION );
        if ( ! is_writable( $dirname ) ) {
            mkdir( $dirname, 0755 );
        }
        switch( $ext ) {
            case 'jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                break;
            case 'png':
                $image = imagecreatefrompng($file['tmp_name']);
                break;
            case 'webp':
                $image = imagecreatefromwebp($file['tmp_name']);
                break;
            case 'avif':
                $image = imagecreatefromavif($file['tmp_name']);
                break;
        }
        $og_width = imagesx( $image );
        $og_height = imagesy( $image );
        if ( image_transparency_check( $image, $og_width, $og_height ) ) {
            $extensions = array( 'png', 'webp' );
        } else {
            $extensions = array( 'jpg', 'avif' );
        }
        foreach ( $widths as $width ) {
            //$new_height = ceil( $height / ( 2048 / $width ) );
            foreach ( $extensions as $extension ) {
                $output_filename = $dirname . "/" . $filename . "-" . $width . "w." . $extension;
                $image = imagescale( $image, $width );
                switch( $extension ) {
                case 'avif':
                    $quality = 70;
                    //imageavif( $image, $output_filename, $quality, 0 );
                    break;
                case 'jpg':
                    $quality = 70;
                    imagejpeg( $image, $output_filename, $quality );
                    break;
                case 'png':
                    $quality = 7;
                    imagepng( $image, $output_filename, $quality );
                    break;
                case 'webp':
                    $quality = 80;
                    imagewebp( $image, $output_filename, $quality );
                    break;
                default:
                    error_log("Only the file extensions avif, jpg, png, and webp are currently supported.");
                    exit;
                }
            }
        }
        imagedestroy( $image );
        if ( $move_new_file == false ) {
            unlink( $file['tmp_name'] );
            $upload['error'] = "The file was sucsessfully upload, resized, and deleted.";
        } else {
            switch( $ext ) {
            case 'jpg':
                $image = imagecreatefromjpeg($file['tmp_name']);
                $quality = 70;
                $image = imagescale( $image, 1280 );
                imagejpeg( $image, $file['tmp_name'], $quality );
                break;
            case 'png':
                $image = imagecreatefrompng($file['tmp_name']);
                $quality = 7;
                $image = imagescale( $image, 1280 );
                imagepng( $image, $file['tmp_name'], $quality );
                break;
            }
            $move_new_file = null;
        }
    }
    return $move_new_file;
}