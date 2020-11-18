<?php

$profile_list = true;
require $root . '/public/getDatas/getTickets.php';

?>


<div>
    <h1>Mon profil</h1>
    <p>
        Nom : <?= $_SESSION['user']['name'] . " " . $_SESSION['user']['lastname'] ?>
        Adresse Mail : <?= $_SESSION['user']['email'] ?>
    </p>
    <div>
        <?php if (isset($tickets)): ?>
            <h2>Mes tickets</h2>

            <ul>
                <?php foreach ($tickets as $ticket): ?>
                    <li>
                        <a href="<?= $r_tickets . "/" . $ticket['url'] ?>"><?= $ticket['title'] ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>

            <p>Pas d'articles publié</p>

        <?php endif; ?>
    </div>
</div>