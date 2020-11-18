<ul class="submenu">
    <li><a href="<?= $rm_categories_e ?>"> Gérer les catégories</a></li>
    <li><a href="<?= $rm_categories_a ?>"> Ajouter une catégorie</a></li>
    <li><a href="<?= $rm_categories ?>"> Les catégories</a></li>
</ul>

<div id="container">

    <?php

    if (isset($_GET[$gm_categories_a]) && $_SERVER['REQUEST_URI'] == $rm_categories_a) {
        require_once $root . "/private/content-management/categories/add.php";
    } elseif (isset($_GET[$gm_categories_e]) && $_SERVER['REQUEST_URI'] == $rm_categories_e) {
        require_once $root . "/private/content-management/categories/manage.php";
    } else {
        $url = $_SERVER['REQUEST_URI'];
        if ($url != $rm_categories) {
            header("Location: " . $rm_categories);
        } else {
            require_once $root . "/private/content-management/categories/list.php";
        }
    }

    ?>

</div>