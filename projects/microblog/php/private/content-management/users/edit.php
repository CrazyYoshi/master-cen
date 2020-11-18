<?php


//TICKETS DATA
$loginErr = $emailErr = $passErr = $signUp  = "";

$id = $_GET['login'];

$sql = "SELECT * FROM `user` WHERE login = '$id'";

if(mysqli_fetch_array(mysqli_query($db,$sql), MYSQLI_ASSOC)){
    $user = mysqli_fetch_array(mysqli_query($db,$sql), MYSQLI_ASSOC);


//UPDATE THE USER
    if($_SERVER["REQUEST_METHOD"] == "POST"){


        $user = $_POST['user'];


        $user['login'] = formatUrlFriendly($db,$user['login']);

        foreach ($user as &$value){
            $value = cleanWhitespace($db,$value);
        }

        $verifSQL = "SELECT id FROM user WHERE email='{$user['email']}'";
        $query = mysqli_query($db,$verifSQL);
        $result = mysqli_fetch_array($query,MYSQLI_ASSOC);

        if(mysqli_num_rows($query)==0 or $result['id'] == $user['id']){

            $verifSQL = "SELECT id FROM user WHERE login='{$user['login']}'";
            $query = mysqli_query($db,$verifSQL);
            $result = mysqli_fetch_array($query,MYSQLI_ASSOC);

            if(mysqli_num_rows($query)==0 or $result['id'] == $user['id']){

                    $user['passwd'] = (empty($user['passwd']) ?  "" : password_hash($user['passwd'], PASSWORD_DEFAULT));
                    foreach($user as &$value){
                        $value=mysqli_real_escape_string($db,$value);
                    }

                    $sql = "UPDATE `user` ";
                    $sql .= " SET ";
                    $sql .= " login = '{$user['login']}',";
                    $sql .= " name = '{$user['name']}',";
                    $sql .= " lastname = '{$user['lastname']}',";
                    $sql .= " email = '{$user['email']}'";
                    $sql .= (empty($user['passwd']) ? ""  : ", passwd = '{$user['passwd']}'");
                    $sql .= " WHERE id={$user['id']}";
                    if(mysqli_query($db, $sql)){

                        header("Location: ".$_SERVER['REQUEST_URI']);

                    }
                    else {
                        $signUp = $dbSqlError;
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

}else{
    header("Location: ".$rm_users_e);
}


?>
<h1>Modifier un utilisateur</h1>
<form method="post" class="add">
    <label for="name">Prénom</label>
    <input id="name" type="text"      value='<?= $user['name'] ?>'         placeholder="Prénom"   name='user[name]' >
    <input  type="hidden"      value='<?= $user['id'] ?>'         placeholder="Prénom"   name='user[id]' >

    <label for="lastname">Nom</label>
    <input id="lastname" type="text"      value='<?= $user['lastname']?>'  placeholder="Nom"   name='user[lastname]'   >

    <label for="email">e-Mail</label>
    <input id="email" type="email"     value='<?= $user['email']?>'        placeholder="Adresse mail"   name='user[email]'     required>
    <?= $emailErr ?>

    <label for="login">Identifiant</label>
    <input id="login" type="text"      value='<?= $user['login']?>'       placeholder="Identifiant"   name='user[login]'     required>
<?= $loginErr ?>

    <label for="passwd">Innitialiser un nouveau mot de passe (pas d'espaces)</label>
    <input id="passwd" type="password"  name='user[passwd]'       placeholder="Mot de passe">

    <button type="submit"   name="update">Modifier</button>
</form>


