<?php


$addCategory ="";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if($_POST['category']!= "" && $_POST['desc']!=""){
        $category = cleanWhitespace($db, $_POST['category']);
        $desc = cleanWhitespace($db, $_POST['desc']);
        $urlfriendly = formatUrlFriendly($db,$category);

        $sql ="INSERT INTO category(`name`,`desc`,`url-friendly`) VALUES('$category','$desc','$urlfriendly')";
        if(mysqli_query($db,$sql)){
            $addCategory = $categoryAdded;
        }
        else{
            $addCategory = $dbSqlError;
        }
    }
    else{
        $addCategory = $emptyInput;
    }

}

?>

<h1>Ajouter une catégorie</h1>
<div style="width: 80%">
    <?php var_dump($sql)?>
</div>
<form class='add' method="post">
    <label for="category">Nom de la catégorie</label><br>
    <input type="text" id="category" name="category" placeholder="Catégorie" maxlength="255"><br>
    <label for="desc">Décrivez la catégorie</label><br>
    <textarea class="normal" name="desc" id="desc" placeholder="Décrivez la catégorie"></textarea><br>
    <button type="submit">Ajouter la catégorie</button><br>
    <?= $addCategory ?>
</form>
