<!DOCTYPE html>
<html lang="fr">



<body class="index-page">
 <?php
 include('menu.php');
 ob_start();
 ?>
  

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">

      <img src="assets/img/hero-bg.jpg" alt="" data-aos="fade-in">

      <div class="container position-relative">

        <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
          <h2>Bienvenu dans notre plateform</h2>
          <p>de gestion des produits pharmaceutique <br>de la zone de sante de Kyondo</p>
        </div><!-- End Welcome -->

        <div class="content row gy-4">
          <div class="col-lg-4 d-flex align-items-stretch">
            <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
              <h3>Alerte </h3>
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
   // echo"<h3>Alertes: produits proches de l'expiration</h3>";
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
            
            </div>
          </div><!-- End Why Box -->

          <div class="col-lg-8 d-flex align-items-stretch">
            <div class="d-flex flex-column justify-content-center">
              <div class="row gy-4">

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                    <i class="bi bi-clipboard-data"></i>
                    <h4>Domaine d'intervention</h4>
                    <p>Nous évoluons dans le domaine de la sante.</p>
                  </div>
                </div><!-- End Icon Box -->

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                    <i class="bi bi-gem"></i>
                    <h4>Categorie des produit</h4>
                    <p>Nous livrons toute categorie des produit relatif a la santé. pour concerver la vie humaine</p>
                  </div>
                </div><!-- End Icon Box -->

                <div class="col-xl-4 d-flex align-items-stretch">
                  <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                    <i class="bi bi-inboxes"></i>
                    <h4>Partenaire</h4>
                    <p>Nous somme partenaire de plusieurs entreprise medicale, 
                      dans l'objectif des satisfaire la communauté </p>
                  </div>
                </div><!-- End Icon Box -->

              </div>
            </div>
          </div>
        </div><!-- End  Content-->

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->

    <!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section light-background">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-solid fa-user-doctor"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="40" data-purecounter-duration="1" class="purecounter"></span>
              <p>Docteurs</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fa-regular fa-hospital"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="18" data-purecounter-duration="1" class="purecounter"></span>
              <p>Departments</p>
            </div>
          </div><!-- End Stats Item -->

          

          <div class="col-lg-3 col-md-6 d-flex flex-column align-items-center">
            <i class="fas fa-award"></i>
            <div class="stats-item">
              <span data-purecounter-start="0" data-purecounter-end="50" data-purecounter-duration="1" class="purecounter"></span>
              <p>Partenaire</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section>
   

    

    
   

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <!-- Section Title -->


    </section><!-- /Contact Section -->

  </main>

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