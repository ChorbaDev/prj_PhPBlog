<script type="text/javascript" src="<?php echo BASE_URL; ?>/vue/javascriptfiles/toggleScript.js"></script>
<header>
    <div class="logo">
        <h1 class="logo-txt"><i class="fas fa-book-reader"></i>The Blog</h1>
    </div>
    <i class="fa fa-bars menu-switch" onclick="toggleMenu('.nav')"></i>
    <ul class="nav">
        <li><a href="<?php echo BASE_URL; ?>/index.php">Accueil</a></li>
        <li><a href="#">A Propos</a></li>
        <?php if (isset($_SESSION['pseudo'])): ?>
            <li>
                <a href="#" onclick="toggleMenu('.nav ul')">
                    <i class="fa fa-user"></i>
                    <?php echo $_SESSION['pseudo'];
                    ?>

                    <i class="fa fa-chevron-down"></i>
                </a>
                <ul>
                    <li><a href="<?php echo BASE_URL; ?>/vue/phpfiles/Resources/dashboard.php?b">Tableau de Bord</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/vue/phpfiles/Inscription_ModifRedact/formulaireRedacteur.php?p">Paramètres</a></li>
                    <li><a href="<?php echo BASE_URL; ?>/vue/phpfiles/Connexion/deconnexion.php" class="deconnexion">Se Déconnecter</a></li>
                </ul>
            </li>
        <?php else: ?>
                <li><a href="<?php echo BASE_URL; ?>/vue/phpfiles/Inscription_ModifRedact/formulaireRedacteur.php?c">S'inscrire</a></li>
                <li><a href="<?php echo BASE_URL; ?>/vue/phpfiles/Connexion/Login/login.php">Se Connecter</a></li>
        <?php endif;?>

    </ul>
</header>
