<?php


$sql = "SELECT * FROM user";
$result = mysqli_query($db, $sql);

$users = array();

while($user =  mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $users[]=$user;
}

?>
<h1>Liste des utilisateurs</h1>

<table class="pure-table">

    <tr>
        <th>Identifiant</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Email</th>
        <th>Niveau de permission</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= $user['login']?></td>
            <td><?= $user['lastname']?></td>
            <td><?= $user['name']?></td>
            <td><?= $user['email']?></td>
            <td><?= permissionStr($user['permissions'])?></td>
        </tr>
    <?php endforeach; ?>


</table>

