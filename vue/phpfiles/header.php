<script type="text/javascript" src="../javascriptfiles/toggleScript.js"></script>
<?php
session_start();
?>
<header>
    <div class="logo">
        <h1 class="logo-txt"><i class="fas fa-book-reader"></i>The Blog</h1>
    </div>
    <i class="fa fa-bars menu-switch" onclick="toggleMenu('.nav')"></i>
    <ul class="nav">
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="..\htmlfiles\apropos.html">A Propos</a></li>
        <?php if (isset($_SESSION['pseudo'])): ?>
            <li>
                <a href="#" onclick="toggleMenu('.nav ul')">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['pseudo'];
                    ?>

                    <i class="fa fa-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="#">Tableau de Bord</a></li>
                    <li><a href="deconnexion.php" class="deconnexion">Se Déconnecter</a></li>
                </ul>
            </li>
        <?php else: ?>
                <li><a href="signup.php">S'inscrire</a></li>
                <li><a href="login.php">Se Connecter</a></li>
        <?php endif;?>

    </ul>
</header>
