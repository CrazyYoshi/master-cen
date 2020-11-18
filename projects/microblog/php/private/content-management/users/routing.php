<ul class="submenu">
    <li><a href="<?= $rm_users_e ?>"> Gérer les Utilisateurs</a></li>
    <li><a href="<?= $rm_users ?>"> Les Utilisateurs</a></li>
</ul>

<div id="container">

    <?php

    if (isset($_GET[$gm_users_e])) {
        require_once $root . "/private/content-management/users/manage.php";
    } else {
        $url = $_SERVER['REQUEST_URI'];
        if ($url != $rm_users) {
            header("Location: " . $rm_users);
        } else {
            require_once $root . "/private/content-management/users/list.php";
        }
    }

    ?>

</div>