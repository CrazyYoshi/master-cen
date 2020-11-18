<?php
//autorise requêtes externes
header('Access-Control-Allow-Origin: *');

//inclue un autre fichier php
require 'connect_db.php';

$data = [];
$data['success'] = false;
$data['msg'] = "";

$data['form']=[];
$data['form']['pseudo']= "";
$data['form']['passwd']= "";
$data['form']['msg'] = "";

$isAutoConnect = false;

    /*initialisation des variables
    Si la variable globale POST*/
if(isset($_POST)){

    $pseudo = (isset($_POST['pseudo'])) ? $_POST['pseudo'] : '';
    $passwd =(isset($_POST['passwd'])) ? $_POST['passwd'] : '';
    $isAutoConnect = (isset($_POST['isAuto'])) ? $_POST['isAuto'] : false;
    $hash = (isset($_POST['h']))? $_POST['h'] : '';
    $id = (isset($_POST['i']))? $_POST['i'] : '';

}

/*$pseudo = "crazyyoshi";
$passwd = "azerty";
$isAutoConnect = false;
$hash ='$2y$10$oJJ6vgQqywpCVXyTpo3Y7.QmlBAx6PAFXxOlCINNuRz2jqbioFXVa';
$id = 1;*/

if($isAutoConnect){
    $sql = "Select * FROM utilisateur WHERE id = $id AND password='$hash'";
    $query = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    $data['user']=$query[0];
    $data['success']=true;
}
else{
    $sql = "Select * FROM utilisateur WHERE pseudo = '$pseudo'";
    $query = $db->query($sql)->fetchAll(PDO::FETCH_ASSOC);

    if(!empty($query)){
        if(password_verify($passwd, $query[0]['password'])){
            $data['user']=$query[0];
            $data['success']=true;
        }
        else{
            $data['success']=false;
            $data['msg']="La connexion a échouée";
            $data['form']['passwd']="Le mot de passe est incorrect";
        }
    }
    else{
        $data['success']=false;
        $data['msg']="La connexion a échouée";
        $data['form']['passwd']="Le pseudo n'existe pas dans la base de données";
    }
}


header ('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

