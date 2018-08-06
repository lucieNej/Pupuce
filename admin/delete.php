<?php 
    require 'database.php';

    if(!empty($_GET['id'])) //si je t'ai passé en get un id alors tu me le mets dans une variable qui s'apl id
    {
        $id = checkInput($_GET['id']);
    }

    if(!empty($_POST)) // ça veut dire que j'ai appuyé sur le bouton oui si pas vide alors je recupere mon id
    {
        $id = checkInput($_POST['id']);
        $db = Database::connect();
        $statement = $db->prepare("DELETE FROM items WHERE id = ?");
        $statement->execute(array($id));
        Database::disconnect();
        header("Location: index.php");
    }

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
        <div>
            <h1 class="grey"><strong>Supprimer un article </strong></h1>
            <br>
            <form class="form" role="form" action="delete.php" method="post">
              <input type="hidden" name="id" value="<?php echo $id ?>" />
                <p class="alert alert-warning">Etes-vous sûr de vouloir supprimer cet article ? </p>
            <div class="form-actions">
                <button type="submit" class="btn btn-warning"> Oui</button>
                <a class="btn btn-default" href="index.php">Non</a>
            </div>
            </form>
        </div>
</body>
</html>