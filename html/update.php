<?php
session_start();
include('fonct_web.php');
if (!isset($_SESSION['pseudo'])) {
    header('Location:index.php');
}
$bdd = connexion();
$article = $_SESSION['article'];
if (isset($_POST['title'])&&isset($_POST['content'])&&isset($_FILES['fileUpload'])) {
    $title = $_POST['title'];
    $title = htmlspecialchars($title, ENT_COMPAT,'ISO-8859-1', true);
    $content = $_POST['content'];
    $content = htmlspecialchars($content, ENT_COMPAT,'ISO-8859-1', true);
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
        $sql = "UPDATE article SET title='$title',content='$content' WHERE id=$article";
        $req = $bdd->prepare($sql);
        $req->execute();
    }
}
else {
    echo"nope";
}
unset($_SESSION['article']);
header('Location:user_panel.php');