<?php
//autorise requêtes externes
header('Access-Control-Allow-Origin: *');

//inclue un autre fichier php
require 'connect_db.php';

$data = [];
$data['success'] = false;
$data['error'] = false;
$data['msg'] = "";
$checkPseudo = false;
$checkEmail = false;
//initialisation des variables
//Si la variable globale POST
if (isset($_POST)) {
    $checkPseudo = isset($_POST['pseudo']);
    $checkEmail = isset($_POST['email']);

    $p = ($checkPseudo) ? $_POST['pseudo'] : "";
    $e = ($checkEmail) ? $_POST['email'] : "";
}

if ($checkEmail) {
    $MailQuery = "Select * FROM utilisateur WHERE email = '$e'";
    $data['mailAvailable'] = empty($db->query($MailQuery)->fetchAll(PDO::FETCH_ASSOC));
}
if ($checkPseudo) {
    $PseudoQuery = "Select * FROM utilisateur WHERE pseudo = '$p'";
    $data['pseudoAvailable'] = empty($db->query($PseudoQuery)->fetchAll(PDO::FETCH_ASSOC));
}


header('Content-Type: application/json');
echo json_encode($data,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);