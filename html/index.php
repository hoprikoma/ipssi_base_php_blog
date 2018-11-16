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
    $x = $bdd->query("SELECT id FROM article ORDER BY id ASC");
    while ($donnees = $x->fetch()) {
        $id = $donnees['id'];
    }
    $pages = $id/5;
    if (!isset($_GET['page'])) {
        $actual_page = 0;
    }
    else {
        $actual_page = $_GET['page'];
        $actual_page = $actual_page * 5;
    }
    $x = $bdd->query("SELECT * FROM article ORDER BY id ASC LIMIT 5 OFFSET $actual_page");
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
                <form action="view_article.php" method="post" target="_blank">
                    <input type="hidden" name="article" value="<?php echo $donnees['id'];?>">
                    <input class="btn btn-dark" type="submit" value="Voir">
                </form>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="d-flex justify-content-around col-md-5 mx-auto">
    <?php
    for ($i=0; $i < $pages; $i++) { 
        ?>
        <form action="index.php" method="get">
            <input type="hidden" name="page" value="<?php echo $i;?>">
            <input class="btn btn-dark" type="submit" value="<?php echo $i + 1 ;?>">
        </form>
        <?php
    }
    ?>
    </div>
</body>

</html>