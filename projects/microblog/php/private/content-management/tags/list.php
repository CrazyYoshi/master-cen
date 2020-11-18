<?php


$sql = "SELECT * FROM tags";
$result = mysqli_query($db, $sql);

$tags = array();

while ($tag = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $tags[] = $tag;
}

?>

<h1>Les Tags</h1>

<table class="pure-table">
    <tr>
        <th>Tag</th>
        <th>Tag format URL</th>
    </tr>

    <?php foreach ($tags as $tag): ?>
        <tr>
            <td>
                <?= $tag['name'] ?>
            </td>
            <td class="link-cell">
                <a target="_blank" href="<?= $r_tags . "/" . $tag['tag'] ?>"><?= $tag['tag'] ?></a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>