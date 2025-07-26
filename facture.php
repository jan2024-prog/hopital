<?php
require_once("connexion/connexion.php");
// Variables de la carte (ces valeurs peuvent être dynamiques et provenir d'une base de données)
$nomOrg = "Republique democratique du congo";
$domaine= "Ministrere de la sante";
$zone="Zone de santé de kyondo";
$phoneOrg = "+243 02315647";
$emailOrg = "zonekyondo@gmail.com";

if (isset($_GET['recu']) && ! empty($_GET['recu'])){
    $_SESSION['recu'] = $_GET['recu'];
}





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carte </title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="no-print mb-3">
            <button class="btn btn-primary" onclick="history.back()">
                <i class="bi bi-arrow-left"></i>
            </button>
        </div>
           
            <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h4><?php echo htmlspecialchars($nomOrg); ?></h4>
                        <p>
                            <?php echo htmlspecialchars($domaine); ?><br>
                            <?php echo htmlspecialchars($zone); ?><br>

                            Téléphone: <?php echo htmlspecialchars($phoneOrg); ?><br>
                            Email: <?php echo htmlspecialchars($emailOrg); ?>
                        </p>
                    </div>
                    <div class="col-6 text-end">
                       
                    </div>
                </div>
              
                <h1><center>Facture</center></h1>
                            
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Designation</th>
                            <th scope="col">PU</th>
                            <th scope="col">PT</th>



                        </tr>
                    </thead>
                    <tbody>
					<?php 
                           $num = 0;
                           $query_selectdata = $pdo->prepare("SELECT client.nomclient as nom, sortie.pu as pusort, sortie.quantevend as quanti, sortie.nomprod as nompro,
                           (sortie.pu* sortie.quantevend) as ptm FROM client INNER JOIN sortie ON client.idclient = sortie.idclient where sortie.idsort= ?");
                           $query_selectdata->execute([$_SESSION['recu']]);
                           $query_selectdata->execute([]);
                           while ($data = $query_selectdata->fetch()){
                            $num = $num + 1;
                            ?>
                            <tr>
                                <th scope="row"><?=$num?></th>
                                <td><?=$data['quanti']?></td>
                                <td><?=$data['nompro']?></td>
                                <td><?=$data['pusort']?></td>
                                <td><?=$data['ptm']?></td>
                            </tr>
                        <?php
                        }
                        ?> 
                        </tr>
                    </tbody>
                </table>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 text-end">
                       
                    </div>
                </div>
            </div>
        </div><br><br>
        
        

        
        <div class="no-print mb-3">
            <button class="btn btn-primary" onclick="window.print()">
                <i class="bi bi-printer"></i> Imprimer
            </button>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js"></script>
    <script src="cdn.js"></script>
</body>
</html>