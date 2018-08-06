<?php

// on vérifie que les données du formulaire sont présentes
if (isset($_POST['user_nom']) && isset($_POST['user_mdp'])) {
    require_once 'classes.php';
    $bdd = Database::connect();
    // cette requête permet de récupérer l'utilisateur depuis la BD
    $requete = "SELECT * FROM users WHERE user_nom=? AND user_mdp=?";
    $resultat = $bdd->prepare($requete);
    $user_nom = $_POST['user_nom'];
    $user_mdp = $_POST['user_mdp'];
    $resultat->execute(array($user_nom, $user_mdp));
    if ($resultat->rowCount() == 1) {
        // l'utilisateur existe dans la table
        // on ajoute ses infos en tant que variables de session
        $_SESSION['user_nom'] = $user_nom;
        $_SESSION['user_mdp'] = $user_mdp;
        // cette variable indique que l'authentification a réussi
        $authOK = true;
    }
}
?>

