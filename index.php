<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="login.css">
    <meta name="viewport" content="width=device-widt,initial-scale=1.0">
    <title>Login</title>
    </head>
    <body>
        <form class="box" method="POST" action="traitement.php" >
                         <?php
                              if(isset($_GET['message']) && ! empty($_GET['message'])){
                               ?>
                                <div class="alert alert-danger"><?= htmlentities($_GET['message'])?></div>
                                  <?php
                                }

                            ?>
            <h1>Login</h1>
            <input type="text" placeholder="Nom Utilisateur" name="user">
            <input type="password" placeholder="Mot de Passe"name="pw">
            <input type="submit" value="Connexion" name="envoyer">       
            <a href="#">Creer un Compte ?</a>
        </form>
    </body>
</html>