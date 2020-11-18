<?php


function cleanWhitespace($db, $string){
    return trim(mysqli_real_escape_string($db,preg_replace('/ +/', ' ', $string)));
}

function formatUrlFriendly($db, $string){

    $tag = mb_strtolower(trim($string), 'UTF-8');
    $tag = preg_replace('/ +/', ' ', $tag);
    $tag = iconv('utf-8', 'ascii//TRANSLIT', $tag);
    $tag = str_replace(' ', '-', $tag);
    $tag = preg_replace('/[^A-Za-z0-9\-]/', '', $tag);
    return  mysqli_real_escape_string($db, $tag);

}


function jsAlert($string){

    echo "<script>alert('$string')</script>";


}


function datetimeInput($value= null){

    $inputDate = (is_null($value) ? date('Y-m-d H:i:s') : $value);
    $disabled = "";
    $min = "";

    if(isset($value)){
        $D = new DateTime($value);
        $D = $D->format('Y-m-d H:i:s');
//        var_dump($D->format('Y-m-d H:i:s'),date('Y-m-d H:i:s'));
        if($D < date('Y-m-d H:i:s')){
            $disabled = 'readonly="readonly"';
        }
    }

    $browser =  get_uBrowser();

    if($browser != 'Firefox' and $browser != 'IE'){
        $datetime = new DateTime($inputDate);
        $mindate = ($disabled =="readonly=\"readonly\"" ? "" : "min='".date('Y-m-d')."'");
        $minhour = ($disabled =="readonly=\"readonly\"" ? "" : "min='".date('H:i:s')."'");

        $input = "<label for=\"date\">Date de parution</label></br>";
        $input .= "<input id = \"date\" type=\"date\" name=\"date\" value=\"{$datetime->format('Y-m-d')}\" $mindate $disabled></br>";
        $input .= "<p class=\"important\">Pour une publication a une date ultérieure.</p>";
        $input .= "<label for=\"hour\">Heure de parution</label></br>";
        $input .= "<input id=\"hour\" type=\"time\" name=\"hour\" value=\"{$datetime->format('H:i:s')}\" $disabled></br>";
        $input .= "<p class=\"important\">Pour planifier une publication, à une heure ultérieure. Fonctionnalité instable, ne pas toucher</p>";

        return $input;
    }
    else{
        $datetime = new DateTime($inputDate);
        $mindate = ($disabled =="readonly=\"readonly\"" ? "" : "min='".date('Y-m-d H:i:s')."'");

        $input = "<label for=\"date\">Date de parution</label></br>";
        $input .= "<input id=\"date\" type=\"datetime\" name=\"date\" value=\"{$datetime->format('Y-m-d H:i:s')}\" $mindate $disabled>";

        return $input;

    }


}


function get_uBrowser(){

    if(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE)
        $browser = "IE";
    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Trident') !== FALSE) //For Supporting IE 11
        $browser = "IE";
    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Firefox') !== FALSE)
        $browser = "Firefox";
    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') !== FALSE)
        $browser = "Chrome";
    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera Mini') !== FALSE)
        $browser = "Opera Mini";
    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Opera') !== FALSE)
        $browser = "Opera";
    elseif(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') !== FALSE)
        $browser = "Safari";
    else
        $browser = "Other";

    return $browser;

}



function permissionStr($int){

    switch ($int){
        case 0:
            $lvl = "Utilisateur";
            break;
        case 1:
            $lvl = "Rédacteur";
            break;
        case 2:
            $lvl = "Modérateur";
            break;
        case $int>2 :
            $lvl = "Administrateur";
            break;
    }

    return $lvl;


}