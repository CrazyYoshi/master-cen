<?php

$logErr = $passErr = "";
$login = $pass = "";

    $login = (isset($_COOKIE['remember_me']) ? $_COOKIE['remember_me'] : "");
if($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['signin'])) {

        $log = $_POST['log'];
        $log['login']=mysqli_real_escape_string($db, $log['login']);

        $query_hash = "SELECT * FROM user WHERE login='{$log['login']}'";
        $result = mysqli_query($db, $query_hash);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            $hash = $row['passwd'];
            $pass = $log['passwd'];
            if (password_verify($pass, $hash)) {
                unset($row['passwd']);
                $_SESSION['user'] = $row;

                if (isset($log['remember'])) {
                    setcookie('remember_me', $log['login'], time() + 36000);
                }

                header('Location: '.$r_profile_c);

            } else {
                $passErr = $wrongPwd;
            }
        } else {
            $logErr = $loginDoNotExist;
        }
    }
}

?>

    <h1>Connexion</h1>

<form method="post">
    <label class="label" for="login">Identifiant</label>
    <input type="text" id="login" name='log[login]' placeholder="Identifiant" value="<?= $login ?>" required>
    <?= $logErr ?>
    <label class="label" for="passwd">Mot de passe</label>
    <input type="password" id="passwd" name='log[passwd]' placeholder="Mot de passe"  required>
    <?= $passErr ?>
    <input type="checkbox" id="remember" name='log[remember]' value="1">
    <label class="small-label" for="remember">Se souvenir de moi</label>
    <button type="submit" name="signin">Connexion</button>
</form>


