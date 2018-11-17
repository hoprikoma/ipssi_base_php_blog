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
    $article = $_GET['article'];
    if (isset($_GET['article']) && isset($_GET['choice'])) {
        if ($_GET['choice']=="0") {
            $article = $_GET['article'];
            $_SESSION['article'] = $article;
            $x = $bdd->query("SELECT * FROM article WHERE id='$article'");
            while ($donnees = $x->fetch()) {
                ?>
                <form class="text-center" action="update.php" method="post" enctype='multipart/form-data'>
                    <div>
                        <p>Titre :</p>
                        <textarea class="col-md-5" name="title" cols="30" rows="1"><?php echo $donnees['title'] ?></textarea>
                        <p>Article :</p>
                        <textarea class="col-md-10" name="content" cols="50" rows="10"><?php echo $donnees['content'] ?></textarea>
                        <p>Image :</p>
                        <input type="file" name="fileUpload">
                    </div>
                    <input class="btn btn-dark" type="submit" value="Update">
                </form>
                    
                <?php
            }
        }
        else {
            $x = $bdd->prepare("DELETE FROM article WHERE id = '$article'");
            $x->bindParam(':article', $article);
            $x->execute();
            header('Location:user_panel.php');
        }
    }
    else {
        header('Location : index.php');
        }
    ?>
    </div>
</body>
