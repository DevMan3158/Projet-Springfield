<?php
// verifier qu'on n'a pas deja creer la fonction
if (!function_exists('modifier_images_folder')) {

    /**
     * Pour valider le type du fichier, qui soit bien une image.
     *
     * @param integer $type : le type de format.
     * @return boolean c'est bien une image.
     */
    function type_valide(int $type): bool {
        return ($type == IMAGETYPE_JPEG || $type == IMAGETYPE_PNG || $type == IMAGETYPE_GIF);
    }

    // 
    /**
     * Retourne l'extension du fichier par rapport a son type de format.
     *
     * @param integer $type : le type de format.
     * @return string|null retourne l'extention du fichier.
     */
    function ext_type_image(int $type):?string {
            if( $type == IMAGETYPE_JPEG ) {
                return ".jpg";
            }
            elseif( $type == IMAGETYPE_PNG ) {
                return ".png";
            }
            elseif( $type == IMAGETYPE_GIF ) {
                return ".gif";
            }
            return ".null";
    }
    
    /**
     * sauvegarder une image par rapport a son type de format
     *
     * @param GdImage|null $filename : l'image a sauvegarder
     * @param string|null $new_name : son nouveau nom
     * @param integer $type : le type de format.
     * @return void ne retourne rien
     */
    function save_image($filename, ?string $new_name, int $type): void {
        if ($filename !== FALSE) {
            if( $type == IMAGETYPE_JPEG ) {
                imagejpeg($filename, $new_name);
            }
            elseif( $type == IMAGETYPE_PNG ) {
                imagepng($filename,$new_name);
            }
            elseif( $type == IMAGETYPE_GIF ) {
                imagegif($filename, $new_name);
            }
            imagedestroy($filename);
        }
    }
    
    /**
     * Creation d'une image a partir de son type de format.
     *
     * @param string|null $filename : le nom du fichier
     * @param integer $type : son nouveau nom
     * @return void retourne l'image
     */
    function type_image_create(?string $filename, int $type) {
        if ($filename !== FALSE) {
            if( $type == IMAGETYPE_JPEG ) {
                return imagecreatefromjpeg($filename);
            }
            elseif( $type == IMAGETYPE_PNG ) {
                return imagecreatefrompng($filename);
            }
            elseif( $type == IMAGETYPE_GIF ) {
                return imagecreatefromgif($filename);
            }
            return null;
        }
    }
    
    /**
     * redimension une image 
     *
     * @param string|null $filename le nom de l'image
     * @param integer $width_max : la largeur maximale
     * @param integer $height_max : la hauteur maximale
     * @return void retourne l'image de celui ci
     */
    function image_resize(?string $filename, int $width_max, int $height_max) {
        list($width, $height, $type) = getimagesize($filename);
        $newwidth = $width;
        $newheight = $height;
        $divWidth = $width / $width_max;
        $divHeight = $height / $height_max;

        if($divWidth > $divHeight) {
            $newwidth = $width / $divHeight;
            $newheight = $height / $divHeight;
        } else {
            $newwidth = $width / $divWidth;
            $newheight = $height / $divWidth;
        }

        $position_x = ($newwidth-$width_max)/2;
        if($position_x < 0) {
            $position_x = 0;
        }

        $position_y = ($newheight-$height_max)/2;
        if($position_y < 0) {
            $position_y = 0;
        }
        
        // creation de l'image
        $thumb = imagecreatetruecolor($newwidth, $newheight);
        $source = type_image_create($filename, $type);

        // redimension l'image
        imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
        $thumb_final = imagecrop($thumb, ['x' => $position_x, 'y' => $position_y, 'width' => $width_max, 'height' => $height_max]);

        return $thumb_final;
    }

    /**
     * Modification et sauvegarde de l'image.
     *
     * @param string|null $filename :  le nom de l'image
     * @param string|null $folder_save :  le dossier ou sauvegarder
     * @param string|null $name_file_save : le nom de la sauvegarde
     * @param integer $width_max :  largeur max
     * @param integer $height_max :  hauteur max
     * @return void ne retourne rien
     */
    function modifier_image(?string $filename, ?string $folder_save, ?string $name_file_save, int $width_max, int $height_max):void {
        list($width, $height, $type) = getimagesize($filename);
        if(type_valide($type)) {
            header('Content-Type: '.$type);
            save_image(image_resize($filename, $width_max, $height_max), $folder_save . DIRECTORY_SEPARATOR . $name_file_save, $type);
        //save_image($thumb, $folder_save . DIRECTORY_SEPARATOR . $name_file_save, $type);
        }
    }

    /**
     * Sauvegarder des images a partir d'un dossier
     *
     * @param string|null $file : le dossier avec des images
     * @param string|null $folder_save : ou enregistrer les images modifier (conservent le meme nom).
     * @param integer $width_max :  largeur max
     * @param integer $height_max :  hauteur max
     * @return void ne retourne rien
     */
    function modifier_images_folder(?string $file, ?string $folder_save, int $width_max, int $height_max): void {
        $files1 = scandir($file);

        $result = array();
        foreach ($files1 as $key => $value)
        {
            if (!in_array($value,array(".","..")))
            {
                if (is_file($file . DIRECTORY_SEPARATOR . $value))
                {
                    modifier_image($file . DIRECTORY_SEPARATOR . $value, $value, $folder_save, $width_max, $height_max);
                }
            }
        }
    }

}

