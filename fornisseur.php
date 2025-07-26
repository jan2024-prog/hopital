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
 if (isset($_POST['savecat'])) {
    $nom=htmlspecialchars($_POST['nom']);
    $autre=htmlspecialchars($_POST['autre']);

    if (!empty($nom) AND !empty($autre) ) {
        $query_verifier= $pdo->prepare("SELECT * FROM fournisseur WHERE nom= ? autre= ?");
        $query_verifier->execute([$nom, $autre]);
        if ($query_verifier->fetch()) {
            $messageError = "Ce fourniseur existe déjà";
        }
        else{
            $query_insertData = $pdo->prepare("INSERT INTO fournisseur(nom, autre) VALUES (?, ?)");
            $query_insertData->execute([$nom, $autre]);
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
    $idcat = $_GET['supprimer'];

    //requete de la suppression
    $query_delete = $pdo->prepare("DELETE FROM fournisseur WHERE idfourn = ?");
    if($query_delete->execute([$idfourn])){
        $message = "La suppression est effctuée avec succès";
    }else{
        $messageError = "Echec de la suppression";
    }
}

 ?>
  

  <main class="mainn">
    <form action="" class="formulaire" METHOD="POST">
        <h3>Enregistrement fournisseur</h3>
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
              <label for="Idcate">Nom fournisseur</label>
              <input type="text" name="nom"placeholder="Entrée le nom fournisseur" required="">
             </div>
            <div class="col-md-6">
               <label for="Idcate">Autre info</label>
               <input type="text" name="autre" placeholder="Entrée les information" required="">
            </div>
                <br>
            <div class="col-md-12">
                <input type="submit" name="savecat" value="Enregistrer" class="btn btn-success">
            </div>
          
    </form>

    <!-- Contact Section -->
    
    


  </main>
  <h4><center>liste des fourniseur</center></h4>
  <table class="table" border="solide 2px black">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Fourn</th>
                            <th>Nom </th>
                            <th>Autre info</th>
                            <th scope="col" collapse="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					 <?php  
                         $num = 0;
                            $query_selectdata = $pdo->prepare("SELECT * FROM fournisseur");
                            $query_selectdata->execute([]);
                          while ($data = $query_selectdata->fetch()){
                            $num = $num + 1;
                            ?>
                             <tr>
                                <th scope="row"><?=$num?></th>
                                <td><?=$data['idfourn']?></td>
                                <td><?=$data['nom']?></td>
                                <td><?=$data['autre']?></td>
                                <td>
                                 <a href="fornisseur.php?confirmer<?=$data['idfourn']?>" class="btn btn-primary bnt-sm">Modifier</a>
                                    <a href="fornisseur.php?confirmer=<?=$data['idfourn']?>" class="btn btn-danger bnt-sm">supprimer</a>
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