<ul class="submenu">
    <li><a href="<?= $rm_tickets_e ?>"> Gérer les Articles</a></li>
    <li><a href="<?= $rm_tickets_a ?>"> Ajouter un article</a></li>
    <li><a href="<?= $rm_tickets ?>"> Les Articles</a></li>
</ul>


<div id="container">

    <?php

    if (isset($_GET[$gm_tickets_a])) {
        require_once $root . "/private/content-management/tickets/add.php";
    } elseif (isset($_GET[$gm_tickets_e])) {
        require_once $root . "/private/content-management/tickets/manage.php";
    } else {
        $url = $_SERVER['REQUEST_URI'];
        if ($url != $rm_tickets) {
            header("Location: " . $rm_tickets);
        } else {
            require_once $root . "/private/content-management/tickets/list.php";
        }
    }

    ?>

</div>