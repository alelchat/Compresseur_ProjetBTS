<!-- ÉTUDIANT 1 -->
<!DOCTYPE html>
<html lang="fr">

<?php
    require('autre/accesBDD.php');
    include('autre/pageBase.php');
    require ('autre/script/scriptEtatNouvelleAlerte.php');//NOUVELLE ALERTE -------------------
    $etatAlerte = getEtatNouvelleAlerte();//NOUVELLE ALERTE -------------------
    $maPression = getPression();
    //var_dump($maPression);
    $maEnergie= getEnergie();
    //-------var_dump($maEnergie);------
    //addMesure(1,76);
    //$monPlusRecent = getPlusRecent(1);
    //var_dump($monPlusRecent);

    echo '<script>
    function nouvelleAlerte(){//NOUVELLE ALERTE -------------------
        // Effectue une requête AJAX vers le script PHP
        var xhr = new XMLHttpRequest();
        xhr.open(\'POST\', \'autre/script/scriptNouvelleBulleAlerte.php\', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP (optionnel)
            var reponse = xhr.responseText;
            console.log(reponse);
          }
        };
        xhr.send();
        }
  function bulleAlerte(alerteVal){//NOUVELLE ALERTE -------------------
    // Effectue une requête AJAX vers le script PHP
    var xhr = new XMLHttpRequest();
    xhr.open(\'POST\', \'autre/script/scriptEtatNouvelleAlerte.php\', true);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Traitement de la réponse du script PHP (optionnel)
        var reponse = xhr.responseText;
        console.log(reponse);
        window.location.href="pageControlerSysteme.php"; 
      }
    };
    xhr.send(alerteVal);
    }</script>';


    for($i = 0; $i < 1; ++$i)//NOUVELLE ALERTE -------------------
    {//NOUVELLE ALERTE -------------------
        echo '<script>nouvelleAlerte()</script>';//NOUVELLE ALERTE -------------------
    }//NOUVELLE ALERTE -------------------
    if($etatAlerte == 1)//NOUVELLE ALERTE -------------------
    {//NOUVELLE ALERTE -------------------
        echo '<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="autre/css/cssCompresseur.css">
        <title>Seuils d\'alerte</title>
    </head>';
        echo '<img class="alerteImages" src="autre/images/alerte.png">
        <input type="submit" onclick="bulleAlerte(404)" class="leBoutonNouvelleAlerte" id="boutonNouvelleAlerte" name="boutonTest" value="Nouvelle alerte !" value="">';
    }//NOUVELLE ALERTE -------------------
    else
    {
        echo '<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="autre/css/pageDeBase.css">
        <link rel="stylesheet" href="autre/css/cssCompresseur.css">
        <title>Estimation</title>
    </head>
    
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
    <body>
  <canvas id="myChart"></canvas>';
    }//NOUVELLE ALERTE -------------------
?>









  
  
  
  <?php
/*
  // Créer un tableau de données pour le graphique
  $dataPoints = array(
      array("label" => "Énergie", "y" => 1,2,3,4,5),
  );

  // Convertir les données en format JSON pour Chart.js
  $dataPointsJson = json_encode($dataPoints);
  var_dump($maEnergie);
  var_dump($dataPoints);
  */
  ?>

	<!-- Créer le graphique -->
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="myChart"></canvas>
<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['V1','V2','V3','V4','V5','V6','V7','V8'],
            datasets: [{
                label: 'Estimation',
                data: <?php /*echo $dataPointsJson;*/ ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
</script> -->

    
</body>
</html>