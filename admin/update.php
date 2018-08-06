<?php 
    require 'database.php';

    if(!empty($_GET['id'])) //est-ce que le get est vide ? vu que je lui ai donné l'id dans l'url non ! 
    {
        $id = checkInput($_GET['id']); //cet id je le met dans la variable id & je le nettoie
    }

    $nameError = $descriptionError = $priceError = $categoryError = $imageError = $name = $description = $price = $category = $image = "" ;

    //est-ce que dans la variable superglobale post il y a des infos //formulaire
    //-> variable post = vide puisque je n'ai pas utilisé la méthode post
    //donc je ne rentre pas dans ce if
    if(!empty($_POST)) //si pas vide alors : //if du deuxième passage //post
        //si j'ai appuyé sur le bouton modifier quoi
    {
        $name = checkInput($_POST['name']); // j'ulise la fonction checkInput par mesure de sécurité
        $description = checkInput($_POST['description']); 
        $price = checkInput($_POST['price']); 
        $category = checkInput($_POST['category']); 
        $image = checkInput($_FILES['image']['name']); 
        $imagePath = '../images/' . basename($image) ; //me donne le chemin de l'image
        $imageExtension = pathinfo($imagePath, PATHINFO_EXTENSION);
        $isSuccess = true;

        if(empty($name))
        {
            $nameError = 'Veuillez remplir ce champ';
            $isSuccess = false;
        }
        if(empty($description))
        {
            $descriptionError = 'Veuillez remplir ce champ';
            $isSuccess = false;
        }
        if(empty($price))
        {
            $priceError = 'Veuillez remplir ce champ';
            $isSuccess = false;
        }
        if(empty($category))
        {
            $categoryError = 'Veuillez remplir ce champ';
            $isSuccess = false;
        }
        if(empty($image))
        {
            $isImageUpdated = false;
        }
        else
        {
            $isImageUpdated = true;
            $isUploadSuccess = true;
            if($imageExtension != "jpg" && $imageExtension != "png" && $imageExtension != "jpeg" && $imageExtension != "gif")
            {
                $imageError = "Les fichiers autorisés sont: .jpg, .jpeg, .png, .gif";
                $isUploadSuccess = false;
            }
            if(file_exists($imagePath))
            {
                $imageError = "le fichier existe déjà !";
                $isUploadSuccess = false;
            }
            if($_FILES["image"]["size"] > 500000)
            {
                $imageError = "Le fichier ne doit pas dépasser les 500KB";
                $isUploadSuccess = false;
            }
            if($isUploadSuccess)
            {
                if(!move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath))
                {
                    $imageError = "il y a eu une erreur lors du téléchargement";
                    $isUploadSuccess = false;
                }
            }
        }
        if(($isSuccess && $isImageUpdated && $isUploadSuccess) ||  ($isSuccess && !$isImage)) //j'ai deux cas de succès oui
        {
            $db = Database::connect();
            if($isImageUpdated)
            {
                $statement = $db->prepare('UPDATE items set name = ?, description = ?, price = ?, category = ?, image = ? WHERE id = ?');
                $statement->execute(array($name,$description,$price,$category,$image,$id));
            }
            else
            {
                $statement = $db->prepare('UPDATE items set name = ?, description = ?, price = ?, category = ? WHERE id = ?');
                $statement->execute(array($name,$description,$price,$category,$id));
            }
            Database::disconnect();
            header("Location: index.php");
        }
        else if($isImageUpdated && !$isUploadSuccess)
        {
            $db = Database::connect();
            $statement = $db->prepare('SELECT image FROM items WHERE id = ?');
            $statement->execute(array($id));
            $item = $item['image'];
            Database::disconnect();
        }


    }
    //fin du if !!!!!!!!!!!!!!!!

    else //je veux récupérer toutes les informations sur mon article :
    {
        $db = Database::connect();
        $statement = $db->prepare("SELECT * FROM items WHERE id = ?");
        $statement->execute(array($id));
        $item = $statement->fetch();
        $name = $item['name']; //je remplis mes variables name description etc avec les valeurs de ma bdd
        $description = $item['description'];
        $price = $item['price'];
        $category = $item['category'];
        $image = $item['image'];
        Database::disconnect();
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
        <title>Pupuce</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet"> 
        <link rel="stylesheet" href="../style.css">
    </head> 
    
<body>
    <h1>Chez Pupuce</h1>
    <div class="container admin">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="grey"><strong>Modifier un article :</strong></h1>
                <br>
                <form class="form" role="form" action="<?php echo 'update.php?id=' . $id; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom" value="<?php echo $name; ?> "/>
                        <span class="help-inline"><?php echo $nameError; ?></span>
                    </div>
                    <div class="form-group">
                    <label for="description">Description :</label>
                        <input type="text" class="form-control" id="description" name="description" placeholder="description" value="<?php echo $description; ?> "/>
                        <span class="help-inline"><?php echo $descriptionError; ?></span>
                    </div>
                    <div class="form-group">
                    <label for="price">Prix : (en €)</label>
                        <input type="text" step="0.01" class="form-control" id="price" name="price" placeholder="prix" value="<?php echo number_format((float)$price,2, '.' ,''); ?>"/>
                        <span class="help-inline"><?php echo $priceError; ?></span>
                    </div>
                    <div class="form-group">
                    <label for="category">Catégorie :</label>
                        <select class="form-control" id="category" name="category">
                            <?php 
                            $db = Database::connect();
                            foreach($db->query('SELECT * FROM categories') as $row)
                            {
                                if($row['$id'] == $category)
                                    echo '<option selected="selected" value="' . $row['id'] . '">' . $row['name'] . '</option>';
                                else
                                    echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>'; 
                            }
                            Database::disconnect();
                            ?>
                        </select>
                        <span class="help-inline"><?php echo $categoryError; ?></span>
                    </div>
                    <div class="form-group">
                        <label>Image : </label>
                        <p><?php echo $image; ?></p>
                    <label for="image">Sélectionner une image</label>
                        <input type="file" class="form-control" id="image" name="image"/>
                        <span class="help-inline"><?php echo $imageError; ?></span>
                    </div>
            
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <a class="btn btn-primary" href="index.php">Retour</a>
                </div>
                </form>
            </div>

            <div class="col-sm-6 my-auto">
                <div class="img-thumbnail">
                    <img src="<?php echo '../images/' . $image; ?>" style="width: 80%;" class="m-2">
                    <div class="price"><?php echo number_format((float)$price,2, '.' ,''). ' €'; ?></div>
                    <div class="caption">
                    <h4><?php echo $name; ?></h4>
                    <p><?php echo $description; ?></p>
                 </div>
             </div>

            </div>
        </div>
</body>
</html>