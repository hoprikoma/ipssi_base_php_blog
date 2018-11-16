<?php
$id=uniqid();
$target_dir = "../ressources".DIRECTORY_SEPARATOR.$article.DIRECTORY_SEPARATOR;
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0700);
}
$new_name = explode(".",$_FILES["fileUpload"]["name"]);
$new_name = array_reverse($new_name);
$ext = $new_name[0];
$target_file = $target_dir . $id.".".$ext;
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$check = getimagesize($_FILES["fileUpload"]["tmp_name"]);
if($check !== false) {
    echo "Le fichier est une image - " . $check["mime"] . ".". PHP_EOL;
    $uploadOk = 1;
} else {
    echo "Le fichier n'est pas une image.". PHP_EOL;
    $uploadOk = 0;
}
if (file_exists($target_file)) {
    echo "Désolé mais il est déjà la celui la". PHP_EOL;
    $uploadOk = 0;
}
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
echo "Désolé, seulement JPG, JPEG, PNG sont autorisés.". PHP_EOL;
$uploadOk = 0;
}
if ($_FILES["fileUpload"]["size"] > 20000000) {
    echo "Désolé votre fichier est trop volumineux". PHP_EOL;
    $uploadOk = 0;
}
if ($uploadOk == 0) {
    echo "Désolé mais y'a un petit soucis, il faudrait reessayé". PHP_EOL;
} else {
    if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
        echo "Ton fichier : ". basename( $_FILES["fileUpload"]["name"]). " est arrivé a destination.". PHP_EOL;
    } else {
        echo "Désolé, mais y'a une erreur ici ". PHP_EOL;
    }
}