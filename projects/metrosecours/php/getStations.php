<?php
header('Access-Control-Allow-Origin: *');
require 'connect_db.php';

$stations = $db->query("SELECT id,name FROM station")->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($stations,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);