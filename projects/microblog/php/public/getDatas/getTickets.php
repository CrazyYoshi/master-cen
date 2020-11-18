<?php

$sql = "SELECT DISTINCT "
    . "tickets.id as id, tickets.title as title, tickets.content as content, tickets.date as date, tickets.url as url, user.login as author, category.name as category, category.`url-friendly` as category_url "
    . "FROM tickets "
    . "LEFT JOIN user on tickets.user_id=user.id "
    . "LEFT JOIN category on tickets.category_id=category.id ";

if(isset($_GET[$g_categories]) and isset($_GET["category"])){
    $sql .= " WHERE category.`url-friendly`='{$_GET['category']}'";
}

elseif(isset($_GET[$g_tags]) and isset($_GET["tag"])){
    $sql .= " LEFT JOIN tickets_has_tags ON tickets_has_tags.tickets_id=tickets.id";
    $sql .= " LEFT JOIN tags ON tickets_has_tags.tags_id=tags.id";
    $sql .= " WHERE tags.tag = '{$_GET["tag"]}'";
}

elseif(isset($_GET[$g_search])){

    $sql .= " LEFT JOIN tickets_has_tags ON tickets_has_tags.tickets_id=tickets.id";
    $sql .= " LEFT JOIN tags ON tickets_has_tags.tags_id=tags.id";

    if($name != ""){
        $sql .= " WHERE ";

        $names = mysqli_real_escape_string($db, $name);
        $names = explode(" ", $names);
        $nb_keywords = count($names);
        $i = 0;
        foreach($names as $name){
            $sql .= " tickets.title LIKE '%$name%'";
            $i++;

            if($i != $nb_keywords){
                $sql .= " OR ";
            }

        }
        $key = "AND";

    }
    else{
        $key = "WHERE";
    }
    if($s_tags != 0){
        $sql .= " $key";
        $key = "AND";
        $i=0;
        foreach ($s_tags as $t){
            if($i == 0){
            $sql .= " tags.tag = '$t'";
            }
            else{
                $sql.= " $key tags.tag = '$t'";
            }
            $i++;
        }
    }
    if($s_cat!= 0){
        $sql .= " $key category.name = '$s_cat'";
    }

}

if(isset($profile_list)){
    $sql.= " WHERE user.id = {$_SESSION['user']['id']}";
    $profile_list = false;
}
$tickets = null;
$sql .= " ORDER BY `tickets`.`date` DESC";

$result = mysqli_query($db,$sql);

while($res = mysqli_fetch_array($result,MYSQLI_ASSOC)){
    $res['content']= html_entity_decode($res['content'],ENT_QUOTES, 'UTF-8');
    $tickets[] = $res;
}




if(!isset($tickets)){
    $_SESSION['search_result']="La recherche n'a retourné aucun résultats.";
}
else{
    unset($_SESSION['search_result']);
}

