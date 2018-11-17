<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Document</title>
    <?php include('head.php');?>
</head>

<body>
    <?php include('header.php');
    include('fonct_web.php');
    if (!isset($_SESSION['pseudo'])) {
        header('Location:index.php');
    }
    $bdd = connexion();
    $user = $_SESSION['pseudo'];
    if (isset($_POST['article'])&&isset($_POST['content'])&&isset($_FILES['fileUpload'])) {
        $title = $_POST['article'];
        htmlspecialchars($title, ENT_COMPAT,'ISO-8859-1', true);
        $content = $_POST['content'];
        htmlspecialchars($content, ENT_COMPAT,'ISO-8859-1', true);
        $file = $_FILES['fileUpload'];
        if (!$_FILES['fileUpload']['size']==0) {
            include('upload_verif.php');
            echo $title." ".$content." ".basename( $_FILES["fileUpload"]["name"]);
            $img_name = $id.".".$ext;
            $author = $_SESSION['pseudo'];
            $x = $bdd->prepare("INSERT INTO article (`title`,`content`,`image`,`author`) value (:title,:content,:pic,:author)");
            $x->bindParam(':title', $title);
            $x->bindParam(':content', $content);
            $x->bindParam(':pic', $img_name);
            $x->bindParam(':author', $author);
            $x->execute();
            header('Location:user_panel.php');
        }
    }
    else {
        ?>
        <form class="text-center" action="create_article.php" method="post" enctype='multipart/form-data'>
                    <div>
                        <p>Titre :</p>
                        <textarea class="col-md-5" name="article" cols="30" rows="1" required></textarea>
                        <p>Article :</p>
                        <textarea class="col-md-10" name="content" cols="50" rows="10" required></textarea>
                        <p>Image :</p>
                        <input type="file" name="fileUpload" required>
                    </div>
                    <input class="btn btn-dark" type="submit" value="Update">
                </form>
        <?php
    }
    ?>
    </div>
</body>
</html>