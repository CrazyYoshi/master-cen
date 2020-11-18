<?php

date_default_timezone_set('Europe/Paris');


$sql="SELECT * FROM category";
$result = mysqli_query($db,$sql);

$categories = array();

while($cat =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $categories[]=$cat;
}
$sql="SELECT * FROM tags";
$result = mysqli_query($db,$sql);

$tags = array();

while($tag =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $tags[]=$tag;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add'])) {

        $title = $_POST['title'];
        $content = htmlentities($_POST['content'], ENT_QUOTES , 'UTF-8');
        $date = $_POST['date'] . " " . $_POST['hour'];
        $user_id = $_SESSION['user']['id'];
        $category_id = $_POST['category'];
        $tagsA = $_POST['tags'];
        $url = (empty($_POST['url']) ? formatUrlFriendly($db, $title) : formatUrlFriendly($db, $_POST['url']));

        $sql = "INSERT INTO tickets(`title`,`content`,`date`,`user_id`,`category_id`,`url`) VALUES('$title','$content','$date','$user_id','$category_id','$url')";
        mysqli_query($db, $sql);
        $ticket_id = mysqli_insert_id($db);

        $sql = "";
        foreach ($tagsA as $tag) {
            $sql .= "INSERT INTO tickets_has_tags (tickets_id, tags_id) VALUES($ticket_id,$tag);";
        }
        mysqli_multi_query($db, $sql);

    }
}

?>
<h1>Ajouter un ticket</h1>
<form class='add' method="post" novalidate>
    <label for="title">Titre de l'article</label></br>
    <input id="title" maxlength="255" type="text" name="title" placeholder="Titre de l'article" required></br>
    <label for="content">Contenu</label></br>
    <textarea id="content" name="content" placeholder="Votre article" required></textarea></br>

    <?= datetimeInput() ?>

    <label for="category">Catégorie</label></br>
    <select id="category" name="category">
        <option value="NULL" selected></option>
        <?php foreach($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
        <?php endforeach; ?>
    </select></br>

    <label for="title">Url de l'article</label></br>
    <input id="title" maxlength="255" type="text" name="url" placeholder="url-personnalise"></br>
    <p class="important">Si laissé vide, une URL sera générée sur la base du titre.</p>

    <h3>Tags à associer</h3>
    <div id="tags">
        <?php foreach ($tags as $value): ?>
            <input id="t-<?= $value['id'] ?>" type="checkbox" name="tags[]" value="<?= $value['id'] ?>">
            <label for="t-<?= $value['id'] ?>"><?= $value['name'] ?></label>
        <?php endforeach; ?>
    </div>

    <button type="submit" name="add">Ajouter</button>
</form>

