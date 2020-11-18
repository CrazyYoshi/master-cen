<?php


?>


<ul class="submenu">
    <li><a href="<?= $rm_tags_e ?>"> Gérer les tags</a></li>
    <li><a href="<?= $rm_tags_a ?>"> Ajouter des tags</a></li>
    <li><a href="<?= $rm_tags ?>"> Les tags</a></li>
</ul>


<div id="container">
    <?php

    if (isset($_GET[$gm_tags_a]) && $_SERVER['REQUEST_URI'] == $rm_tags_a) {
        require_once $root . "/private/content-management/tags/add.php";
    } elseif (isset($_GET[$gm_tags_e]) && $_SERVER['REQUEST_URI'] == $rm_tags_e) {
        require_once $root . "/private/content-management/tags/manage.php";
    } else {
        $url = $_SERVER['REQUEST_URI'];
        if ($url != $rm_tags) {
            header("Location: " . $rm_tags);
        } else {
            require_once $root . "/private/content-management/tags/list.php";
        }
    }

    ?>

</div>