<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=newdawn', 'root', '');
//SOUCIS DE DERNIERE MINUTE SQLITE MA POSE UN FUCKING LAPIN DU COUP JE PASSE A L"ARRACHE A MYSQL, ET DEVINEZ QUOI SOUCIS D'ENCODAGE,
// JE TOURNE EN ROND COMME UN CON PARCE QUE MES JSON_ENCODE NE COMPRENNE PAS que c'est quand même de l'utf8.
    //tout ça parce que j'ai oublié cette foutue requete...........
    $db->query('SET NAMES UTF8');
//    $db = new PDO('mysql:host=localhost;dbname=newdawn', 'root', '');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
