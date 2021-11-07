<?php
    session_start();
    include_once "../../controlleur/sujet/implSujetDAO.php";
    include_once "../../controlleur/theme/implThemeDAO.php";
    include_once "../../controlleur/redacteur/implRedacteurDAO.php";
    include_once "../../modele/sujet.php";
    require_once "submitBlog.php";
    include "manipulerEditBlog.php";
?>
<html>
<head><title><?php echo $titre ?></title></head>
<link rel="stylesheet" href="../cssfiles/guiEditBlog.css">
<!--    Font Awesome-->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
<!--    Google Fonts-->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

<body>
<?php
include "header.php";
?>

<?php if(count($errors) > 0):?>
<div class="msg error">
    <?php foreach ($errors as $error): ?>
    <li><?php echo $error ?></li>
    <?php endforeach;?>
</div>
<?php endif; ?>
        <div class="form-content">
            <h2 class="form-title"><?php echo $titre ?></h2>

            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label>Title</label>
                    <input type="text" name="title" value="<?php echo $title ?>" class="text-input">
                </div>
                <div class="form-control">
                    <label>Body</label>
                    <textarea name="body" id="body"><?php echo $text ?></textarea>
                </div>
                <div class="form-control">
                    <label>Image</label>
                    <input type="file" name="image" class="text-input">
                </div>
                <div class="form-control">
                    <label>Topic</label>
                    <select name="topic_id" class="text-input">
                        <option value=""></option>
                        <?php foreach ($topics as $topic): ?>

                                <option <?php if (!empty($topic_id) && $topic_id == $topic) echo "selected" ?>
                                        value="<?php echo $topic ?>"><?php echo $topic ?></option>
                        <?php endforeach; ?>

                    </select>
                </div>
                <div class="form-control">
                        <label>
                            <input type="checkbox" name="published" <?php if(!empty($publier)) echo "checked"?>>
                            Publish
                        </label>
                </div>
                <div>
                    <button type="submit" name="btn-post" class="btn btn-big"><?php echo $btnValue ?></button>
                </div>
            </form>

        </div>

<!-- JQuery -->
<script
        src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<!-- Ckeditor -->
<script
        src="https://cdn.ckeditor.com/ckeditor5/12.2.0/classic/ckeditor.js"></script>
<!-- Custom Script -->
<script src="../javascriptfiles/script.js"></script>

</body>
</html>