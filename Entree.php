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
  if (isset($_POST['saveentre'])) {
     $nomprod=htmlspecialchars($_POST['nom']);
     $cat= htmlspecialchars($_POST['categorie']);
     $dateentre= htmlspecialchars($_POST['dateentre']);
     $datepere =htmlspecialchars($_POST['datepere']);
     $qtent =htmlspecialchars($_POST['qte']);
     $pu=htmlspecialchars($_POST['pu']);
     $idprodd=htmlspecialchars($_POST['idproo']);
    // $nomlot=htmlspecialchars($_POST['numero']);
     $dosage=htmlspecialchars($_POST['dosage']);
     $unitee=htmlspecialchars($_POST['unite']);
     $formee=htmlspecialchars($_POST['forme']);
     
     if (!empty($nomprod) AND !empty($cat) AND !empty($dateentre) AND !empty($datepere) AND !empty($pu) AND !empty($qtent)  AND !empty($dosage) AND !empty($unitee) AND !empty($formee) AND !empty($idprodd)) {
         $query_verifier= $pdo->prepare("SELECT * FROM entree WHERE nomprod= ? AND categ= ? AND dateentre= ? AND dateperemp= ? AND pu= ? AND  
         quante = ? AND dosage = ? AND= ? AND unitee= ? AND forme = ? AND idprod = ? ");
         $query_verifier->execute([$nomprod, $cat, $dateentre, $datepere, $pu, $qtent, $dosage, $unitee, $formee , $idprodd]);
         if ($query_verifier->fetch()) {
             $messageError = "Cette des opération existe déjà";
         }
         else{
             $query_insertData = $pdo->prepare("INSERT INTO entree (nomprod, dateentre, categ, dateperemp, pu, quante, dosage, unitee, forme, idprod) VALUES (?,?,?,?,?,?,?,?,?,?)");
             $query_insertData->equery_insertDataxecute([$nomprod, $dateentre, $cat, $datepere, $pu, $qtent, $dosage, $unitee, $formee , $idprodd]);
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
    $idprod = $_GET['supprimer'];
    //requete de la suppression
    $query_delete = $pdo->prepare("DELETE FROM entree WHERE identre = ?");
    if($query_delete->execute([$idprod])){
        $message = "La suppression est effctuée avec succès";
    }else{
        $messageError = "Echec de la suppression";
    }
}
 ?>
  
    <form action="" class="formulaire" METHOD="POST">
        <h3>Enregistrement Entrée</h3>
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
                <td><label for="Idcate">Nom Produit</label></td>
                <td><input type="text" name="nom" placeholder="Entrée le nom de produit" required="required"></td>
                <td> <label for="Idcate">Categorie</label></td>
                <td>
                <select name="categorie">
                <option>
                        <?php 
                  $query = $pdo->prepare("SELECT * FROM categorie");
                    $query->execute([]);
                     while ($data_options = $query->fetch()){
                        ?>
                        <option value="<?= $data_options['idcat']?>"><?= $data_options['designation']?></option>
                        <?php 
                    }
                ?> 
                        </option>
                </select>
                </td>
                <th><label>Dosage</label></th>
                <th><input type="text" name="dosage" placeholder="Entre le dosage. Ex:500mg"></th>

            </tr>
            <tr>
                <td><label for="Idcate">Date</label></td>
                <td><input type="Date" name="dateentre" required="required"></td>
                <td><label for="Idcate">Date peremption</label></td>
                <td><input type="date" name="datepere" required="required"></td>
                <th><label>Unité</label></th>
                <th><input type="text" name="unite" placeholder="Entre l'unité. Ex:Boite"></th>
            </tr>
            <tr>
                <td><label for="pu">Quantité</label></td>
                <td><input type="number" name="qte" placeholder="Entrée la quantité" required="required"></td>
                <td><label for="pu">Prix unitaire</label></td>
                <td><input type="number" name="pu" placeholder="Entrée le prix unitaire" required="required"></td>
                <th><label>Forme</label></th>
                <th><input type="text" name="forme" placeholder="Entre la forme. Ex:Comprime"></th>
            </tr>
            <tr>
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
                <td><input type="text" nume="numero" placeholder="Entre le N°Lot. Ex: L0011122"></td>
               
            </tr>



        </table>
            <div class="col-md-12">
                <input type="submit" name="saveentre" value="Enregistrer" class="btn btn-success">
            </div>
          
    </form>
          <?php 
                if (isset($_GET['confirmer']) && ! empty($_GET['confirmer'])){?>
                    <div class="alert alert-info">Voulez-vous vraiment supprimer? <a href="Entree.php?supprimer=<?=$_GET['confirmer'] ?>" class="btn btn-primary btn-sm">OUI</a>  <a href="Entree.php" class="btn btn-danger btn-sm">NON</a></div>
                <?php
                }
            ?>
    <h4><center>liste des Entree</center></h4>
  <table class="table" border="solide 2px black">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Entrée</th>
                            <th>Nom produit</th>
                            <th>Categorie</th>
                            <th>Date Entrée</th>
                            <th>date de péremption</th>
                            <th>Quantité</th>
                            <th>PU</th>
                            
                            <th>Dossage</th>
                            <th>Unite</th>
                            <th>Forme</th>

                            <th scope="col" collapse="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php  
                          $num = 0;
                          $query_selectdata = $pdo->prepare("SELECT * FROM entree");
                          $query_selectdata->execute([]);
                          while ($data = $query_selectdata->fetch()){
                             $num = $num + 1;
                            ?>
                             <tr>
                                 <th scope="row"><?=$num?></th>
                                <td><?=$data['identre']?></td>
                                <td><?=$data['nomprod']?></td>
                                <td><?=$data['categ']?></td>
						 		<td><?=$data['dateentre']?></td>
						 		<td><?=$data['dateperemp']?></td>
                                 <td><?=$data['quante']?></td>
								<td><?=$data['pu']?></td>
								
                                <td><?=$data['dosage']?></td>
                                <td><?=$data['unitee']?></td>
                                <td><?=$data['forme']?></td>

                                
                                 <td>
                                    <a href="Entree.php?confirmer<?=$data['identre']?>" class="btn btn-primary bnt-sm">Modifier</a>
                                    <a href="Entree.php?confirmer=<?=$data['identre']?>" class="btn btn-danger bnt-sm">supprimer</a>
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