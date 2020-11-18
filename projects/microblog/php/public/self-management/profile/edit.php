<?php


$errMail = $errPass = $errNewPass = $logErr = "";

if (!isset($_SESSION['user'])) {
    header('Location: /');
} else {

    $name = $_SESSION['user']['name'];
    $lastname = $_SESSION['user']['lastname'];
    $email = $_SESSION['user']['email'];

}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['profil'])) {
        $log = $_POST['profile'];

        foreach ($log as &$value) {
            $value = cleanWhitespace($db, $value);
        }
        $modif = array();

        $query_hash = "SELECT * FROM user WHERE id='{$_SESSION['user']['id']}'";
        $result = mysqli_query($db, $query_hash);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $passdb = $row['passwd'];
            $passwd = $log['passwd'];
            if (password_verify($passwd, $passdb)) {

                foreach ($log as $key => $value) {

                    if ($key != "passwd" && $key != "newpass" && $key != "newpassv" && $key != "email") {
                        if ($value != "") {
                            $modif[$key] = $value;
                        }
                    }
                }

                if ($log['newpass'] != "" && $log['newpassv'] != "" && $log['newpass'] == $log['newpassv']) {
                    $modif['passwd'] = password_hash($log['newpass'], PASSWORD_DEFAULT);
                } elseif ($log['newpass'] != $log['newpassv']) {
                    $errNewPass = $pwdDiff;
                }
                if ($log['email'] != "") {
                    $testmail = "SELECT * FROM user WHERE email='{$log['email']}'";
                    $querymail = mysqli_query($db, $testmail);
                    if (mysqli_num_rows($querymail) == 0) {
                        $modif['email'] = $log['email'];
                    } else {
                        $errMail = $mailTaken;
                    }
                }

                $SQL = "UPDATE `user` SET ";
                $nbmodifs = count($modif);
                $index = 0;
                $SQL = (($nbmodifs > 0) ? "UPDATE `user` SET " : "");
                foreach ($modif as $column => $value) {
                    $iteration = " $column = '$value' ";
                    if ($index + 1 != $nbmodifs) {
                        $SQL .= $iteration . ",";
                    } else {
                        $SQL .= $iteration;
                    }
                    $index++;
                }
                if ($SQL != "") {
                    $SQL .= "WHERE id={$_SESSION['user']['id']}";
                    mysqli_query($db, $SQL);
                    $queryUD = "SELECT * FROM user WHERE id='{$_SESSION['user']['id']}'";
                    $result = mysqli_query($db, $queryUD);
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    unset($row['passwd']);
                    $_SESSION['user'] = $row;
                    header('Location: /profile/edit');
                }


            } else {
                $errPass = $wrongPwd;
            }
        } else {
            $logErr = $dbSqlError;
        }


    }
}

?>

<h1>Mon Profil</h1>
<form method="post">
    <label for="name">Prénom</label>
    <input id="name" type="text" name="profile[name]" placeholder="<?= $name ?>">
    <label for="lastname">Nom</label>
    <input id="lastname" type="text" name="profile[lastname]" placeholder="<?= $lastname ?>">
    <label for="email">e-mail</label>
    <input id="email" type="text" name="profile[email]" placeholder="<?= $email ?>">
    <?= $errMail ?>
    <label for="newpass">Nouveau mot de passe</label>
    <input id="newpass" type="password" name="profile[newpass]" placeholder="Password">
    <label for="newpassv">Confirmez le mot de passe</label>
    <input id="newpassv" type="password" name="profile[newpassv]" placeholder="Confirm password">
    <?= $errNewPass ?>
    <label for="passwd">Mot de passe actuel*</label>
    <input id="passwd" type="password" name="profile[passwd]" placeholder="Password" required>
    <?= $errPass ?>
    <button type="submit" name="profil">Modifier mon profil</button>
    <?= $logErr ?>
</form>
