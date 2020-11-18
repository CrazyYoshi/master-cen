<?php
require $root . '/public/getDatas/getCategories.php';
require $root . '/public/getDatas/getTags.php';

if (isset($_GET[$g_ticket_url])) {

    //GET DATAS FOR THIS TICKETS

    $sql = "SELECT "
        . "tickets.id as id, tickets.title as title, tickets.content as content, tickets.date as date, tickets.url as url, user.login as author, category.name as category, category.`url-friendly` as category_url "
        . "FROM tickets "
        . "LEFT JOIN user on tickets.user_id=user.id "
        . "LEFT JOIN category on tickets.category_id=category.id "
        . "WHERE tickets.url='{$_GET[$g_ticket_url]}'";
    $result = mysqli_query($db, $sql);
    $myTicket = mysqli_fetch_array($result, MYSQLI_ASSOC);

    $sql = "SELECT tag, name FROM tags "
        . "LEFT JOIN tickets_has_tags on tags.id=tickets_has_tags.tags_id "
        . "WHERE tickets_has_tags.tickets_id = {$myTicket['id']} ";
    $result = mysqli_query($db, $sql);
    $myTicketTags = mysqli_fetch_array($result, MYSQLI_ASSOC);

} else {
    header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found", true, 404);
    readfile($root . '/customs_errors/error404.php');
    exit(1);
}


?>

<main>
    <h1><?= $myTicket['title'] ?></h1>
    <p class="date-author"><?= date_format(date_create($myTicket['date']), '\l\e d/m/y à  H\hi') ?>, par <span class="author"><?= $myTicket['author'] ?></span> dans <a href="/by-category/<?= $myTicket['category_url'] ?>"><?= $myTicket['category'] ?></a></p>
    <article class="article"><?=html_entity_decode($myTicket['content'],ENT_QUOTES, 'UTF-8')  ?></article>
<!--    </p>-->
</main>
<aside>
    <h2>Catégories</h2>

    <?php foreach ($categories as $value): ?>

        <p class="category c-<?= $value['nb_tickets'] ?>">
            <a href="/by-category/<?= $value['url-friendly'] ?>">
                <?= $value['name'] ?> (<?= $value['nb_tickets'] ?>)
            </a>
        </p>

    <?php endforeach; ?>

    <h2>Mots-clés</h2>

    <?php foreach ($tags as $value): ?>

        <a class='tag t-<?= $value['nb_tickets'] ?>' href="/by-tag/<?= $value['tag'] ?>"><?= $value['name'] ?></a>

    <?php endforeach; ?>
</aside>
