<?php
require $root . '/public/getDatas/getCategories.php';
require $root . '/public/getDatas/getTickets.php';
require $root . '/public/getDatas/getTags.php';
setlocale(LC_ALL, 'fr_FR.utf8', 'fra');
date_default_timezone_set('Europe/Paris');
?>

    <h1>Derniers articles publiés</h1>
    <main>
        <?php if (isset($tickets)): ?>


            <?php foreach ($tickets as $ticket): ?>

                <?php
                preg_match('/^([^.!?\s]*[\.!?\s]+){0,50}/', strip_tags($ticket['content']), $abstract);
                ?>
                <article>
                    <a class="progressive-borders" href="<?= $r_tickets . "/" . $ticket['url'] ?>">
                        <h2 class="title"><?= $ticket['title'] ?></h2>
                        <p class="date-author"><?= date_format(date_create($ticket['date']), '\l\e d/m/y à  H\hi') ?>,
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

            <?php foreach($categories as $value): ?>

                <p class="category c-<?= $value['nb_tickets'] ?>"><a href="/by-category/<?= $value['url-friendly'] ?>"><?= $value['name'] ?> (<?= $value['nb_tickets'] ?>)</a></p>

            <?php endforeach; ?>

            <h2>Mots-clés</h2>

            <?php foreach($tags as $value): ?>

                <a class='tag t-<?= $value['nb_tickets'] ?>' href="/by-tag/<?= $value['tag'] ?>"><?= $value['name'] ?></a>

            <?php endforeach; ?>
    </aside>
