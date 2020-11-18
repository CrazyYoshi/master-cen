<?php

$sql = "SELECT * FROM tags";
$result = mysqli_query($db,$sql);
$tags = array();

while($tag =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $tags[]=$tag;
}

foreach($tags as &$tag){
    $sql = "SELECT * FROM tickets_has_tags WHERE tags_id={$tag['id']}";
    $res = mysqli_query($db,$sql);

    $tag['nb_tickets']= mysqli_num_rows($res);
}
