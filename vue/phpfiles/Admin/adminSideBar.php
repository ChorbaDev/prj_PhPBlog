<div class="left-sidebar">
    <ul>
        <li><a href="<?php echo BASE_URL ?>/vue/phpfiles/Resources/dashboard.php?r" class="borderTop">Redacteurs</a></li>
        <li><a href="<?php echo BASE_URL ?>/vue/phpfiles/Resources/dashboard.php?t" >Thémes</a></li>
        <li> <a href="<?php echo BASE_URL ?>/vue/phpfiles/Resources/dashboard.php?b" >Blogs</a></li>
        <?php if(isset($_GET['b'])) echo '<li><a href="'.BASE_URL.'/vue/phpfiles/Blog/editBlog.php" >Ajouter un blog</a></li>';
        else if(isset($_GET['t'])) echo '<li><a href="'.BASE_URL.'/vue/phpfiles/Admin/editTheme.php" >Ajouter un theme</a></li>';
        else if(isset($_GET['r'])) echo '<li><a href="'.BASE_URL.'/vue/phpfiles/Inscription_ModifRedact/formulaireRedacteur.php?admin" >Ajouter un rédacteur</a></li>';
        ?>
    </ul>
</div>
