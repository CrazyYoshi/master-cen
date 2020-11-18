<?php session_start() ?>
<!doctype html>

<html>
<head>
    <meta charset="utf-8">
    <title>Micro Blog</title>
    <link href="/assets/css/public.css" rel="stylesheet" type="text/css"></head>

<body>


<nav>

    <ul>
        <h2 data="Circulez, y'a rien à voir">Le MicroBlog Par Miloud</h2>


        <!--        Si l'utilisateur n'est pas connecté ou inscrit on affiche les liens -->
        <?php if (!isset($_SESSION['user'])): ?>

            <li><a <?= (isset($_GET[$g_register])) ? 'class="active"' : '' ?> href="<?= $r_register ?>" data="Inscription">Inscription</a></li>
            <li><a <?= (isset($_GET[$g_connect])) ? 'class="active"' : '' ?> href="<?= $r_connect ?>" data="Connexion">Connexion</a></li>

            <!--Sinon c'est un lien vers son profil qui est proposé-->
        <?php else: ?>
            <li><a href="<?= $r_disconnect ?>" data="Ne me quittes pas">Déconnexion</a></li>

            <!--Si il a un compte avec privilège, on affiche le panneau de controle-->
            <?php if ($_SESSION['user']['permissions']): ?>
                <li><a href="<?= $rm_cp ?>" data="Okaeri">Gestion</a></li>
            <?php endif; ?>


            <li><a <?= (isset($_GET[$g_profile])) ? 'class="active"' : '' ?> href="<?= $r_profile_c ?>" data="Just me myself and I">Mon Compte</a></li>



        <?php endif; ?>


        <li><a <?= (isset($_GET[$g_search])) ? 'class="active"' : '' ?> href="<?= $r_search ?>" data="Find me!">Recherche</a></li>

        <li><a href="<?= $r_home ?>" data="I'm Lost! :'(">Accueil</a></li>


    </ul>
</nav>


