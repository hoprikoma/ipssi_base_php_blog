<!DOCTYPE html>
<html>

<head>
    <title>Inscription</title>
    <?php include('head.php');?>
</head>

<body>
    <?php include('header.php');?>
    <?php
        include('fonct_web.php');
        if(isset($_POST["pseudo"]) && isset($_POST["mdp"]) && isset($_POST["mdp2"]))
        {
            $pseudo = $_POST["pseudo"];
            $pseudo = htmlentities($pseudo, ENT_NOQUOTES);
            $mdp = $_POST["mdp"];
            $mdp = htmlentities($mdp, ENT_NOQUOTES);
            $mdp2 = $_POST["mdp2"];
            $mdp2 = htmlentities($mdp2, ENT_NOQUOTES);
                if (strlen($pseudo) < 50) 
                {
                    if ($mdp == $mdp2) 
                    {
                        if (strlen($mdp) < 20) 
                        {
                            // $hash = password_hash($mdp,PASSWORD_BCRYPT);
                            $hash = crypt($mdp);
                            $bdd = connexion();
                            $x = $bdd->prepare("INSERT INTO user (`username`,`password`) value (:pseudo,:mdp)");
                            $x->bindParam(':pseudo', $pseudo);
                            $x->bindParam(':mdp', $hash);
                            $x->execute();
                            echo "compte crée avec succes"."<br>"."redirection auto dans 5 sec";
                            $_SESSION['pseudo']=$pseudo;
                            header("refresh:5;url=index.php");
                        }
                        else
                        {
                            echo "mot de passe trop long";
                            ?>
                            <a href="account_create.php">Retour</a>
                            <?php
                        }
                    }
                    else
                    {
                        echo "Les mots de passes ne sont pas identiques";
                        ?>
                        <a href="account_create.php">Retour</a>
                        <?php
                    }
                }
                else 
                {
                    echo "pseudo trop long";
                    ?>
                    <a href="account_create.php">Retour</a>
                    <?php
                }
            }
        else
        {
            ?>
    <div class="container">
        <form method="post" action="account_create.php">
            <div class="form-group">
                <label>Pseudo</label>
                <input type="text" class="form-control" name="pseudo" placeholder="Pseudo" maxlength="50" minlength="1" required>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" class="form-control" name="mdp" placeholder="Mot de passe" maxlength="50" minlength="1" required>
            </div>
            <div class="form-group">
                <label>Vérification mot de passe</label>
                <input type="password" class="form-control" name="mdp2" placeholder="Mot de passe" maxlength="50" minlength="1" required>
            </div>
            <button type="submit" class="btn btn-primary">S'enregistrer</button>
        </form> 
    <?php
        }
    ?>
</body>

</html>