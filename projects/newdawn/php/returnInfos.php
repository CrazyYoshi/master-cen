<?php
header('Access-Control-Allow-Origin: *');
require 'connect.php';

$infos = $db->query("SELECT * FROM personal_info")->fetchAll(PDO::FETCH_ASSOC);
header('Content-Type: application/json');
echo json_encode($infos);

