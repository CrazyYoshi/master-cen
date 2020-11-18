<?php session_start() ?>
<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <title>Control Panel MicroBlog</title>
    <link href="/assets/css/private.css" rel="stylesheet" type="text/css">
    <script src="/assets/libs/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#content',
            height: 500,
            menubar: false,
            plugins: [
                'advlist autolink lists link image charmap print preview anchor',
                'searchreplace visualblocks code fullscreen',
                'insertdatetime media table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            content_css: '//www.tinymce.com/css/codepen.min.css'
        });
    </script>
</head>

<body>


<nav>

    <ul>
        <h2>Administration</h2>

        <?php if (isset($_SESSION['user']) && $_SESSION['user']['permissions'] >= "1"): ?>
            <li><a  href="<?= $r_disconnect ?>">Déconnexion</a></li>

            <li><a <?= (isset($_GET[$gm_tickets])) ? 'class="active"' : '' ?> href="<?= $rm_tickets ?>">Tickets</a></li>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['permissions'] >= "2"): ?>
                <li><a <?= (isset($_GET[$gm_categories])) ? 'class="active"' : '' ?> href="<?= $rm_categories ?>">Catégories</a></li>
                <li><a <?= (isset($_GET[$gm_tags])) ? 'class="active"' : '' ?> href="<?= $rm_tags ?>">Tags</a></li>
            <?php endif; ?>
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['permissions'] >= "3"): ?>
                <li><a  <?= (isset($_GET[$gm_users])) ? 'class="active"' : '' ?>href="<?= $rm_users ?>">Utilisateurs</a></li>
            <?php endif; ?>
            <li><a  <?= (isset($_GET[$gm_cp])) ? 'class="active"' : '' ?> href="<?= $rm_cp ?>">Panneau de contrôle</a></li>

        <?php endif; ?>
        <li><a href="/">Retour sur le site</a></li>


    </ul>
</nav>


