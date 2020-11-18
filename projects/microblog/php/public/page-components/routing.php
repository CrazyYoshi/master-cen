
<div id="container">
<?php


if(isset($_GET[$g_search])){
    require $root.'/public/search.php';
}
elseif(isset($_GET[$g_register])){
    require $root.'/public/self-management/profile/create.php';
}
elseif(isset($_GET[$g_connect])){
    require $root.'/public/self-management/profile/connect.php';
}
elseif(isset($_GET[$g_profile])){
    require $root.'/public/self-management/profile/routing.php';
}
elseif(isset($_GET[$g_ticket])){
    require $root.'/public/ticket.php';
}
//Disconnect
elseif(isset($_GET[$g_disconnect])){
    unset($_SESSION['user']);
    session_destroy();
    header('Location: '.$r_home);
}
// Page do not exist
elseif($_SERVER['REQUEST_URI'] != $r_home && !isset($_GET['t-by-c']) && !isset($_GET['t-by-t'])) {
    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    readfile($root.'/customs_errors/error404.php');
    exit(1);
}
else{
    require $root.'/public/content.php';
}




?>

</div>
