<?php
var_dump($_FILES);
var_dump($_POST);

if(!empty($_FILES) && array_key_exists('file', $_FILES) && !empty($_FILES['file']['name'])) {
    echo "true";
} else {
    echo "false";
}
