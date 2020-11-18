<?php
header('Access-Control-Allow-Origin: *');
require 'connect.php';

$thetrail = $db->query("SELECT * FROM thetrail ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');

echo json_encode($thetrail);
