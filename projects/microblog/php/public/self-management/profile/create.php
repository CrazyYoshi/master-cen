<?php

$loginErr = $emailErr = $passErr = $signUp  = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $user = $_POST['user'];
    $user['login'] = formatUrlFriendly($db,$user['login']);
    foreach ($user as &$value){
        $value = cleanWhitespace($db,$value);
    }

    $verifSQL = "SELECT * FROM user WHERE email='{$user['email']}'";
    $result = mysqli_query($db,$verifSQL);

    if(mysqli_num_rows($result)==0){

        $verifSQL = "SELECT * FROM user WHERE login='{$user['login']}'";
        $result = mysqli_query($db,$verifSQL);

        if(mysqli_num_rows($result)==0) {
            $loginErr="";


            if ($user['passwd'] == $user['passverif']) {

                $passErr="";
                $newpass = password_hash($user['passwd'], PASSWORD_DEFAULT);
                $user['passwd'] = $newpass;
                unset($user['passverif']);

                foreach($user as $key => $value){
                    $user[$key]=mysqli_real_escape_string($db,$value);
                }

                $sql = "INSERT INTO `user`(";
                $sql .= "`login`, `passwd`, `email`, `name`,";
                $sql .= "`lastname`";
                $sql .= ")";
                $sql .= "VALUES";
                $sql .= "(";
                $sql .= "'{$user['login']}', '{$user['passwd']}', '{$user['email']}', '{$user['name']}',";
                $sql .= "'{$user['lastname']}'";
                $sql .= ")";

                if(mysqli_query($db, $sql)){
                    setcookie('remember_me', $user['login'], time() + 3600);
                    unset($_POST['user']);
                    unset($user);
                    $signUp = $SU_success;
                    header('Refresh: 3; url='.$r_connect);
                }
                else {
                    $signUp = $dbSqlError;
                }
            }
            else{
                $passErr = $pwdDiff;
            }

        }
        else{
            $loginErr= $logTaken;
        }
    }
    else{
        $emailErr = $mailTaken;
    }

}

?>

<h1>Inscription</h1>

<form method="post">
    <label class='label' for="name">Prénom</label>
    <input id="name" type="text"      value='<?= (isset($_POST['user']['name'])) ?  $_POST['user']['name'] :"";?>'         placeholder="Prénom"   name='user[name]' required>

    <label class='label' for="lastname">Nom</label>
    <input id="lastname" type="text"      value='<?= (isset($_POST['user']['lastname'])) ? $_POST['user']['lastname']:"";?>'  placeholder="Nom"   name='user[lastname]'   required>

    <label class='label' for="email">e-Mail</label>
    <input id="email" type="email"     value='<?= (isset($_POST['user']['email'])) ?$_POST['user']['email']: "";?>'        placeholder="Adresse mail"   name='user[email]'     required>
    <?= $emailErr; ?>

    <label class='label' for="login">Identifiant</label>
    <input id="login" type="text"      value='<?= (isset($_POST['user']['login'])) ? $_POST['user']['login']: "";?>'       placeholder="Identifiant"   name='user[login]'     required>

    <?= $loginErr ?>

    <label class='label' for="passwd">Entrez un mot de passe</label>
    <input id="passwd" type="password"  name='user[passwd]'       placeholder="Mot de passe"  required>

    <label class='label' for="passverif">Confirmez votre mot de passe</label>
    <input id="passverif" type="password" name='user[passverif]'  placeholder="Mot de passe"  required>
    <?= $passErr ?>


    <button type="submit"   name="signup">Inscription</button>
    <?= $signUp ?>
</form>
