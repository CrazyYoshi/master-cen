<?php
header('Access-Control-Allow-Origin: *');
require 'connect.php';
$experience = $db->query("SELECT * FROM experience")->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($experience);
