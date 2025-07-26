<!DOCTYPE html>
<html lang="fr">


<link rel="stylesheet" href="style.css">
<body class="mainn">
 <?php
 include('menu.php');
 ?>

<?php
  require_once("connexion/connexion.php");
  //ici on commence les php pour l'enregistrement
 
  $message = "";
  $messageError = "";
  if (isset($_POST['savesortie'])){
    $datesortie=htmlspecialchars($_POST['datesortie']);
    $pu=htmlspecialchars($_POST['pu']);
    $qt=htmlspecialchars($_POST['qte']);
    $nompro=htmlspecialchars($_POST['nom']);
    $catego=htmlspecialchars($_POST['categorie']);
    $idpro=htmlspecialchars($_POST['idproo']);
    $idcl=htmlspecialchars($_POST['client']);
    //$nomlot=htmlspecialchars($_POST['numero']);
    $dosage=htmlspecialchars($_POST['dosage']);
    $unitee=htmlspecialchars($_POST['unite']);
    $formee=htmlspecialchars($_POST['forme']);

    if (!empty($datesortie) AND !empty($pu) AND !empty($qt) AND !empty($nompro) AND !empty($catego) AND !empty($idpro) AND !empty($idcl) AND !empty($dosage) AND !empty($unitee) AND !empty($formee)) {
        $query_verifier= $pdo->prepare("SELECT * FROM sortie WHERE idsort = ? AND datesortie = ? AND pu= ? AND quantevend= ? AND nomprod= ? AND categorie = ? AND idprod= ? AND idclient= ?  AND dosage = ? AND unitee =? AND forme =? ");
        $query_verifier->execute([$datesortie, $pu, $qt, $nompro,$catego ,$idpro, $idcl, $dosage, $unitee, $formee]);
        if ($query_verifier->fetch()) {
            $messageError = "Cet enregistrement existe déjà";
        }
        else{
            $query_insertData = $pdo->prepare("INSERT INTO sortie(datesortie, pu, quantevend, nomprod, categorie, idprod, idclient, dosage, unitee, forme) VALUES (?, ?, ?, ?, ?, ?,?, ?, ?,?)");
            $query_insertData->execute([$datesortie, $pu, $qt, $nompro, $catego, $idpro, $idcl,  $dosage, $unitee, $formee]);
            if($query_insertData == true){
                $message = "L'enregistrement est effecué avec succès";
            }else{
                $messageError = "Echec d'enregistrement à la base de données";
            }
        }
    }
  }
  // ici on fait la supression
if (isset($_GET['supprimer']) && ! empty($_GET['supprimer'])){
    $idsort = $_GET['supprimer'];

    //requete de la suppression
    $query_delete = $pdo->prepare("DELETE FROM sortie WHERE idsort = ?");
    if($query_delete->execute([$idsort])){
        $message = "La suppression est effctuée avec succès";
    }else{
        $messageError = "Echec de la suppression";
    }
}
 ?>
  
    <form action="" class="formulaire" METHOD="POST">
        <h3>Enregistrement Sortie</h3>
        <?php 
            //message de succès
            if(isset($message) && !empty($message)){?>
                <div class="alert alert-success"><?=$message?></div>
            <?php
            }

            //message d'erreur
            if(isset($messageError) && !empty($messageError)){?>
                <div class="alert alert-danger"><?=$messageError?></div>
            <?php
            }
        ?>
        <table>
            <tr>
                <td><label>Nom Produit</label></td>
                <td><input type="text" name="nom" placeholder="Entrée le nom de produit" required="required"></td>
                <td> <label>Categorie</label></td>
                <td>
                <select name="categorie">
                <?php 
                  $query = $pdo->prepare("SELECT * FROM categorie");
                    $query->execute([]);
                     while ($data_options = $query->fetch()){
                        ?>
                        <option value="<?= $data_options['idcat']?>"><?= $data_options['designation']?></option>
                        <?php 
                    }
                ?> 
                </select>
                </td>
                <th><label>Dosage</label></th>
                <th><input type="text" name="dosage" placeholder="Entre le dosage. Ex:500mg"></th>


            </tr>
            <tr>
                <td><label>Date</label></td>
                <td><input type="Date" name="datesortie" required="required"></td>
                <td><label>Client</label></td>
                <td><select name="client">
                <?php 
                  $query = $pdo->prepare("SELECT * FROM client");
                    $query->execute([]);
                     while ($data_options = $query->fetch()){
                        ?>
                        <option value="<?= $data_options['idclient']?>"><?= $data_options['nomclient']?></option>
                        <?php 
                    }
                ?> 
                </select></td>
                <th><label>Unité</label></th>
                <th><input type="text" name="unite" placeholder="Entre l'unité. Ex:Boite"></th>
            </tr>
            <tr>
                <td><label>Quantité</label></td>
                <td><input type="number" name="qte" placeholder="Entrée la quantité" required="required"></td>
                <td><label>Prix unitaire</label></td>
                <td><input type="number" name="pu" placeholder="Entrée le prix unitaire" required="required"></td>
                <th><label>Forme</label></th>
                <th><input type="text" name="forme" placeholder="Entre la forme. Ex:Comprime"></th>
            </tr>
            <td><label>ID prod</label></td>
                <td>
                    <select name="idproo">
                        <option>
                        <?php 
                  $query = $pdo->prepare("SELECT * FROM produit");
                    $query->execute([]);
                     while ($data_options = $query->fetch()){
                        ?>
                        <option value="<?= $data_options['idprod']?>"><?= $data_options['nomprod']?></option>
                        <?php 
                    }
                ?> 
                        </option>
                    </select>
                </td>
                <th><Label>N°Lot</Label></th>
                <td><input type="text" nume="numlot" placeholder="Entre le N°Lot. Ex: L0011122"></td>
            </tr>
        </table>
            <div class="col-md-12">
                <input type="submit" name="savesortie" value="Enregistrer" class="btn btn-success">
            </div>
          
    </form>
           <?php 
                if (isset($_GET['confirmer']) && ! empty($_GET['confirmer'])){?>
                    <div class="alert alert-info">Voulez-vous vraiment supprimer? <a href="sortie.php?supprimer=<?=$_GET['confirmer'] ?>" class="btn btn-primary btn-sm">OUI</a>  <a href="sortie.php" class="btn btn-danger btn-sm">NON</a></div>
                <?php
                }
            ?>
    <h4><center>liste des sorties</center></h4>
  <table class="table" border="solide 2px black">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Sortie</th>
                            <th>Date Sortie</th>
                            <th>Produit</th>
                            <th>Categorie</th>
                            <th>Quantité</th>
                            <th>PU</th>
                            
                            <th>Dossage</th>
                            <th>Unité</th>
                            <th>Forme</th>

                            
                            <th scope="col" collapse="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					 <?php  
                            $num = 0;
                           $query_selectdata = $pdo->prepare("SELECT * FROM sortie");
                           $query_selectdata->execute([]);
                            while ($data = $query_selectdata->fetch()){
                            $num = $num + 1;
                             ?>
                             <tr>
                                <th scope="row"><?=$num?></th>
                                <td><?=$data['idsort']?></td>
                                <td><?=$data['datesortie']?></td>
                                <td><?=$data['nomprod']?></td>
                                <td><?=$data['categorie']?></td>
						 		<td><?=$data['quantevend']?></td>
						 		<td><?=$data['pu']?></td>
						 		<td><?=$data['dosage']?></td>
                                 <td><?=$data['unitee']?></td>
                                 <td><?=$data['forme']?></td>
						 		
                                
                                 <td>
                                     <a href="facture.php?recu=<?=$data['idsort']?>" class="btn btn-primary bnt-sm">Facture</a>
                                     <a href="sortie.php?confirmer<?=$data['idsort']?>" class="btn btn-primary bnt-sm">Modifier</a>
                                     <a href="sortie.php?confirmer=<?=$data['idsort']?>" class="btn btn-danger bnt-sm">supprimer</a>
                                 </td>
                             </tr>
                         <?php
                         }
                        ?> 
                        </tr>
                    </tbody>
                </table>
  

  <footer id="footer" class="footer light-background">

    <?php
    include('pied.php');
    ?>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>