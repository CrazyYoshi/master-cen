<div>

    <h2>
        Panneau de contrôle
    </h2>

    <?php if ($_SESSION['user']['permissions']): ?>
        <h3>Articles</h3>
        <ul>
            <li><a href="<?= $rm_tickets ?>">Liste</a></li>
            <li><a href="<?= $rm_tickets_e ?>">Gérer</a></li>
            <li><a href="<?= $rm_tickets_a ?>">Ajouter</a></li>
        </ul>
        <?php if ($_SESSION['user']['permissions'] >= 2): ?>

            <h3>Catégories</h3>
            <ul>
                <li><a href="<?= $rm_categories ?>">Liste</a></li>
                <li><a href="<?= $rm_categories_e ?>">Gérer</a></li>
                <li><a href="<?= $rm_categories_a ?>">Ajouter</a></li>
            </ul>
            <h3>Tags</h3>
            <ul>
                <li><a href="<?= $rm_tags ?>">Liste</a></li>
                <li><a href="<?= $rm_tags_e ?>">Gérer</a></li>
                <li><a href="<?= $rm_tags_a ?>">Ajouter</a></li>
            </ul>
            <?php if ($_SESSION['user']['permissions'] >= 3): ?>


                <h3>Utilisateurs</h3>
                <ul>
                    <li><a href="<?= $rm_users ?>">Liste</a></li>
                    <li><a href="<?= $rm_users_e ?>">Gérer</a></li>
                </ul>
            <?php endif; ?>
            <?php endif; ?>
            <?php endif; ?>


</div>