<?php



if(isset($_GET['login'])){

    require_once $root."/private/content-management/users/edit.php";

}
else{
    require_once $root."/private/content-management/users/bulk.php";

}