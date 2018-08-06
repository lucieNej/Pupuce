<?php

require 'admin/database.php';


if(isset($_POST) && !empty($_POST['email']) && !empty($_POST['psw'])) {
  extract($_POST);

  // on recupère le password de la table qui correspond au login du visiteur
  $sql = "SELECT client_email, client_psw FROM clients WHERE client_email ='$email' AND client_psw = '$psw' ";
  $req = $db->query($sql) or die('Erreur SQL !<br>'.$sql.'<br>');

  $data = $req->fetch(PDO::FETCH_ASSOC);
//   var_dump($data);

  if($data['client_email'] != $email && $data['client_psw'] != $psw ) {
    echo '<p class="text-center mt-5 red">Mauvais login / password <br> Merci de recommencer</p>';
    
  
  }
  else {
    session_start();
    $_SESSION['client_email'] = $email;
    $_SESSION['client_psw'] = $psw;
    header ("Location: index.php");
   
    // ici vous pouvez afficher un lien pour renvoyer
    // vers la page d'accueil de votre espace membres
  }   
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

 <div class="d-flex justify-content-between">
    <a type="button" class="btn btn-info" href="index.html">Retour page d'accueil</a>
    <a class="btn btn-success" href="signIn_client.php">S'inscrire</a>
    
</div>

    <div class="container site accueil text-center">
        <div>
            
            <h1>Bienvenue chez Pupuce ! </h1>
        </div>

        <div class="container img-thumbnail col-md-8">
            <form method="post" action="logIn_client.php" role="form" class="text-center">
                <fieldset>
                    <legend><h1>Se connecter</h1></legend>
                    <div class="row">
                        <div class="offset-md-1 col-md-10">
                            <label for="name">Email adresse *</label>
                            <input type="email" name="email" class="form-control" placeholder="Votre email">
                            <p class="comments"></p>
                        </div>
                        <div class="offset-md-1 col-md-10">
                            <label for="psw">Mot de passe *</label>
                            <input type="password" name="psw" class="form-control" placeholder="Votre mot de passe">
                            <p class="comments"></p>
                        </div>
                        <div class="col-md-12">
                            <p> Ces informations sont requises.</p>
                        </div>
                        <div class="col-md-12">
                            <input type="submit" class="btn-success btn-lg btn-block mb-2" value="Valider">
                        </div>
                    </div>
<p class="thx text-center font-weight-bold mt-3"></p>

                </fieldset>
            </form>
        </div>


    </div>
</body>
</html>
