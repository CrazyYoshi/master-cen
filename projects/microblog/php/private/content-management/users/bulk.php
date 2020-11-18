<?php
//GET ALL USERS

$sql = " SELECT id,login,`name`,lastname,email,permissions  FROM `user`";


$result = mysqli_query($db, $sql);

$users = array();
while ($user = mysqli_fetch_array($result, MYSQLI_ASSOC)) {

    $users[$user['id']] = $user;
}


//UPDATE TICKETS

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['updated'])) {

        $keys = array_keys($_POST['update']);
        $toDelete = (isset($_POST['toDelete']) ? $_POST['toDelete'] : array());
        $users_to_upd = array_diff($keys, $toDelete);
        $sql = "";

        //Updating entries
        foreach ($users_to_upd as $i) {

//            var_dump(array_diff_assoc($categories[$i], $_POST['update'][$i]));
//            var_dump($categories[$i],$_POST['update'][$i]);

            //Verify diff between db and form entries
            if (array_diff_assoc($users[$i], $_POST['update'][$i])) {
                //To update
                $updated_login      = formatUrlFriendly($db, $_POST['update'][$i]['login']);
                $updated_name       = cleanWhitespace($db, $_POST['update'][$i]['name']);
                $updated_lastname   = cleanWhitespace($db, $_POST['update'][$i]['lastname']);
                $updated_email      = cleanWhitespace($db, $_POST['update'][$i]['email']);
                $updated_permissions= $_POST['update'][$i]['permissions'];
                $updated_id         = $_POST['update'][$i]['id'];

                $sql .= "UPDATE";
                $sql .= " `user`";
                $sql .= " SET";
                $sql .= "  `login` = \"$updated_login\",";
                $sql .= "  `name` = \"$updated_name\",";
                $sql .= "  `lastname` = \"$updated_lastname\",";
                $sql .= "  `email` = \"$updated_email\",";
                $sql .= "  `permissions` = \"$updated_permissions\"";
                $sql .= " WHERE";
                $sql .= "  `id` = $updated_id; ";

            } else {
                //To ignore
            }

        }

        //        Removing entries

        foreach ($toDelete as $i) {

            $sql .= "UPDATE `tickets` SET `user_id` = NULL WHERE `tickets`.`user_id` = $i;";
            $sql .= "DELETE FROM `user` WHERE id=$i;";
        }
//        var_dump($sql);

        //Executing SQL query
        if (mysqli_multi_query($db, $sql)) {
            //Success
            header("Location: " . $_SERVER['REQUEST_URI']);
        } else {
            //Fail
            jsAlert($dbSqlError);
//            var_dump($sql);
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
<h1>Les utilisateurs</h1>
    <form method="post">
        <table>

            <tr>
                <th>Identifiant</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>eMail</th>
                <th>Niveau de permission</th>
                <th>Modifier</th>
                <th class="reset"><input id="master-del" type="checkbox" onclick="toggle(this)"><label for="master-del">Tout supprimer</label></th>
            </tr>
            <?php foreach ($users as $user): ?>
                <?php

                $readonly = ($user['id'] == $_SESSION['user']['id'] ? 'readonly="readonly"' : "");

                ?>

                <tr>
                    <td style="display: none"><input type="hidden" name="update[<?= $user['id'] ?>][id]"
                                                     value="<?= $user['id'] ?>"></td>

                    <td><input type="text" name="update[<?= $user['id'] ?>][login]" value="<?= $user['login'] ?>">
                    </td>
                    <td><input type="text" name="update[<?= $user['id'] ?>][lastname]" value="<?= $user['lastname'] ?>">
                    </td>
                    <td><input type="text" name="update[<?= $user['id'] ?>][name]" value="<?= $user['name'] ?>"></td>
                    <td><input type="email" name="update[<?= $user['id'] ?>][email]" value="<?= $user['email'] ?>"></td>
                    <td>
                        <select name="update[<?= $user['id'] ?>][permissions]">
                            <!--IF USER LOGGED-->
                            <?php if ($user['id'] == $_SESSION['user']['id']): ?>
                                <option value="<?= $perm_lvl[$user['permissions']][0] ?>"
                                        selected><?= $perm_lvl[$user['permissions']][1] ?></option>
                                <!--ELSE   OTHER USERS-->
                            <?php else: ?>
                                <?php foreach ($perm_lvl as $lvl): ?>

                                    <?php if ($user['permissions'] == $lvl[0]): ?>
                                        <option value="<?= $lvl[0] ?>" selected><?= $lvl[1] ?></option>
                                    <?php else: ?>
                                        <option value="<?= $lvl[0] ?>"><?= $lvl[1] ?></option>
                                    <?php endif; ?>

                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </td>
                    <td><a target="_blank" href="<?= $rm_users_e."/".$user['login'] ?>"><?= $user['login']?></a></td>
                    <td><input id="del-<?= $user['id'] ?>" type="checkbox" name="toDelete[]" value="<?= $user['id'] ?>"><label for="del-<?= $user['id'] ?>">Supprimer</label></td>
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
