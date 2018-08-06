<?php
    require_once("dbcontroller.php");
    $db_handle = new DBController();
    
    $sql = "SELECT * from fournisseur";
    $productResult = $db_handle->readData($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css">
    <link rel="stylesheet" href="../../style.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet"> 
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

    
<div id="add-product" class="img-thumbnail offset-md-1 col-md-10">
<div class="grey pacifico text-center mb-3">Ajouter un fournisseur</div>
    <table cellpadding="10" cellspacing="1" class="table table-striped table-bordered">
        <tbody>
            <tr>
                <th><strong>Nom</strong></th>
                <th><strong>Prenom</strong></th>
                <th><strong>Mail</strong></th>
                <th><strong>Adresse</strong></th>
                <th><strong>Code postal</strong></th>
                <th><strong>Ville</strong></th>
                <th><strong>Date de naissance</strong></th>
                <th style="text-align:right;"><strong>Code comptable</strong></th>
            </tr>   
            <tr>
                <td contentEditable="true" data-id="fournisseur_nom"></td>
                <td contentEditable="true" data-id="fournisseur_prenom"></td>
                <td contentEditable="true" data-id="fournisseur_mail"></td>
                <td contentEditable="true" data-id="fournisseur_adresse"></td>
                <td contentEditable="true" data-id="fournisseur_cp"></td>
                <td contentEditable="true" data-id="fournisseur_ville"></td>
                <td contentEditable="true" data-id="fournisseur_date_naissance"></td>
                <td contentEditable="true" data-id="fournisseur_code_comptable" style="text-align:right;"></td>
            </tr>
        </tbody>
    </table>    
<div id="btnSaveAction" class="btn btn-success mb-2">Sauver dans la base de données</div>
</div>
<br><br>    
<div id="list-product" class="img-thumbnail offset-md-1 col-md-10"> 
<div class="grey pacifico text-center my-3">Fournisseurs</div>
    <table cellpadding="10" cellspacing="1" class="table table-striped table-border">
        <tbody id="ajax-response">
            <tr>
                <th><strong>Nom</strong></th>
                <th><strong>Prénom</strong></th>
                <th><strong>Mail</strong></th>
                <th><strong>Adresse</strong></th>
                <th><strong>Code postal</strong></th>
                <th><strong>Ville</strong></th>
                <th><strong>Date de naissance</strong></th>
                <th style="text-align:right;"><strong>Code comptable</strong></th>
            </tr>
            <?php 
                if(!empty($productResult)) { 
                    foreach($productResult as $k=>$v) {
            ?>
            <tr>
                <td><?php echo $productResult[$k]["fournisseur_nom"]; ?></td>
                <td><?php echo $productResult[$k]["fournisseur_prenom"]; ?></td>
                <td><?php echo $productResult[$k]["fournisseur_mail"]; ?></td>
                <td><?php echo $productResult[$k]["fournisseur_adresse"]; ?></td>
                <td><?php echo $productResult[$k]["fournisseur_cp"]; ?></td>
                <td><?php echo $productResult[$k]["fournisseur_ville"]; ?></td>
                <td><?php echo $productResult[$k]["fournisseur_date_naissance"]; ?></td>
                <td style="text-align:right;"><?php echo $productResult[$k]["fournisseur_code_comptable"]; ?></td>
            </tr>
            <?php
                    }
                }
            ?>
        </tbody>
    </table>
</div><br><br>
<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>
$("#btnSaveAction").on("click",function(){
    params = ""
    $("td[contentEditable='true']").each(function(){
        if($(this).text() != "") {
            if(params != "") {
                params += "&";
            }
            params += $(this).data('id')+"="+$(this).text();
        }
    });
    if(params!="") {
        $.ajax({
            url: "insert-row.php",
            type: "POST",
            data:params,
            success: function(response){
              $("#ajax-response").append(response);
              $("td[contentEditable='true']").text("");
            }
        });
    }
});
</script>