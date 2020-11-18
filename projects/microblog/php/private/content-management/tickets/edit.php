<?php


//TICKETS DATA

$id = $_GET['id'];

$sql = " SELECT";
$sql .= "   `user`.`login` as author,";
$sql .= "   `category`.`name` as category,";
$sql .= "   `category`.`id` as category_id,";
$sql .= "   `tickets`.*";
$sql .= " FROM";
$sql .= "   `tickets`";
$sql .= " LEFT JOIN";
$sql .= "   `user` ON `user`.`id` = `tickets`.`user_id`";
$sql .= " LEFT JOIN";
$sql .= "   `category` ON `category`.`id` = `tickets`.`category_id`";
$sql .= " WHERE tickets.id = $id";


if ($ticket = mysqli_fetch_array(mysqli_query($db, $sql), MYSQLI_ASSOC)) {


//FORMAT DATE
    $datetime = new DateTime($ticket['date']);
    $date = $datetime->format('Y-m-d');
    $time = $datetime->format('H:i:s');


//GET ALL TAGS THE TICKET HAS

    $sql = "SELECT `tickets_has_tags`.tags_id FROM tickets_has_tags WHERE tickets_id = {$ticket['id']}";
    $result = mysqli_query($db, $sql);
    $t_has_tags = array();
    while ($tag = mysqli_fetch_array($result)) {
        $t_has_tags[] = $tag['tags_id'];
    }


//GET ALL CATEGORIES
    $sql = "SELECT * FROM category";
    $result = mysqli_query($db, $sql);
    $categories = array();
    while ($category = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $categories[] = $category;
    }


//GET ALL TAGS
    $sql = "SELECT * FROM tags";
    $result = mysqli_query($db, $sql);
    $tags = array();
    while ($tag = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $tags[] = $tag;
    }

//ROUTING TO CORRECT URL
    if ((!isset($_GET['title'])) || ($_GET['title'] != formatUrlFriendly($db, $ticket['title']))) {
        header('Location: ' . $rm_tickets_e . "/" . $id . "/" . formatUrlFriendly($db, $ticket['title']) . "/");
    }


//Commandes SQL qui insère et ignore si l'entrée existe déja
// INSERT INTO tickets_has_tags (tags_id,tickets_id) SELECT * FROM (SELECT '4','3') AS tmp WHERE NOT EXISTS ( SELECT * FROM tickets_has_tags WHERE tags_id = '4' and tickets_id = '3' ) LIMIT 1
// INSERT IGNORE INTO tickets_has_tags (tags_id,tickets_id) VALUES (3,3)


//UPDATE THE TICKET
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $title = $_POST['title'];
        $content = $_POST['content'];
        $date = $_POST['date'] . " " . $_POST['hour'];
//    $user_id = $_SESSION['user']['id'];
        $category_id = $_POST['category'];
        $tagsA = $_POST['tags'];

        $sql = "UPDATE tickets SET title='$title',content='$content',date='$date',category_id=$category_id WHERE id=$id";
        $done = mysqli_query($db, $sql);

//UPDATE THE TAG
        if ($done) {
            $tags_to_remove = array_diff($t_has_tags, $tagsA);

            $sql = "";
            foreach ($tagsA as $tag) {
                $sql .= "INSERT IGNORE INTO tickets_has_tags (tags_id,tickets_id) VALUES ($tag,$id); ";
            }
            foreach ($tags_to_remove as $tag) {
                $sql .= "DELETE FROM tickets_has_tags WHERE tags_id=$tag AND tickets_id=$id; ";
            }
            if (mysqli_multi_query($db, $sql)) {
                header('Location: ' . $_SERVER['REQUEST_URI']);
            } else {
                jsAlert("Les tags n'ont pas pu être ajouté. " . $dbSqlError);
            }
        } else {
            jsAlert("Le ticket n'a pas été mis à jour. " . $dbSqlError);
        }

    }

}else{
    header("Location: ".$rm_tickets_e);
}


?>
<h1>Modifier un ticket</h1>
<form class='add' method="post" novalidate>
    <label for="title">Titre de l'article</label></br>
    <input id="title" maxlength="255" type="text" name="title" value="<?= $ticket['title'] ?>" required></br>
    <label for="content">Contenu</label></br>
    <textarea id="content" name="content" placeholder="Votre article" required><?= $ticket['content'] ?></textarea></br>

    <?= datetimeInput($ticket['date']) ?>

    <label for="category">Catégorie</label></br>

    <select id="category" name="category">
        <option value="NULL"></option>
        <?php foreach ($categories as $cat): ?>
            <?php if ($cat['id'] == $ticket['category_id']): ?>
                <option value="<?= $cat['id'] ?>" selected><?= $cat['name'] ?></option>
            <?php else: ?>
                <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
    </select></br>

    <h3>Tags à associer</h3>

    <div id="tags">
        <?php foreach ($tags as $value): ?>
            <?php if (in_array($value['id'], $t_has_tags)): ?>
                <input id="t-<?= $value['id'] ?>" type="checkbox" name="tags[]" value="<?= $value['id'] ?>" checked>
            <?php else: ?>
                <input id="t-<?= $value['id'] ?>" type="checkbox" name="tags[]" value="<?= $value['id'] ?>">
            <?php endif; ?>

            <label for="t-<?= $value['id'] ?>"><?= $value['name'] ?></label>
        <?php endforeach; ?>
    </div>
    <button type="submit" name="update">Modifier</button>
</form>

