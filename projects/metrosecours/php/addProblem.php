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

    $date = $_POST['date'];
    $ptype = $_POST['problem_type_id'];
    $sid = $_POST['station_id'];
    $lid = $_POST['line_id'];
    $uid = $_POST['utilisateur_id'];


}

$sql = "INSERT INTO `problem` (`id`, `date`, `problem_type_id`, `station_id`, `line_id`, `utilisateur_id`) VALUES (NULL, '$date', '$ptype', '$sid', '$lid', '$uid')";

if ($db->query($sql)) {
    $data['success'] = true;
    $data['msg'] = "Problème ajouté";

} else {
    $data['success'] = false;
    $data['msg'] = "L'incident n'a pas pu être ajouté.";
}

header('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

