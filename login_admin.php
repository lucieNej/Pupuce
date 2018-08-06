<?php

require 'admin/database.php';


if(isset($_POST) && !empty($_POST['user_nom']) && !empty($_POST['user_mdp'])) {
  extract($_POST);

  // on recupère le password de la table qui correspond au login du visiteur
  $sql = "SELECT user_mdp FROM users WHERE user_nom ='".$user_nom."'";
  $req = $db->query($sql) or die('Erreur SQL !<br>'.$sql.'<br>');

  $data = $req->fetch(PDO::FETCH_ASSOC);
//   var_dump($data);

  if($data['user_mdp'] != $user_mdp) {
    echo '<p class="text-center mt-5 red">Mauvais login / password <br> Merci de recommencer</p>';
    
  
  }
  else {
    session_start();
    $_SESSION['user_nom'] = $user_nom;
    header ("Location: admin/index.php");
   
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

    <a type="button" class="btn btn-warning fixed-top" href="index.html">Retour sur page d'accueil</a>



<form method="post" action="login_admin.php" class="col-md-3 mx-auto mt-5" >
        <label for="user_nom" style="width: 40%"><b> Nom :</b></label>
        <input type="text" name="user_nom" placeholder="Votre nom" id="user_nom" value="<?php if(isset($_POST['user_nom'])){ echo $_POST['user_nom'];}?>" required ><br><br>
        <label for="user_mdp" style="width: 40%"><b> Mot de passe :</b></label>
        <input type="password" name="user_mdp" id="user_mdp" placeholder="Votre mot de passe" value="<?php if(isset($_POST['user_mdp'])){ echo $_POST['user_mdp'];}?>" required><br><br>
        
        <p><input type="submit" value="Se connecter" name="login" class="btn btn-success"></p>
    </form>

</body>
</html>