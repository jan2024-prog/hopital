<!DOCTYPE html>
<html lang="fr">


<link rel="stylesheet" href="style.css">
<body class="mainn">
 <?php
 include('menu.php');
 require_once("connexion/connexion.php");
 //ici on commence les php pour l'enregistrement

 $message = "";
 $messageError = "";
 if (isset($_POST['saveclient'])) {
    $nomcli=htmlspecialchars($_POST['nom']);
    $adres=htmlspecialchars($_POST['adresse']);
    $phon= htmlspecialchars($_POST['telephone']);

    if (!empty($nomcli) AND !empty($adres) AND !empty($phon)) {
        $query_verifier= $pdo->prepare("SELECT * FROM client WHERE idclient= ? AND nomclient = ? AND adresse= ? AND tele= ?");
        $query_verifier->execute([$nomcli, $adres, $phon]);
        if ($query_verifier->fetch()) {
            $messageError = "Ce client existe déjà";
        }
        else{
            $query_insertData = $pdo->prepare("INSERT INTO client(nomclient, adresse, tele) VALUES (?, ?, ?)");
            $query_insertData->execute([$nomcli, $adres, $phon]);
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
    $idclient = $_GET['supprimer'];

    //requete de la suppression
    $query_delete = $pdo->prepare("DELETE FROM client WHERE idclient = ?");
    if($query_delete->execute([$idclient])){
        $message = "La suppression est effctuée avec succès";
    }else{
        $messageError = "Echec de la suppression";
    }
}
 ?>
  
    <form action="" class="formulaire" METHOD="POST">
        <h3>Enregistrement Client</h3>
        <table>
            <tr>
                <td><label>Nom client</label></td>
                <td><input type="text" name="nom" placeholder="Entrée le nom" required="required"></td>
            </tr>
            <tr>
                <td><label>Adresse</label></td>
                <td><input type="text" name="adresse" required="required"></td>
            </tr>
            <tr>
                <td><label>Telephone</label></td>
                <td><input type="number" name="telephone" required="required"></td>
            </tr>

        </table>
            <div class="col-md-12">
                <input type="submit" name="saveclient" value="Enregistrer" class="btn btn-success">
            </div>
          
    </form>
    <?php 
                if (isset($_GET['confirmer']) && ! empty($_GET['confirmer'])){?>
                    <div class="alert alert-info">Voulez-vous vraiment supprimer? <a href="client.php?supprimer=<?=$_GET['confirmer'] ?>" class="btn btn-primary btn-sm">OUI</a>  <a href="client.php" class="btn btn-danger btn-sm">NON</a></div>
                <?php
                }
            ?>
    <h4><center>liste des client</center></h4>
  <table class="table" border="solide 2px black">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Client</th>
                            <th>Nom</th>
                            <th>Adresse</th>
                            <th>Telephone</th>

                            <th scope="col" collapse="2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					 <?php  
                            $num = 0;
                           $query_selectdata = $pdo->prepare("SELECT * FROM client");
                          $query_selectdata->execute([]);
                           while ($data = $query_selectdata->fetch()){
                            $num = $num + 1;
                           ?>
                           <tr>
                               <th scope="row"><?=$num?></th>
                               <td><?=$data['idclient']?></td>
                                <td><?=$data['nomclient']?></td>
                               <td><?=$data['adresse']?></td>
								<td><?=$data['tele']?></td>
                                 <td>
                                 <a href="client.php?confirmer<?=$data['idclient']?>" class="btn btn-primary bnt-sm">Modifier</a>
                                  <a href="client.php?confirmer=<?=$data['idclient']?>" class="btn btn-danger bnt-sm">supprimer</a>
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