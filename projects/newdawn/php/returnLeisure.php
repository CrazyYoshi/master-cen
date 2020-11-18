<?php

header('Access-Control-Allow-Origin: *');
require 'connect.php';

$leisure = $db->query("SELECT * FROM leisure")->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($leisure);
