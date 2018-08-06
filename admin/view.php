<?php
    require 'database.php';

    if(!empty($_GET['id'])) //si la superglobale get avec id n'est pas vide alors...ce id tu me le met dans une variable (que je check)
    {
        $id = checkInput($_GET['id']);
    }

    $db = Database::connect(); //j'utilise ma fonction statique de database.php

    $statement = $db->prepare('SELECT items.id, items.name, items.description, items.price, items.image, categories.name AS category FROM items LEFT JOIN categories ON items.category = categories.id WHERE items.id = ?');
    //je dois faire un select sur un id que je ne connais pas donc j'utilise la fonction prepare et le ?, puis j'execute ma requête :
    $statement->execute(array($id));
//maintenant je la stocke dans une varialbe
    $item = $statement->fetch(); //je récupere ma ligne / mon item
    Database::disconnect(); //je déconnecte

    function checkInput($data)//je vérifie ma variable au cas où qq'un soit mal intentionné
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
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
<link rel="stylesheet" href="../style.css">
<title>Pupuce</title>
</head>

<body>
    <h1>Chez Pupuce</h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="grey"><strong>Voir un article </strong></h1>
                <br>
                <form>
                    <div class="form-group">
                        <label>Nom :</label><?php echo ' ' . $item['name']; ?>
                    </div>
                    <div class="form-group">
                        <label>Description :</label><?php echo ' ' . $item['description']; ?>
                    </div>
                    <div class="form-group">
                        <label>Prix :</label><?php echo ' ' . number_format((float)$item['price'],2, '.' ,'') . ' €'; ?>
                    </div>
                    <div class="form-group">
                        <label>Catégorie :</label><?php echo ' ' . $item['category']; ?>
                    </div>
                    <div class="form-group">
                        <label>Image :</label><?php echo ' ' . $item['image']; ?>
                    </div>
                </form>
                <div class="form-actions">
                    <a class="btn btn-primary" href="index.php">Retour</a>
                </div>
            
        </div>
    
        
        <div class="col-sm-6 my-auto">
            <div class="img-thumbnail">
                <img src="<?php echo '../images/' . $item['image']; ?>" style="width: 80%;" class="m-2">
                <div class="price"><?php echo number_format((float)$item['price'],2, '.' ,''). ' €'; ?></div>
                <div class="caption">
                 <h4><?php echo $item['name']; ?></h4>
                 <p><?php echo $item['description']; ?></p>
                 <!-- <a href="#" class="btn btn-order" role="button"> Commander</a> -->
                 </div>
             </div>
         </div>
      

    </div>

</body>
</html>