<?php
//GET ALL TICKETS
$WHERE = ($_SESSION['user']['permissions'] >= "2" ? "" : " WHERE user_id='{$_SESSION['user']['id']}'");


$sql = " SELECT";
$sql .= "   `user`.`login` as author,";
$sql .= "   `category`.`name` as category,";
$sql .= "   `tickets`.*";
$sql .= " FROM";
$sql .= "   `tickets`";
$sql .= " LEFT JOIN";
$sql .= "   `user` ON `user`.`id` = `tickets`.`user_id`";
$sql .= " LEFT JOIN";
$sql .= "   `category` ON `category`.`id` = `tickets`.`category_id`";
$sql .= " $WHERE";

$result = mysqli_query($db, $sql);

$tickets = array();

while ($ticket = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $tickets[$ticket['id']] = $ticket;
}
//GET ALL CATEGORIES

$sql = "SELECT * FROM category";
$result = mysqli_query($db, $sql);
$categories = array();
while ($category = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
    $categories[$category['id']] = $category;
}


//UPDATE TICKETS

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['updated'])) {

        $keys = array_keys($_POST['update']);
        $toDelete = (isset($_POST['toDelete']) ? $_POST['toDelete'] : array());
        $ticket_to_upd = array_diff($keys, $toDelete);
        $sql = "";

        foreach ($tickets as &$value) {
            unset($value['content']);
            unset($value['user_id']);
        }

        //Updating entries
        foreach ($ticket_to_upd as $i) {

//            var_dump(array_diff_assoc($categories[$i], $_POST['update'][$i]));
//            var_dump($categories[$i],$_POST['update'][$i]);

            //Verify diff between db and form entries
            if (array_diff_assoc($tickets[$i], $_POST['update'][$i])) {
//                var_dump(array_diff_assoc($getDatas[$i], $_POST['update'][$i]));
                //To update
                $updated_title = cleanWhitespace($db, $_POST['update'][$i]['title']);
                $updated_url = (empty($_POST['update'][$i]['url']) ? formatUrlFriendly($db, $_POST['update'][$i]['title']) : formatUrlFriendly($db, $_POST['update'][$i]['url']));
                $updated_id = $_POST['update'][$i]['id'];
                $updated_cat = (empty($_POST['update'][$i]['category_id']) ? "NULL" : $_POST['update'][$i]['category_id']);

                $sql .= "UPDATE";
                $sql .= " `tickets`";
                $sql .= " SET";
                $sql .= "  `title` = \"$updated_title\",";
                $sql .= "  `url` = \"$updated_url\",";
                $sql .= "  `category_id` = $updated_cat";
                $sql .= " WHERE";
                $sql .= "  `id` = $updated_id; ";

            } else {
                //To ignore
            }

        }

        //        Removing entries

        foreach ($toDelete as $i) {

            $sql .= "DELETE FROM tickets_has_tags WHERE tickets_id=$i;";
            $sql .= "DELETE FROM tickets WHERE id=$i;";
        }

        //Executing SQL query
        if (mysqli_multi_query($db, $sql)) {
            //Success
            header("Location: " . $_SERVER['REQUEST_URI']);
        } else {
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

<h1>Gestion des tickets</h1>

<?php if (count($tickets) > 0): ?>
    <form method="post">
        <table>

            <tr>
                <th>Titre</th>
                <th>Url</th>
                <th>Auteur</th>
                <th>Catégorie</th>
                <th>Date de parution</th>
                <th>Lien vers l'article</th>
                <th>Modifier l'article</th>
                <th class="reset"><input id="master-del" type="checkbox" onclick="toggle(this)"><label for="master-del">Tout supprimer</label></th>
            </tr>
            <?php foreach ($tickets as $ticket): ?>
                <?php

                $datetime = new DateTime($ticket['date']);
                $date = $datetime->format('d/m/Y');
                $h = $datetime->format('H');
                $m = $datetime->format('i');

                ?>

                <tr>
                    <!--ID                    -->
                    <input type="hidden" name="update[<?= $ticket['id'] ?>][id]" value="<?= $ticket['id'] ?>">
                    <!-- Title-->
                    <td><input type="text" name="update[<?= $ticket['id'] ?>][title]" value="<?= $ticket['title'] ?>">
                    </td>
                    <!--URL  -->
                    <td><input type="text" name="update[<?= $ticket['id'] ?>][url]" value="<?= $ticket['url'] ?>"></td>
                    <!--Author -->
                    <td><a href=""><?= $ticket['author'] ?></a></td>
                    <input type="hidden" name="update[<?= $ticket['id'] ?>][author]" value="<?= $ticket['author'] ?>">
                    <!--Category-->
                    <td>
                        <input type="hidden" name="update[<?= $ticket['id'] ?>][category]"
                               value="<?= $ticket['category'] ?>">
                        <select name="update[<?= $ticket['id'] ?>][category_id]">
                            <option value=""></option>
                            <?php foreach ($categories as $cat): ?>

                                <?php if ($cat['name'] == $ticket['category']): ?>
                                    <option value="<?= $cat['id'] ?>" selected><?= $cat['name'] ?></option>
                                <?php else: ?>
                                    <option value="<?= $cat['id'] ?>"><?= $cat['name'] ?></option>
                                <?php endif; ?>

                            <?php endforeach; ?>
                        </select>
                    </td>
                    <!--Date                    -->
                    <input type="hidden" name="update[<?= $ticket['id'] ?>][date]" value="<?= $ticket['date'] ?>">
                    <td class="pure-cell"><?= "Le " . $date . " à " . $h . "h" . $m ?></td>
                    <!--edit link-->
                    <td><a target="_blank" href="<?= $r_tickets . "/" . formatUrlFriendly($db, $ticket['title']) ?>">Lire</a>
                    </td>

                    <td><a target=""
                           href="<?= $rm_tickets_e . "/" . $ticket['id'] . "/" . formatUrlFriendly($db, $ticket['title']) ?>">Edition</a>
                    </td>
                    <td><input id="del-<?= $ticket['id'] ?>" type="checkbox" name="toDelete[]" value="<?= $ticket['id'] ?>"><label for="del-<?= $ticket['id'] ?>">Supprimer</label></td>
                </tr>
            <?php endforeach; ?>
            <tr class="submit-row">
                <td colspan="8">
                    <button type="submit" name="updated"
                            onclick="return confirm('Les entrées selectionnées seront supprimées et les modifications enregistrées ?');">
                        Mettre à jour
                    </button>
                </td>
            </tr>

        </table>

    </form>
<?php else: ?>
    <p>Vous n'avez pas publié d'articles</p>
<?php endif; ?>