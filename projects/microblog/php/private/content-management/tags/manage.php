<?php

$sql = "SELECT * FROM tags";
$result = mysqli_query($db, $sql);

$tags = array();

while($tag =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $tags[$tag['id']]=$tag;
}
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['updated'])) {

        $keys = array_keys($_POST['update']);
        $toDelete = (isset($_POST['toDelete']) ? $_POST['toDelete'] : array());
        $tag_to_upd = array_diff($keys, $toDelete);
        $sql = "";

        //Updating entries
        foreach ($tag_to_upd as $i) {

//            var_dump(array_diff_assoc($categories[$i], $_POST['update'][$i]));
//            var_dump($categories[$i],$_POST['update'][$i]);

            //Verify diff between db and form entries
            if(array_diff_assoc($tags[$i],$_POST['update'][$i])){
                //To update
                $updated_name = cleanWhitespace($db, $_POST['update'][$i]['name']);
                $updated_tag = (empty($_POST['update'][$i]['tag']) ? formatUrlFriendly($db, $_POST['update'][$i]['name']) : formatUrlFriendly($db, $_POST['update'][$i]['tag']));
                $updated_id = $_POST['update'][$i]['id'];

                $sql .= "UPDATE";
                $sql .= " `tags`";
                $sql .= " SET";
                $sql .= "  `tag` = \"$updated_tag\",";
                $sql .= "  `name` = \"$updated_name\"";
                $sql .= " WHERE";
                $sql .= "  `id` = $updated_id; ";

            }
            else{
                //To ignore
            }

        }

        //        Removing entries

        foreach ($toDelete as $i){

            $sql.= "DELETE FROM tickets_has_tags WHERE tags_id=$i;";
            $sql.= "DELETE FROM tags WHERE id=$i;";
        }

        //Executing SQL query
        if(mysqli_multi_query($db,$sql)){
            //Success
            header("Location: " . $_SERVER['REQUEST_URI']);
        }
        else{
            //Fail
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
<h1>Gestion des tags</h1>

<form method="post">
    <table >

        <tr>
            <th>Nom d'affichage</th>
            <th>Tag-url</th>
            <th class="reset"><input id="master-del" type="checkbox" onclick="toggle(this)"><label for="master-del">Tout supprimer</label></th>
        </tr>
        <?php foreach ($tags as $tag): ?>

                <tr>
                    <td style="display: none"><input type="text" name="update[<?= $tag['id'] ?>][id]" value="<?= $tag['id']?>"></td>
                    <td><input type="text" name="update[<?= $tag['id'] ?>][name]" value="<?= $tag['name']?>"></td>
                    <td><input type="text" name="update[<?= $tag['id'] ?>][tag]" value="<?= $tag['tag']?>"></td>
                    <td><input id="del-<?= $tag['id'] ?>" type="checkbox" name="toDelete[]" value="<?= $tag['id'] ?>"><label for="del-<?= $tag['id'] ?>">Supprimer</label></td>
                </tr>

        <?php endforeach; ?>
        <tr class="submit-row">
            <td colspan="3"><button type="submit" name="updated"  onclick="return confirm('Êtes vous sûr de vouloir supprimer la selection ?');">Valider les changements</button></td>
        </tr>

    </table>
</form>

<?php

if(isset($notif)){
    jsAlert($notif);
}

?>