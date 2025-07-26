<?php
require_once("connexion/connexion.php");
if(isset($_POST['envoyer'])){
    $usename=htmlspecialchars($_POST['user']);
    $password=htmlspecialchars($_POST['pw']);

    $query_admin=$pdo->prepare("SELECT * FROM utilisateur WHERE nom =? AND  motdepasse = ?");
    $query_admin->execute([$usename, $password]);
    
    if($data=$query_admin->fetch()){
        if($data['fonct']=='Admin'){
            $_SESSION['user']['id']=$data['id'];
            $_SESSION['role']='Admin';
            header("location:home.php");
        }elseif($data['fonct']=='comptable'){
            $_SESSION['user']['id']=$data['id'];
            $_SESSION['role']='comptable';
            header("location:home.php");
        }elseif($data['fonct']=='pharmacien'){
            $_SESSION['user']['id']=$data['id'];
            $_SESSION['role']='pharmacien';
            header("location:home.php");
        }else{
            $_SESSION['user']['id']=$data['id'];
            $_SESSION['role']='DG';
            header("location:home.php");
        }

    }else{
        $message="nom d'utilisateur ou/et mot de passe incorect";
        header("location:index.php?message=$message");
    }
}