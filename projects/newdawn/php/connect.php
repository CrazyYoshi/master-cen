<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=newdawn', 'root', '');
    $db->query('SET NAMES UTF8');
} catch (PDOException $e) {
    print "Erreur !: " . $e->getMessage() . "<br/>";
    die();
}
