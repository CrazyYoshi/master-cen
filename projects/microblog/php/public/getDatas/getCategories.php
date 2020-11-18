<?php

$sql = "SELECT * FROM category";
$result = mysqli_query($db,$sql);
$categories = array();

while($category =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $categories[]=$category;
}

foreach($categories as &$cat){
    $sql = "SELECT id FROM tickets WHERE category_id={$cat['id']}";
    $res = mysqli_query($db,$sql);

    $cat['nb_tickets']= mysqli_num_rows($res);
}

