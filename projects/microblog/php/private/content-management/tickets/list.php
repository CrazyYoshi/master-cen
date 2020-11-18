<?php

$sql = " SELECT";
$sql.= "   `user`.`login` as author,";
$sql.= "   `category`.`name` as category,";
$sql.= "   `tickets`.*";
$sql.= " FROM";
$sql.= "   `tickets`";
$sql.= " LEFT JOIN";
$sql.= "   `user` ON `user`.`id` = `tickets`.`user_id`";
$sql.= " LEFT JOIN";
$sql.= "   `category` ON `category`.`id` = `tickets`.`category_id`";

$result = mysqli_query($db, $sql);

$tickets = array();

while($ticket =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $tickets[]=$ticket;
}

?>

<h1>Mes articles</h1>

<table class="pure-table">

    <tr>
        <th>Titre</th>
        <th>Auteur</th>
        <th>Catégorie</th>
        <th>Date de parution</th>
        <th>Lien vers l'article</th>
    </tr>
    <?php foreach ($tickets as $ticket): ?>
        <tr>
            <td><?= $ticket['title']?></td>
            <td><?= $ticket['author']?></td>
            <td><?= $ticket['category']?></td>
            <td><?= $ticket['date'] ?></td>
            <td class="link-cell"><a target="_blank" href="<?= $r_tickets."/".$ticket['url'] ?>">Lire l'article</a></td>
        </tr>
    <?php endforeach; ?>


</table>

