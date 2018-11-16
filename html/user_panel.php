<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Document</title>
    <?php include('head.php');?>
</head>

<body>
    <?php include('header.php');
    include('fonct_web.php');
    $bdd = connexion();
    if (!isset($_SESSION['pseudo'])) {
        header('Location:index.php');
    }
        $user = $_SESSION['pseudo'];
        $x = $bdd->query("SELECT * FROM article WHERE author='$user'");
        while ($donnees = $x->fetch()) {
            $id = $donnees['id'];
            ?>
            <div class="container">
                <div class="article-user col-xs-12 col-md-10 text-center d-flex justify-content-around">
                        <a href="http://"><?php echo $donnees['title'];?></a>
                    <form action="edit_article.php" method="get">
                        <input type="hidden" name="article" value="<?php echo $id?>">
                        <input type="hidden" name="choice" value="0">
                        <input class="btn btn-dark" type="submit" value="Modifier">
                    </form>
                    <form action="edit_article.php" method="get">
                        <input type="hidden" name="article" value="<?php echo $id?>">
                        <input type="hidden" name="choice" value="1">
                        <input class="btn btn-dark" type="submit" value="Supprimer">
                    </form>
                    <form action="view_article.php" method="post" target="_blank">
                        <input type="hidden" name="article" value="<?php echo $id?>">
                        <input class="btn btn-dark" type="submit" value="Voir">
                    </form>
                </div>
            </div>
            <?php
        }
    ?>
    </div>
</body>

</html>