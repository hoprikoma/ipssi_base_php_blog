<?php declare(strict_types=1);
    session_start();
?>
<header>
    <a href="index.php">
        <h1 class="text-center hope-title-header">Blog test</h1>
    </a>
    <nav class="navbar navbar-expand-lg navbar-light bg-light hope-nav">
        <div class="collapse navbar-collapse d-flex justify-content-center" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Catégorie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact</a>
                </li>
                
                <?php
                    if (isset($_SESSION['pseudo'])) {
                        ?>
                        <li class="nav-item dropdown">
                            <span class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Bonjour <?php echo $_SESSION['pseudo'] ?>
                            </span>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="user_panel.php">Mes articles</a>
                                <a class="dropdown-item" href="disconnect.php">Déconnexion</a>
                            </div>
                        </li>
                        <?php
                    }
                    else {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                Compte
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="account_create.php">Inscription</a>
                                <a class="dropdown-item" href="account_connect.php">Connexion</a>
                            </div>
                        </li>
                        <?php
                        }
                    ?>
            </ul>
        </div>
    </nav>
</header>