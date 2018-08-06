<?php
    require_once("dbcontroller.php");

    $db_handle = new DBController(); // je crée une nouvelle instance de classe

    //j'initialise mes variables avec une string vide (premier passage)
    $fournisseur_nom = "";
    $fournisseur_prenom = "";
    $fournisseur_mail = "";
    $fournisseur_adresse = "";
    $fournisseur_cp = "";
    $fournisseur_ville = "";
    $fournisseur_date_naissance = "";
    $fournisseur_code_comptable = "";

//je pose mes questions puis j'attribue la valeur fournie à mes variables en la nettoyant au passage
    if(!empty($_POST["fournisseur_nom"])) {
        $fournisseur_nom = $db_handle->cleanData($_POST["fournisseur_nom"]);
    }
    if(!empty($_POST["fournisseur_prenom"])) {
        $fournisseur_prenom = $db_handle->cleanData($_POST["fournisseur_prenom"]);
    }
    if(!empty($_POST["fournisseur_mail"])) {
        $fournisseur_mail = $db_handle->cleanData($_POST["fournisseur_mail"]);
    }
    if(!empty($_POST["fournisseur_adresse"])) {
        $fournisseur_adresse = $db_handle->cleanData($_POST["fournisseur_adresse"]);
    }
    if(!empty($_POST["fournisseur_cp"])) {
        $fournisseur_cp = $db_handle->cleanData($_POST["fournisseur_cp"]);
    }
    if(!empty($_POST["fournisseur_ville"])) {
        $fournisseur_ville = $db_handle->cleanData($_POST["fournisseur_ville"]);
    }
    if(!empty($_POST["fournisseur_date_naissance"])) {
        $fournisseur_date_naissance = $db_handle->cleanData($_POST["fournisseur_date_naissance"]);
    }
    if(!empty($_POST["fournisseur_code_comptable"])) {
        $fournisseur_code_comptable = $db_handle->cleanData($_POST["fournisseur_code_comptable"]);
    }

    //je fais ma requête sql :
    $sql = "INSERT INTO fournisseur(fournisseur_nom, fournisseur_prenom, fournisseur_mail, fournisseur_adresse, fournisseur_cp, fournisseur_ville, fournisseur_date_naissance, fournisseur_code_comptable) VALUES ('" . $fournisseur_nom . "','" . $fournisseur_prenom . "','" . $fournisseur_mail . "','" . $fournisseur_adresse . "','" . $fournisseur_cp . "','" . $fournisseur_ville . "','" . $fournisseur_date_naissance . "', '" . $fournisseur_code_comptable . "')";

    //me retourne l'identifiant automatiquement généré par la dernière requête
    $id = $db_handle->executeInsert($sql);

    if(!empty($id)) {
        $sql = "SELECT * from fournisseur WHERE id = '$id' ";
        $result_ = $db_handle->readData($sql);
    }
?>
<?php 
    if(!empty($result_)) { 
?>
<tr>
    <td><?php echo $result_[0]["fournisseur_nom"]; ?></td>
    <td><?php echo $result_[0]["fournisseur_prenom"]; ?></td>
    <td><?php echo $result_[0]["fournisseur_mail"]; ?></td>
    <td><?php echo $result_[0]["fournisseur_adresse"]; ?></td>
    <td><?php echo $result_[0]["fournisseur_cp"]; ?></td>
    <td><?php echo $result_[0]["fournisseur_ville"]; ?></td>
    <td><?php echo $result_[0]["fournisseur_date_naissance"]; ?></td>
    <td style="text-align:right;"><?php echo $result_[0]["fournisseur_code_comptable"]; ?></td>
</tr>
<?php
    }
?>  