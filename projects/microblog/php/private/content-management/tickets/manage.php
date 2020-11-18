<?php



if(isset($_GET['id'])){

    require_once $root."/private/content-management/tickets/edit.php";

}
else{
    require_once $root."/private/content-management/tickets/bulk.php";

}