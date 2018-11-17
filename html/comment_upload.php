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
    if (isset($_POST['pseudo'])&&isset($_POST['comment'])) {
        $pseudo = $_POST['pseudo'];
        $pseudo = htmlspecialchars($pseudo, ENT_COMPAT,'ISO-8859-1', true);
        $comment = $_POST['comment'];
        $comment = htmlspecialchars($comment, ENT_COMPAT,'ISO-8859-1', true);
        $x = $bdd->prepare("INSERT INTO commentaire (`username`,`content`,article) value (:username,:comment,:article)");
            $x->bindParam(':username', $pseudo);
            $x->bindParam(':comment', $comment);
            $x->bindParam(':article', $_SESSION['article']);
            $x->execute();
            unset($_SESSION['article']);
            header('Location:index.php');
    }
    else {
        header('Location:index.php');
    }
    ?>
    </div>
</body>
</html>