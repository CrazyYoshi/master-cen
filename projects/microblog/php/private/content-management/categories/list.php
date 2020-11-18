<?php


$sql = "SELECT * FROM category";
$result = mysqli_query($db, $sql);

$categories = array();

while ($category = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $categories[] = $category;
}

?>

<h1>Liste des catégories</h1>
<table class="pure-table">

    <tr>
        <th>Catégorie</th>
        <th>Description</th>
    </tr>
    <?php foreach ($categories as $category): ?>
        <tr>
            <td class="link-cell"><a target="_blank"
                   href="<?= $r_categories . "/" . $category['url-friendly'] ?>"><?= $category['name'] ?></a></td>
            <td><?= $category['desc'] ?></td>
        </tr>
    <?php endforeach; ?>


</table>

