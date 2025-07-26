<?php
include('lien.php');
require_once("connexion/connexion.php");
?>
<header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <!-- <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i> -->
          <!-- <i class="bi bi-phone d-flex align-items-center ms-4"><span>+1 5589 55488 55</span></i> -->
        </div>
        <!-- <div class="social-links d-none d-md-flex align-items-center"> -->
          <a href="#" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div><!-- End Top Bar -->

    <div class="branding d-flex align-items-center">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto">
          <!-- Uncomment the line below if you also wish to use an image logo -->
          <!-- <img src="assets/img/logo.png" alt=""> -->
          <h1 class="sitename">Zone de sante Kyondo</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="home.php" class="active">Acceuil<br></a></li>
            
            
            <li class="dropdown"><a href="#"><span>Gerer</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
            <?php
                     if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_SESSION['role']=='Admin'){
                    ?>
              <ul>
                <li><a href="utilisateur.php">Utilisateur</a></li>
                <li><a href="client.php">Client</a></li>
                <li><a href="Categorie.php">Categorie</a></li>
                <li><a href="fornisseur.php">Fournisseur</a></li>
                <li><a href="Produit.php">Produits</a></li>
                <li><a href="Entree.php">Entrée</a></li>
                <li><a href="sortie.php">Sortie</a></li>
                <li><a href="listeentre.php">rapport entrée</a></li>
                <li><a href="listesortie.php">rapport sortie</a></li>
                <li><a href="fichedestock.php">Fiche de stock</a></li>
              </ul>
            </li>
            <?php
                    }
                   ?>
                   <!-- attribution droit comptable -->
                    
                  <?php
                     if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_SESSION['role']=='comptable'){
                    ?>
              <ul>
                <li><a href="client.php">Client</a></li>
                <li><a href="Entree.php">Entrée</a></li>
                <li><a href="sortie.php">Sortie</a></li>
                <li><a href="listeentre.php">rapport entrée</a></li>
                <li><a href="listesortie.php">rapport sortie</a></li>
                <li><a href="fichedestock.php">Fiche de stock</a></li>
              </ul>
            </li>
            <?php
                    }
                   ?>
                   <!-- attribution droit pharmacien -->
                   <?php
                     if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_SESSION['role']=='pharmacien'){
                    ?>
              <ul>
                <li><a href="fornisseur.php">Fournisseur</a></li>
                <li><a href="Categorie.php">Categorie</a></li>
                <li><a href="Produit.php">Produits</a></li>
                <li><a href="Entree.php">Entrée</a></li>
                <li><a href="sortie.php">Sortie</a></li>
                <li><a href="client.php">Client</a></li>
                <li><a href="listeentre.php">rapport entrée</a></li>
                <li><a href="listesortie.php">rapport sortie</a></li>
                <li><a href="fichedestock.php">Fiche de stock</a></li>
              </ul>
            </li>
            <?php
                    }
                   ?>
                   <!-- attribution droit DG -->
                   <?php
                     if(isset($_SESSION['user']['id']) && !empty($_SESSION['user']['id']) && $_SESSION['role']=='DG'){
                    ?>
              <ul>
                <li><a href="listeentre.php">rapport entrée</a></li>
                <li><a href="listesortie.php">rapport sortie</a></li>
                <li><a href="fichedestock.php">Fiche de stock</a></li>
              </ul>
            </li>
            <?php
                    }
                   ?>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#">Apropos</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <a class="cta-btn d-none d-sm-block" href="deconexion.php">Deconnexion</a>

      </div>

    </div>

  </header>