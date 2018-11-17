<!DOCTYPE html>
<html lang="fr">

<head>
    <title>Connection</title>
    <?php include('head.php');?>
</head>

<body>
    <?php include('header.php');?>
<?php
    include('fonct_web.php');
if(isset($_POST["mdp"]) && isset($_POST["mdp"]))
{
    $pseudo = $_POST["pseudo"];
    $pseudo = htmlspecialchars($pseudo, ENT_COMPAT,'ISO-8859-1', true);
    $mdp = $_POST["mdp"]; 
    $mdp = htmlspecialchars($mdp, ENT_COMPAT,'ISO-8859-1', true);
    $bdd = connexion();
    $x =$bdd->query("SELECT `password` FROM `user` WHERE `username` = '$pseudo'");
    while($select = $x->fetch())
    {
        $mdp_data = $select['password'];
    }
    if(password_verify($mdp, $mdp_data))
    {
        $_SESSION['pseudo']=$pseudo;
        header("Location: index.php");
    }
    else
    {
        echo "Erreur avec le mot de passe";
    }
}
else {
    ?>
    <div class="container">
        <form method="post" action="account_connect.php">
            <div class="form-group">
                <label>Pseudo</label>
                <input type="text" class="form-control" name="pseudo" placeholder="Mon pseudo" maxlength="50" minlength="1">
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" maxlength="50" minlength="1">
            </div>
            <button type="submit" class="btn btn-primary">S'enregistrer</button>
        </form> 
    </div>
    <?php
}
?>
</body>

</html>