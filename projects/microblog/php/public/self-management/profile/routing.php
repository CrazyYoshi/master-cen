
<ul id="submenu_profile">
    <li><a href="<?= $r_profile_e ?>"> Modifier mon profil</a></li>
    <li><a href="<?= $r_profile_c ?>"> Mon profil</a></li>
</ul>

<?php



if(isset($_GET[$g_profile_e])){
    require $root.'/public/self-management/profile/edit.php';

}elseif(isset($_GET[$g_profile_c])){
    require $root.'/public/self-management/profile/consult.php';
}

elseif($_SERVER['REQUEST_URI'] != $r_profile) {

    header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
    readfile($root.'/customs_errors/error404.php');
    exit(1);

}
else{
    $H1 = "SALUT TOI !";
    $p = "Bonjour, vous êtes perdu ? ça tombe bien! moi aussi. Je sais pas trop quoi mettre ici, du coup ça pourrait être sympa de cliquer sur un des boutons du menu pour retourner sur le droit chemin !  Allez tchou :)";
}




?>


<?php if(isset($H1)): ?>
<h1><?=$H1?></h1>
<p><?=$p?></p>
<?php endif ?>