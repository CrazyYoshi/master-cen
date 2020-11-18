<?php
//autorise requêtes externes
header('Access-Control-Allow-Origin: *');

//inclue un autre fichier php
require 'connect_db.php';

$data = [];
$data['success'] = false;
$data['error'] = false;
$data['msg'] = "";

//initialisation des variables
//Si la variable globale POST
if(isset($_POST)){

    $pseudo = $_POST['pseudo'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $passwd = $_POST['passwd'];

}

$verifMailQuery = "Select * FROM utilisateur WHERE email = '$email'";
$verifPseudoQuery = "Select * FROM utilisateur WHERE pseudo = '$pseudo'";

$resultMail = $db->query($verifMailQuery)->fetchAll(PDO::FETCH_ASSOC);
$resultPseudo = $db->query($verifPseudoQuery)->fetchAll(PDO::FETCH_ASSOC);


//Si le pseudo n'est pas utilisé
if (empty($resultPseudo)) {
    //$data['pseudo'] = "Le pseudo disponible";

    //Si l'adresse mail n'est pas utilisée
    if(empty($resultMail)){
        //$data['pseudo'] = "Adresse mail disponible";

        //On crypte le mot de passe
        $passwd = password_hash($passwd, PASSWORD_DEFAULT);
        //formate notre requête
        $sql = "INSERT INTO utilisateur (pseudo,email,tel,password) VALUES('$pseudo','$email','$tel','$passwd')";

        //var_dump($sql); //fonction de débuggage

        //Si notre requête est correctement soumise
        if($db->query($sql)){
            $data['success'] = true;
            $data['msg'] = "Inscription réussie.";

        }
        //Si notre requête n'est pas soumise
        else{
            $data['success'] = false;
            $data['error'] = true;
            $data['msg'] = "Un soucis est survenu de notre côté.";
        }
    }
    //Sinon l'adresse mail est déjà utilisée
    else
    {
        $data['error'] = true;
        $data['email'] = "L'adresse mail est déjà utilisée";
    }
}

//Sinon le pseudo est déjà utilisé.
else
{
    $data['error'] = true;
    $data['pseudo'] = "Le pseudo est déjà utilisé";
}


header ('Content-Type: application/json');
echo json_encode($data, JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);

