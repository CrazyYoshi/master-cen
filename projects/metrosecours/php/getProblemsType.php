<?php
header('Access-Control-Allow-Origin: *');
require 'connect_db.php';

$pb = $db->query("SELECT * FROM problem_type")->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($pb,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);