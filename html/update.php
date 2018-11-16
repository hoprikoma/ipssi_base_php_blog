<?php
session_start();
include('fonct_web.php');
$bdd = connexion();
$article = $_SESSION['article'];
if (isset($_POST['title'])&&isset($_POST['content'])&&isset($_FILES['fileUpload'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $file = $_FILES['fileUpload'];
    if (!$_FILES['fileUpload']['size']==0) {
        include('function.php');
        echo $title." ".$content." ".basename( $_FILES["fileUpload"]["name"]);
        $img_name = $id.".".$ext;
        $sql = "UPDATE article SET title='$title',content='$content',`image`='$img_name' WHERE id=$article";
        $req = $bdd->prepare($sql);
        $req->execute();
    }
    else {
        echo"pas image";
    }
}
else {
    echo"nope";
}
unset($_SESSION['article']);
//header('Location:user_panel.php');