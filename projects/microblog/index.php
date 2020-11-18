<?php
//HEADER

global $root;
$root = $_SERVER['DOCUMENT_ROOT']."/php";

include_once($root.'/functions/database.php');
include_once($root.'/functions/messages.php');
include_once($root.'/functions/functions.php');

include_once($root.'/private/global-routing.php');



require($root.'/public/page-components/header.php');

//
require($root.'/public/page-components/routing.php');


require($root.'/public/page-components/footer.php');
