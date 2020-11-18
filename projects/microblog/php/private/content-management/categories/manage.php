<?php


$sql = "SELECT * FROM category";
$result = mysqli_query($db, $sql);

$categories = array();

while($category =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $categories[$category['id']]=$category;
}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['updated'])) {

        $keys = array_keys($_POST['update']);
        $toDelete = (isset($_POST['toDelete']) ? $_POST['toDelete'] : array());
        $cat_to_upd = array_diff($keys, $toDelete);
        $sql = "";

        //Updating entries
        foreach ($cat_to_upd as $i) {

//            var_dump(array_diff_assoc($categories[$i], $_POST['update'][$i]));
//            var_dump($categories[$i],$_POST['update'][$i]);

            //Verify diff between db and form entries
            if(array_diff_assoc($categories[$i],$_POST['update'][$i])){
                //To update
                $updated_cat = cleanWhitespace($db, $_POST['update'][$i]['name']);
                $updated_url = (empty($_POST['update'][$i]['url-friendly']) ? formatUrlFriendly($db, $_POST['update'][$i]['name']) : formatUrlFriendly($db, $_POST['update'][$i]['url-friendly']));
                $updated_desc = cleanWhitespace($db, $_POST['update'][$i]['desc']);
                $updated_id = $_POST['update'][$i]['id'];

                $sql .= "UPDATE";
                $sql .= " `category`";
                $sql .= " SET";
                $sql .= "  `name` = \"$updated_cat\",";
                $sql .= "  `url-friendly` = \"$updated_url\",";
                $sql .= "  `desc` = \"$updated_desc\"";
                $sql .= " WHERE";
                $sql .= "  `id` = $updated_id; ";

            }
            else{
                //To ignore
            }

        }

            //        Removing entries

        foreach ($toDelete as $i){
            $sql .= "UPDATE `tickets` SET `category_id` = NULL WHERE `tickets`.`category_id` = $i;";
            $sql.= "DELETE FROM category WHERE id=$i;";
        }

            //Executing SQL query
        if(mysqli_multi_query($db,$sql)){
            //Success
            header("Location: " . $_SERVER['REQUEST_URI']);
        }
        else{
            //Fail
            var_dump($sql);
            jsAlert($dbSqlError);
        }

    }
}
?>
<script>
    function toggle(source) {
        checkboxes = document.getElementsByName('toDelete[]');
        for(var i=0, n=checkboxes.length;i<n;i++) {
            checkboxes[i].checked = source.checked;
        }
    }
</script>

<h1>Gestion des catégories</h1>

    <form method="post">
        <table>

            <tr>
                <th>Catégorie</th>
                <th>Description</th>
                <th>Tag-url</th>
                <th class="reset"><input id="master-del" type="checkbox" onclick="toggle(this)"><label for="master-del">Tout supprimer</label></th>
            </tr>
            <?php foreach ($categories as $cat): ?>
                    <tr>
                        <td style="display: none"><input type="text" name="update[<?= $cat['id'] ?>][id]" value="<?= $cat['id']?>"></td>
                        <td><input type="text" name="update[<?= $cat['id'] ?>][name]" value="<?= $cat['name']?>" required></td>
                        <td><textarea type="text" name="update[<?= $cat['id'] ?>][desc]"><?= $cat['desc']?></textarea></td>
                        <td><input type="text" name="update[<?= $cat['id'] ?>][url-friendly]" value="<?= $cat['url-friendly']?>"></td>
                        <td><input id="del-<?= $cat['id'] ?>" type="checkbox" name="toDelete[]" value="<?= $cat['id'] ?>"><label for="del-<?= $cat['id'] ?>">Supprimer</label></td>
                    </tr>
            <?php endforeach; ?>
            <tr class="submit-row">
                <td colspan="5"><button type="submit" name="updated" onclick="return confirm('Les entrées selectionnées seront supprimées et les modifications enregistrées ?');">Mettre à jour</button></td>
            </tr>

        </table>
    </form>

