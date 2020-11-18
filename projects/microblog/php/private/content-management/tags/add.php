<?php


$addTag = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['tag']) && $_POST['tag'] != "") {
        $sql = "";
        $strTags = mysqli_real_escape_string($db, $_POST['tag']);
        $tags = explode(";", $strTags);
        $count = array();

        foreach ($tags as $tag) {

            if ($tag != "") {
                $name = cleanWhitespace($db, $tag);
                $tag = formatUrlFriendly($db, $tag);
                $sql .= "INSERT INTO tags (`tag`, `name`) VALUES ('$tag', '$name'); ";
                $count[] = $tag;
            }

        }
        if (mysqli_multi_query($db, $sql)) {
            if (count($count) > 1) {
                $addTag = $tagsAdded;
            } else {
                $addTag = $tagAdded;
            }
        }

    } else {
        $addTag = $emptyInput;
    }

}


?>


<h1> Ajouter des tags</h1>

<form class='add' method="post">
    <label for="tag">Votre tag, pour en ajouter plusieurs, séparez les par un point-virgule "recette;
        réussite"</label><br>
    <textarea class="normal" id="tag" name="tag" placeholder="Tag"></textarea><br>
    <button type="submit">Ajouter le tag</button>
    <br>
    <?= $addTag ?>
</form>
