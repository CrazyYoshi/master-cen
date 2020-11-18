<?php
header('Access-Control-Allow-Origin: *');
require 'connect_db.php';

$lines = $db->query("SELECT id,name,color FROM line")->fetchAll(PDO::FETCH_ASSOC);

foreach($lines as &$line){
    $line['station'] = [];
    $line_has_station_Q = "SELECT s.id, s.name FROM `station` as s INNER JOIN line_has_station as lhs ON lhs.station_id=s.id WHERE lhs.line_id = {$line['id']}";
    $stations = $db->query($line_has_station_Q);

    if($stations){
        foreach($stations->fetchAll(PDO::FETCH_ASSOC) as &$station){
            $line['station'][]=$station;
        }
    }


}




header('Content-Type: application/json');
echo json_encode($lines,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);