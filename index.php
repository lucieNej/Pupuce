<?php
session_start();

require_once("dbcontroller.php");
$db_handle = new DBController(); 



if(!empty($_GET["action"])) {
switch($_GET["action"]) {
    
    case "add":
        if(!empty($_POST["quantity"])) {
            $productByCode = $db_handle->runQuery("SELECT * FROM items WHERE code='" . $_GET["code"] . "'");
            $itemArray = array($productByCode[0]["code"]=>array(
                'name'=>$productByCode[0]["name"], 
                'code'=>$productByCode[0]["code"], 
                'quantity'=>$_POST["quantity"], 
                'price'=>$productByCode[0]["price"]
            ));
            
            if(!empty($_SESSION["cart_item"])) {
                if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
                    foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode[0]["code"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
                            }
                    }
                } else {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
                }
            } else {
                $_SESSION["cart_item"] = $itemArray;
            }
        }
    break;
    
    case "remove":
        if(!empty($_SESSION["cart_item"])) {
            foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);              
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
            }
        }
    break;
    
    case "empty":
        unset($_SESSION["cart_item"]);
    break;  
}
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Pupuce</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet"> 
        <link rel="stylesheet" href="style.css">
    </head> 
    
    
    <body>
        <nav class="navbar navbar-light fixed-top">
            <a class="navbar-brand" href="index.php">
                <img src="images/pupuce.png" width="70" height="70" class="d-inline-block align-top" alt="logo">
                <span class="navbar-text pacifico mt-2">Pupuce</span>
            </a>
            <ul class="nav justify-content-end">
                <li class="nav-item">
                    <a type="button" class="mr-2 nav-link btn-outline-info" href="index.html">Page d'accueil</a>
                </li>
                <li class="nav-item">
                    <a type="button" class="mr-2 nav-link btn-outline-info  active" href="logIn_client.php">S'inscrire</a>
                </li>
                <li class="nav-item">
                    <a class="mr-2 nav-link btn-outline-info" href="signIn_client.php">Se connecter</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="mr-2 nav-link btn-outline-info" href="index.php">Panier</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link btn-outline-danger" href="login_admin.php">Admin</a>
                </li>
            </ul>
        </nav>

        <div class="container-fluid site ">
            <br><br><br>
            <h1>Bienvenue chez Pupuce !</h1>

<!-- :::::::::::::::::::::::::::::::::::  BASKET  START  ::::::::::::::::::::::::::::::::::::::::::::::::::: -->
            <div class="offset-md-1 col-md-10 mx-auto"> 
                <h1 class="font-weight-bold">Panier</h1> 
                
                <?php
                if(isset($_SESSION["cart_item"])){
                    $item_total = 0;
                ?>  

                <table cellpadding="10" cellspacing="1" class="table-border mx-auto">
                    <tbody>
                        <tr class="table-striped table-border img-thumbnail">
                            <th style="text-align:left;"><strong>Nom</strong></th>
                            <th style="text-align:left;"><strong>Code</strong></th>
                            <th style="text-align:right;"><strong>Quantité</strong></th>
                            <th style="text-align:right;"><strong>Prix</strong></th>
                            <th style="text-align:center;"><strong>Action</strong></th>
                        </tr>
                            <?php
                                foreach ($_SESSION["cart_item"] as $item){
                            ?>
                        <tr class="table-striped table-border img-thumbnail">
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><strong><?php echo $item["name"]; ?></strong></td>
                            <td style="text-align:left;border-bottom:#F0F0F0 1px solid;"><?php echo $item["code"]; ?></td>
                            <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["quantity"]; ?></td>
                            <td style="text-align:right;border-bottom:#F0F0F0 1px solid;"><?php echo $item["price"]. " €"; ?></td>
                            <td style="text-align:center;border-bottom:#F0F0F0 1px solid;"><a href="index.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction">Retirer ce produit</a></td>
                        </tr>
                            <?php
                                $item_total += ($item["price"]*$item["quantity"]);
                                }
                            ?>

                        <tr>
                            <td colspan="5" align=right class="bg-light font-weight-bold">Total : <?php echo $item_total. " €"; ?></td>
                        </tr>
                        <tr>
                            <td colspan="2" align=left class="bg-light font-weight-bold">
                                <a id="btnEmpty" class="btn btn-primary" href="index.php?action=empty">Vider le panier</a></td>
                            <td colspan="3" align=right class="bg-light font-weight-bold">
                                <a type="button" href="infoAchat.php" class="btn btn-primary">Commander</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <?php
                }
                ?>
                </div>
            

            <div class="offset-md-1 col-md-9 mx-auto">
                <div>
                    <h1>Articles</h1>
                </div>
                <div class="row">
                    <?php
                    $product_array = $db_handle->runQuery("SELECT * FROM items ORDER BY id ASC");
                    if (!empty($product_array)) { 
                        foreach($product_array as $key=>$value){
                    ?>
                    <div class="product-item img-thumbnail col-md-5 m-3" style="height: 26vw; overflow: scroll;">
                        <form method="post" action="index.php?action=add&code=<?php echo $product_array[$key]["code"]; ?>" class="d-flex flex-column justify-content-between">
                        
                                
                            <img src="images/<?php echo $product_array[$key]["image"]; ?> " style="height: 16vw;">
                            
                            <div class="caption">
                                <h4 class="font-weight-bold"><?php echo $product_array[$key]["name"]; ?></h4>
                                <p><?php echo $product_array[$key]["description"]; ?></p>
                                <input type="text" name="quantity" value="1" size="2" />
                                <input type="submit" value="Ajouter au panier" class="btnAddAction btn btn-success" />
                            </div>
                                
                                <div class="product-price price"><?php echo $product_array[$key]["price"]. " €"; ?></div>
                        </form>
                    </div>
                    <?php
                            }
                    }
                    ?>
                </div>
            </div>




<!-- :::::::::::::::::::: BASKET END  :::::::::::::::::::::::::::::: -->


<!-- ::::: JOHN CODER CATEGORIES  ::::::-->


            <!-- <div class="container"> -->
            <?php
                // require 'admin/database.php';
             
                // echo '<nav>
                //         <ul class="nav nav-pills justify-content-center mb-5">';

                // $db = Database::connect();
                // $statement = $db->query('SELECT * FROM categories');
                // $categories = $statement->fetchAll();
                // foreach ($categories as $category) 
                // {
                //     if($category['id'] == '1')
                //         echo '<li role="presentation" class="active mx-2">
                //         <a class="btn btn-light" href="#'. $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a>
                //         </li>';
                //     else
                //         echo '<li role="presentation" class="mx-2">
                //         <a class="btn btn-light" href="#'. $category['id'] . '" data-toggle="tab">' . $category['name'] . '</a>
                //         </li>';
                // }

                // echo    '</ul>
                //       </nav>';

                // echo '<div class="tab-content">';

                // foreach ($categories as $category) 
                // {
                //     if($category['id'] == '1')
                //         echo '<div class="tab-pane active" id="' . $category['id'] .'">';
                //     else
                //         echo '<div class="tab-pane" id="' . $category['id'] .'">';
                    
                //     echo '<div class="row">';
                    
                //     $statement = $db->prepare('SELECT * FROM items WHERE items.category = ?');
                //     $statement->execute(array($category['id']));
                //     while ($item = $statement->fetch()) 
                //     {
                //         echo '<div class="col-sm-6 col-md-4">
                //                 <div class="img-thumbnail d-flex flex-column justify-content-between mb-5" style="height: 28vw; overflow: scroll;">
                //                     <img style="height: 17vw;" src="images/' . $item['image'] . '" alt="image du produit">
                //                     <div class="price">' . number_format($item['price'], 2, '.', ''). ' €</div>
                //                     <div class="caption">
                //                         <h4>' . $item['name'] . '</h4>
                //                         <p>' . $item['description'] . '</p>
                //                         <a href="#" class="btn btn-order btnAddAction" role="button"> Commander</a>
                //                     </div>
                //                 </div>
                //             </div>';
                //     }
                   
                //    echo    '</div>
                //         </div>';
                // }
                // Database::disconnect();
                // echo  '</div>';
            ?>
            <!-- </div> -->
        </div>

    </body>
</html>