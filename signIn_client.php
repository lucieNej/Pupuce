<?php
require 'admin/database.php';

$db = Database::connect();

//j'initialise mes variables //l'utilisateur n'a pas encore cliqué = 1°lecture
$firstname = $name = $mail = $psw = "";
$firstnameError = $nameError = $mailError = $pswError = "";

// je crée une variable succes que j'initialise à false et je l'utilise en false à chaque fois que j'ai une erreur
$isSuccess = false;

//l'utilisateur à cliqué & soumis ses données maintenant je les initialise donc à ce qu'à donné l'utilisateur = 2°passage
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $firstname  = test_input($_POST['firstname']);
    $name       = test_input($_POST['name']);
    $mail       = test_input($_POST['mail']);
    $psw        = test_input($_POST['psw']);
    $isSuccess = true;


    $psw_hache = password_hash($_POST['psw'], PASSWORD_DEFAULT);
    

    $req = $db->prepare('INSERT INTO clients(client_firstname, client_name, client_email, client_psw) VALUES(:client_firstname, :client_name, :client_mail, :client_psw)');

    $req->execute(array(
        'client_firstname' => $firstname,
        'client_name' => $name,
        'client_mail' => $mail,
        'client_psw' => $psw
    ));
//je commence à poser mes questions : est-ce que le prénom est vide etc
    if(empty($firstname))
    {
        $firstnameError = "Mais quel est donc ton prénom ???";
        $isSuccess = false;
    }
    else
    {
        //????????????
    }

    if(empty($name))
    {
        $nameError = "Mais pourquoi es-tu si mystérieux ??!";
        $isSuccess = false;
    }

    if(!isEmail($mail)) //si ce n'est pas un email valide alors je rentre dans ce if (isEmail=true)
    {
        $mailError = "non c'est pas un email valide ça ! ;)";
        $isSuccess = false;
    }

    if(empty($psw))
    {
        $pswError = "t'inquiètes je ne peux pas voir ton mot de passe !";
        $isSuccess = false;
    }




    
}
else
{
    //echo "pb de connexion";
}


//header('Location: index.php');
//exit;

//des fonctions existent déjà pour vérifier & valider les emails -> filter_var 
function isEmail($email) 
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

//je vérifie et sécurise mes inputs avec cette fonction
function test_input($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
        <title>Pupuce</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet"> 
        <link rel="stylesheet" href="style.css">
    </head> 
<body>

    <div class="container site">
        <h1>Chez Pupuce</h1>

        <div class="row">
               <div>
               <!--j'utilise la superglobale server pour traiter les informations sur la même page -->
                    <form class="col-lg-8 img-thumbnail mx-auto p-5" method="post" action="<?php echo test_input($_SERVER['PHP_SELF']); ?>" role="form">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="firstname">Prénom <span class="blue"></span></label>
                                <input id="firstname" type="text" name="firstname" class="form-control" placeholder="Votre prénom" value="<?php echo $firstname; ?>">
                                <p class="comments font-italic"><?php echo $firstnameError; ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Nom <span class="blue"></span></label>
                                <input id="name" type="text" name="name" class="form-control" placeholder="Votre Nom" value="<?php echo $name; ?>">
                                <p class="comments font-italic"><?php echo $nameError; ?></p>
                            </div>
<div class="col-md-6">
                                <label for="mail">Email <span class="blue">*</span></label>
                                <input type="email" name="mail" class="form-control" placeholder="Votre Email" value="<?php echo $mail; ?>">
                                <p class="comments font-italic"><?php echo $mailError; ?></p>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Mot de passe </label>
                                <input type="password" name="psw" class="form-control" placeholder="Choisir un mot de passe" value="<?php echo $psw ; ?>">
                                <p class="comments font-italic"><?php echo $pswError; ?></p>
                            </div>
                            <div class="col-md-12">
                                <p class="blue"> Ces informations sont requises.</p>
                            </div>
                            <div class="col-md-12">
                                <input type="submit" class="btn btn-block btn-success" value="S'inscrir">
                            </div>
                        </div>
                        <p class="thx text-center font-weight-bold mt-3" style="display:<?php 

                        if($isSuccess) 
                        {
                            echo 'block ">Vous êtes bien inscrit :))) Merci '. $firstname. '<br><a class="btn btn-info mt-3 mr-5" href="index.php">Aller sur le site</a><a class="btn btn-success mt-3" href="logIn_client.php">Se connecter</a>';
                        }
                        else 
                        {
                            echo 'none ">'; 
                        }
                        ?>"> </p>
            </form>
                </div>
           </div>
    </div>



</body>
</html>