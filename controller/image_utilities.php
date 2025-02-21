<?php
// Create image handling OOP
Class ImageUtilities{
    // get all image files and returns them in an array for display in a option box
    // this is a change
    public static function GetBaseImageList($dir){
        $image = array();
        foreach(scandir($dir) as $file){
            $ext = pathinfo($file, PATHINFO_EXTENSION);

            if (is_file($dir . $file) && ($ext === 'png' || $ext === 'jpg')) {
                $image[] = $file;
            }
        }
        return $image;
    }
// Resizes image to an max amount and checks image types must be png or jpeg
    public static function ResizeImage($orig, $type, $max){
        $origImage = '';
        if ($type === IMAGETYPE_PNG) {
            $origImage = imagecreatefrompng($orig);
        } elseif ($type === IMAGETYPE_JPEG) {
            $origImage = imagecreatefromjpeg($orig);
        } else {
            return 'Unsupported image type';
        }

        $origWidth = imagesx($origImage);
        $origHeight = imagesy($origImage);

        $ratioWidth = $origWidth / $max;
        $ratioHeight = $origHeight / $max;
        $ratio = max($ratioWidth, $ratioHeight);

        $newWidth = round($origWidth / $ratio);
        $newHeight = round($origHeight / $ratio);

        $exif = exif_read_data($orig);
        if(!empty($exif['Orientation'])) {
        switch($exif['Orientation']) {
        case 8:
            $origImage = imagerotate($origImage,90,0);
            break;
        case 3:
            $origImage = imagerotate($origImage,180,0);
            break;
        case 6:
            $origImage = imagerotate($origImage,-90,0);
            break;
        } 
        }

        $newImg = imagecreatetruecolor($newWidth, $newHeight);

        imagecopyresampled($newImg, $origImage, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        imagedestroy($origImage);
        return $newImg;

    }
// Processes image to create directories if not created, resizes images then puts image in seperate directories then deletes copied image. 
    public static function ProcessImage($file) {
        
        $fInfo = pathinfo($file);
        $file500 = $fInfo['dirname'] . "/" . $fInfo['basename'];

        $imgType = getimagesize($file)[2];
        $newImg500 = self::ResizeImage($file, $imgType, 500);



        switch($imgType){
            case IMAGETYPE_PNG:
                imagepng($newImg500, $file500);

                break;
            case IMAGETYPE_JPEG:
                imagejpeg($newImg500, $file500);


                break;
            default:
                return 'Unsupported image type';
        }

        $result = imagedestroy($newImg500);


    }
// Deletes image out of all directories
    public static function DeleteImageFiles($dir, $base) {
        unlink($dir . $base);
    }


}