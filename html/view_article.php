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
$article_view = $_POST['article'];
$x = $bdd->query("SELECT * FROM article WHERE id=$article_view");
while ($donnees = $x->fetch()) {
    ?>
    <div class="container">
        <div class="article-block col-xs-12 col-md-8">
            <h1>
                <?php echo $donnees['title'];?>
            </h1>
            <hr>
            <div class="article-body d-flex justify-content-center">
                <?php
                    if ($donnees['id']%2==1) {
                        echo'<p class="col-md-6">';
                            echo $donnees['content'];
                        echo'</p>';
                        echo'<img class="img_article col-md-6"  src="../ressources/'.$donnees["id"].'/'.$donnees["image"].'" alt="image">';
                    }
                    else {
                        echo'<img class="img_article col-md-6"  src="../ressources/'.$donnees["id"].'/'.$donnees["image"].'" alt="image">';
                        echo'<p class="col-md-6">';
                            echo $donnees['content'];
                        echo'</p>';
                    }
                    ?>
                
            </div>
            <p class="article-creator">Ecrit par :
                <span>
                    <?php echo $donnees['author'];?>
                </span>
            </p>
        </div>
    </div>
    <div class="container text-center">
        <h2 class="text-center">Commentaires</h2>
        <form action="comment_upload.php" method="post">
            <?php 
            if (isset($_SESSION['pseudo'])) {
                $pseudoComm = $_SESSION['pseudo'];
            }
            else {
                $pseudoComm ="";
            }
            ?>
            <p>Votre pseudo :</p>
            <input type="text" name="pseudo" value="<?php echo $pseudoComm?>" required>
            <p>Votre commentaire :</p>
            <textarea name="comment" cols="60" rows="5" required></textarea>
            <?php $_SESSION['article'] = $article_view ?>
            <br>
            <input class="btn btn-dark" type="submit" value="Poster">
        </form>
        <hr>
        <?php
            $x = $bdd->query("SELECT id,username,content FROM commentaire WHERE article=$article_view");
            while ($donnees = $x->fetch()) {
                ?>
                <p class="text-center"><?php echo $donnees['username']?> à écrit :</p>
                <p class="text-center"><?php echo $donnees['content']?></p>
                <hr>
                <?php
            }
        ?>
    </div>
    <?php
}
?>
</body>

</html>