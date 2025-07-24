<!DOCTYPE html>
<html lang="fr">


<link rel="stylesheet" href="style.css">
<body class="mainn">
 <?php
 include('menu.php');
 ?>
 <?php
  require_once("connexion/connexion.php");
 //obtenir la date actuel
 $date_actuelle=date("Y-m-d");
 $date_limite=date("Y-m-d", strtotime("+30 days"));//30jours à partir d'aujourd'hui
 $sql="SELECT identre, nomprod, dateperemp FROM entree WHERE dateperemp='$date_limite'";

 $stmt=$pdo->prepare($sql);
 $stmt->execute(['date_actuelle'=>$date_actuelle, 'date_limite'=>$date_limite]);
 
 $produit_proches_expiration=$stmt->fetchAll(PDO::FETCH_ASSOC);
 if (count($produit_proches_expiration)>0) {
    echo"<h3>Alertes: produits proches de l'expiration</h3>";
    echo"<ul>";
    foreach ($produit_proches_expiration as $produit) {
        $jours_restants=(strtotime($produit['dateperemp'])-strtotime($date_actuelle))/(60*60*24);
        echo"<li>Le produit <strong>".
        htmlspecialchars($produit['nomprod'])."</strong> expire dans <strong>".ceil($jours_restants).
        "</strong>jour(s) (Date d'expiration :<em>".
        htmlspecialchars($produit['dateperemp'])."</em>).</li>";
    }
    echo"</ul>";
   } else {
        echo"<p>Aucun produit n'expire dans les 30 prochains jours.</p>";
    }

 
  ?>

  <footer id="footer" class="footer light-background">

    <?php
   // include('pied.php');
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