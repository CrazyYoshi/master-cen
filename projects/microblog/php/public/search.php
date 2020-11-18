<?php

require $root . '/public/getDatas/getTags.php';
require $root . '/public/getDatas/getCategories.php';


if (isset($_GET['n'])) {

    $name = $_GET['n'];
    $s_tags = (isset($_GET['t']) ? $_GET['t'] : 0);
    $s_cat = (isset($_GET['c']) ? $_GET['c'] : 0);


    require $root . '/public/getDatas/getTickets.php';


}


?>

    <?php if (!isset($tickets)): ?>


        <h1>Rechercher un article</h1>


        <form method="get">
            <label class="label" for="keywords">Mot clés : </label>
            <textarea id="keywords" type="text" name="n" placeholder="Mot-clé"></textarea>
            <p class="label">Catégorie : </p>
            <div id="categories">
                <input id="c-all" name="c" type="radio" value="">
                <label for="c-all" class="radio-inline">Toutes catégories</label>
                <?php foreach ($categories as $value): ?>
                    <input id="c-<?= $value['url-friendly'] ?>" name="c" type="radio"
                           value="<?= $value['url-friendly'] ?>">
                    <label for="c-<?= $value['url-friendly'] ?>" class="radio-inline"><?= $value['name'] ?></label>
                <?php endforeach; ?>
            </div>
            <p class="important">Vous ne pouvez sélectionner qu'une seule catégorie ou aucune.</p>

            <p class="label">Tags : </p>
            <div id="tags">
                <?php foreach ($tags as $value): ?>
                    <input id="t-<?= $value['tag'] ?>" type="checkbox" name="t[]" value="<?= $value['tag'] ?>">
                    <label for="t-<?= $value['tag'] ?>"><?= $value['name'] ?></label>
                <?php endforeach; ?>
            </div>

            <button type="submit">Rechercher</button>
            <?php if (isset($_SESSION['search_result'])): ?>
                <p class="important"><?=$_SESSION['search_result']?></p>
            <?php endif; ?>

        </form>

    <?php else: ?>


        <h1>Résultat de la recherche <a href="/search"'"">Nouvelle recherche</a></h1>


        <main>
            <?php if (isset($tickets)): ?>


                <?php foreach ($tickets as $ticket): ?>

                    <?php
                    preg_match('/^([^.!?\s]*[\.!?\s]+){0,50}/', strip_tags($ticket['content']), $abstract);
                    ?>
                    <article>
                        <a class="progressive-borders"  href="<?= $r_tickets . "/" . $ticket['url'] ?>">
                            <h2 class="title"><?= $ticket['title'] ?></h2>
                            <p class="date-author"><?= date_format(date_create($ticket['date']), '\l\e d/m/y à  H\hi') ?>
                                ,
                                par <span class="author"><?= $ticket['author'] ?></span></p>
                            <p class="abstract"><?= trim($abstract[0]) ?>...</p>
                        </a>
                        <p class="category"><?= $ticket['category'] ?></p>
                    </article>

                <?php endforeach; ?>


            <?php else: ?>

                <p>Pas d'articles</p>

            <?php endif; ?>

        </main>

        <aside>
            <h2>Catégories</h2>

            <?php foreach ($categories as $value): ?>

                <p class="category c-<?= $value['nb_tickets'] ?>"><a
                        href="/by-category/<?= $value['url-friendly'] ?>"><?= $value['name'] ?>
                        (<?= $value['nb_tickets'] ?>)</a></p>

            <?php endforeach; ?>

            <h2>Mots-clés</h2>

            <?php foreach ($tags as $value): ?>

                <a class='tag t-<?= $value['nb_tickets'] ?>'
                   href="/by-tag/<?= $value['tag'] ?>"><?= $value['name'] ?></a>

            <?php endforeach; ?>
        </aside>


    <?php endif; ?>
