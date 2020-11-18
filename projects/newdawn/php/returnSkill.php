<?php
header('Access-Control-Allow-Origin: *');
require 'connect.php';

$categories = [];

foreach ($db->query("SELECT * FROM skill_category")->fetchAll(PDO::FETCH_ASSOC) as $row){
    $categories[$row['id']]=$row;
    $categories[$row['id']]['skills'] = [];
}

foreach($db->query("SELECT * FROM skill")->fetchAll(PDO::FETCH_ASSOC) as $row){

    $categories[$row['category_id']]['skills'][] = $row;
}

header('Content-Type: application/json');
echo json_encode($categories);


