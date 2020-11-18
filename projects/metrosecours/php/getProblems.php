<?php
header('Access-Control-Allow-Origin: *');
require 'connect_db.php';

$pbs = $db->query("SELECT u.pseudo, p.date, p.id, pt.type as problem, pt.path as icon, l.name as line, s.name as station FROM `problem` as p inner join utilisateur as u on p.utilisateur_id=u.id inner join problem_type as pt on p.problem_type_id=pt.id INNER JOIN station as s on s.id = p.station_id inner join line as l on l.id=p.line_id")->fetchAll(PDO::FETCH_ASSOC);


header('Content-Type: application/json');
echo json_encode($pbs,JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);