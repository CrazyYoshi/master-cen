<?php
//autorise requêtes externes
header('Access-Control-Allow-Origin: *');

//inclue un autre fichier php
require 'connect_db.php';

$data = [];
$data['success'] = false;
$data['error'] = false;
$data['msg'] = "";
$i = $p = $e = $t = $passwd = null;

//initialisation des variables
//Si la variable globale POST
if (isset($_POST)) {

    $i = $_POST['id'];
    $p = $_POST['pseudo'];
    $e = $_POST['email'];
    $t = $_POST['tel'];
    $passwd = isset($_POST['passwd']) ? $_POST['passwd'] : null;


}

$sql = "UPDATE `utilisateur` SET `pseudo` = '$p', `tel` = '$t', `email` = '$e'";

if ($passwd !== null) {
    $passwd = password_hash($passwd, PASSWORD_DEFAULT);
    $sql .= ", `password` = '$passwd' ";
}

$sql .= " WHERE `utilisateur`.`id` = $i";

if ($db->query($sql)) {
    $data['success'] = true;
    $data['msg'] = "Données mises à jour";
    $u = [];
    $u["p"] = $p;
    $u['e'] = $e;
    $u['t'] = $t;
    $u['i'] = $i;
    if ($passwd !== null)
        $u['password'] = $passwd;

    $data['user'] = $u;
} else {
    $data['success'] = false;
    $data['msg'] = "Les données n'ont pas pu être mises à jour.";
}

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

