<?php
require_once("connexion/connexion.php");
// Variables de la carte (ces valeurs peuvent être dynamiques et provenir d'une base de données)
$nomOrg = "Republique democratique du congo";
$domaine= "Ministrere de la sante";
$zone="Zone de santé de kyondo";
$phoneOrg = "+243 02315647";
$emailOrg = "zonekyondo@gmail.com";


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
              
                <h1><center>Fiche de stock</center></h1>
                            
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                    <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">ID Ent</th>
                            <th scope="col">Date Ent</th>
                            <th scope="col">Date Exp</th>
                            <th scope="col">Nom Prod</th>
                           
                            <th scope="col">Quant</th>
                            <th scope="col">PU</th>
                            <th scope="col">PT</th>
                            <th scope="col">ID sort</th>
                            <th scope="col">Date sort</th>
                            <th scope="col">Nom Prod</th>
                            
                            <th scope="col">Quant</th>
                            <th scope="col">PU</th>
                            <th scope="col">PT</th>
                            <th scope="col">SF</th>



                        </tr>
                    </thead>
                    <tbody>
					<?php 
                           $num = 0;
                           $query_selectdata = $pdo->prepare("SELECT entree.identre as ID_Ent, entree.nomprod as Nom, entree.categ as categorie, 
                           entree.dosage as Dosage , entree.unitee as unite, entree.forme as forme, entree.pu as PU
                           , entree.quante, (entree.quante * entree.pu) as PT, entree.dateentre as dateenter, entree.dateperemp as dateexp,
                           COALESCE(sortie.quantevend, 0) as qtso, COALESCE(sortie.pu, 0) as prunit,(entree.quante - COALESCE(sortie.quantevend, 0)) as stock_restant,sortie.idsort as ID_Sort, sortie.datesortie as Date_sortie, sortie.nomprod as Nom_sortie,
                           sortie.dosage as Dosage_sortie , sortie.unitee as unite_sortie, sortie.forme as forme_sortie, 
                           sortie.quantevend as qtsortie, sortie.pu as pusortie, (sortie.quantevend * sortie.pu) as PTVendu FROM
                           entree LEFT JOIN sortie ON entree.idprod = sortie.idprod");
                           $query_selectdata->execute([]);
                           while ($data = $query_selectdata->fetch()){
                            $num = $num + 1;
                            ?>
                            <tr>
                                <th scope="row"><?=$num?></th>
                                <td><?=$data['ID_Ent']?></td>
                                <td><?=$data['dateenter']?></td>
                                <td><?=$data['dateexp']?></td>
                                <td><?=$data['Nom']?></td>
                                
								
								<td><?=$data['quante']?></td>
								<td><?=$data['PU']?></td>
								<td><?=$data['PT']?></td>
                            
								<td><?=$data['ID_Sort']?></td>
                                <td><?=$data['Date_sortie']?></td>
                                <td><?=$data['Nom_sortie']?></td>
                               
                                <td><?=$data['qtsortie']?></td>
                                <td><?=$data['pusortie']?></td>
                                <td><?=$data['PTVendu']?></td>
                                <td><?=$data['stock_restant']?></td>

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