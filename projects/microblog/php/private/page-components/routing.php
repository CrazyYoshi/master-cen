<?php

//Utilisateur sans droit, pas connecté

if(!isset($_SESSION['user'])){
    jsAlert("Vous n'êtes pas connecté");
    header("Location: ".$r_connect);
}
elseif($_SESSION['user']['permissions']=="0"){
    jsAlert("Vous n'avez pas les droits!");
}

//Panneau de controle

elseif(isset($_GET[$gm_cp]) && $_SESSION['user']['permissions']>="1"){
    require $root.'/private/control-panel.php';
}

//Tickets

elseif(isset($_GET[$gm_tickets]) && $_SESSION['user']['permissions']>="1"){
    require $root.'/private/content-management/tickets/routing.php';
}

//Utilisateurs

elseif(isset($_GET[$gm_users]) && $_SESSION['user']['permissions']>="3"){
    require $root.'/private/content-management/users/routing.php';
}

//Tags

elseif(isset($_GET[$gm_tags]) && $_SESSION['user']['permissions']>="2"){
    require $root.'/private/content-management/tags/routing.php';
}

//Categories

elseif(isset($_GET[$gm_categories]) && $_SESSION['user']['permissions']>="2"){
    require $root.'/private/content-management/categories/routing.php';
}

//Autres - Erreurs

else{
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    header("Location: ".$rm_cp);
}