<?php
function connexion(){
try {
    $bdd = new PDO("mysql:host=localhost;dbname=tp-site-secu", "root", "pass");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $bdd;
    }
catch(PDOException $e)
    {
    echo $bdd . "<br>" . $e->getMessage();
    }
}