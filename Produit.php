<!DOCTYPE html>
<html lang="fr">


<link rel="stylesheet" href="style.css">
<body class="index-page">
 <?php
 include('menu.php');

 require_once("connexion/connexion.php");
 //ici on commence les php pour l'enregistrement

 $message = "";
 $messageError = "";
 if (isset($_POST['saveprod'])) {
    $nompro=htmlspecialchars($_POST['nom']);
    $cat=htmlspecialchars($_POST['categorie']);


    if (!empty($nompro) AND !empty($cat) ) {
        $query_verifier= $pdo->prepare("SELECT * FROM produit WHERE nomprod= ? AND idcat = ?");
        $query_verifier->execute([$nompro, $cat]);
        if ($query_verifier->fetch()) {
            $messageError = "Cette categorie existe déjà";
        }
        else{
            $query_insertData = $pdo->prepare("INSERT INTO produit(nomprod, idcat) VALUES (?, ?)");
            $query_insertData->execute([$nompro, $cat]);
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
    $query_delete = $pdo->prepare("DELETE FROM produit WHERE idprod = ?");
    if($query_delete->execute([$idprod])){
        $message = "La suppression est effctuée avec succès";
    }else{
        $messageError = "Echec de la suppression";
    }
}
 ?>
  

  <main class="mainn">
    <form action="" class="formulaire" METHOD="POST">
        <h3>Enregistrement Produits</h3>
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
            <div class="col-md-6">
               <label for="Idcate">Nom Produit</label>
               <input type="text" name="nom" placeholder="Entrée le nom de la categorie" required="">
            </div>
            <div class="col-md-6">
               <label for="Idcate">Categorie</label>
               <br>
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
            </div>
            <div class="col-md-6">
               <label for="Idcate">Fournisseur</label>
               <br>
              <select name="categorie">
              <?php 
                  $query = $pdo->prepare("SELECT * FROM fournisseur");
                    $query->execute([]);
                     while ($data_options = $query->fetch()){
                        ?>
                        <option value="<?= $data_options['idfour']?>"><?= $data_options['nom']?></option>
                        <?php 
                    }
                ?> 
              </select>
            </div>

            <div class="col-md-12">
                <input type="submit" name="saveprod" value="Enregistrer" class="btn btn-success">
            </div>
          
    </form>

    <!-- Contact Section -->
    
    


  </main>
  <h4><center>liste de categorie</center></h4>
  <table class="table" border="solide 2px black">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Produit</th>
                            <th>Nom produit</th>
                            <th>Categorie</th>
                            <th scope="col" collapse="3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					<?php  
                          $num = 0;
                          $query_selectdata = $pdo->prepare("SELECT * FROM produit");
                           $query_selectdata->execute([]);
                            while ($data = $query_selectdata->fetch()){
                            $num = $num + 1;
                            ?>
                           <tr>
                                 <th scope="row"><?=$num?></th>
                                 <td><?=$data['idprod']?></td>
                                 <td><?=$data['nomprod']?></td>
                                 <td><?=$data['idcat']?></td>
                              
                                
                                <td>
                                    <a href="ficherreviser.php?recu=<?=$data['idprod']?>" class="btn btn-primary bnt-sm">fiche de stock</a>
                                    <a href="produit.php?confirmer<?=$data['idprod']?>" class="btn btn-primary bnt-sm">Modifier</a>
                                    <a href="produit.php?confirmer=<?=$data['idprod']?>" class="btn btn-danger bnt-sm">supprimer</a>
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