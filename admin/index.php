<?php
session_start();
//si on n'est pas connecté : nous sommes redirigés vers l'acceuil
 if(!isset($_SESSION['user_nom']) || empty($_SESSION['user_nom'])){
    header('Location: login_admin.php');
    die;
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
<link rel="stylesheet" href="../style.css">
<title>Pupuce</title>
</head>

<body>
    <nav class="navbar navbar-light ">
        <a class="navbar-brand" href="../../index.php">
            <img src="../../images/pupuce.png" width="70" height="70" class="d-inline-block align-top" alt="logo">
            <span class="navbar-text pacifico mt-2">Pupuce</span>
        </a>
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a type="button" class="mr-2 nav-link btn-outline-info" href="../logout.php">Page d'accueil</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link btn-outline-danger" href="../index.php">Gérez les articles</a>
            </li>
            <!-- <li class="nav-item">
                <a class="nav-link btn-outline-danger" href="fournisseurs/index.php">Gérez les fournisseurs</a>
            </li> -->
            <li class="nav-item">
                <a class="nav-link btn-outline-danger" href="../employes/index.php">Gérez les employés</a>
            </li>
        </ul>
    </nav>
    <h1>Chez Pupuce</h1>
    <div class="container admin">
        <div class="row">
            <h1 class="grey"><strong>Liste des articles : </strong>
            <a href="insert.php" class="btn btn-success btn-lg">+ Ajouter un article </a>
            </h1>

            <table class="table table-striped table-border">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Catégorie</th>
                        <th>Action</th>
                    </tr>  
                </thead>
                <tbody>

                    <?php
                    require 'database.php';
                    $db = Database::connect(); //je me connecte à ma fonction statique publique connect (de ma classDatabase() qui me retourne la bdd
                    $statement = $db->query('SELECT items.id, items.name, items.description, items.price, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id ORDER BY items.id DESC');

                    while($item = $statement->fetch()) //récupère juste une ligne puis fait une boucle dessus
                    {
                        echo '<tr>';
                            echo '<td>' . $item['name'] . '</td>';
                            echo '<td>' . $item['description'] . '</td>';
                            echo '<td>' . number_format((float)$item['price'],2, '.' ,'') . '€' . '</td>';//fonction pour nombres décimaux
                            echo '<td>' . $item['category'] . '</td>';
                            
                            echo '<td width=300>';
                                echo '<a class="btn btn-default" href="view.php?id=' . $item['id'] . '">Voir</a>';
                                echo '  ';
                                echo '<a class="btn btn-primary" href="update.php?id=' . $item['id'] . '">Modifier</a>';
                                echo '  ';
                                echo '<a class="btn btn-danger" href="delete.php?id=' . $item['id'] . '">Supprimer</a>';
                            echo '</td>';
                        echo '</tr>';
                    }

                    Database::disconnect(); //je déconnecte
                    ?>

                </tbody>
            </table>
        </div>

    </div>

</body>
</html>