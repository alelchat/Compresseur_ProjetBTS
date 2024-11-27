<!-- ÉTUDIANT 1 et 3 -->
<?php
    require ('autre/accesBDD.php');//Pour accéder à la bdd
    include('autre/pageBase.php');
    require ('autre/script/scriptEtatNouvelleAlerte.php');//NOUVELLE ALERTE -------------------
    $etatAlerte = getEtatNouvelleAlerte();//NOUVELLE ALERTE -------------------
    //Zone page de gauche
        $monEtatCompresseur= getEtatCompresseur();
        $monFonctionnementCompresseur= getFonctionnementCompresseur();
        $monMode = getModeActuel();
                if($monEtatCompresseur[0]['etatCompresseur'] == 0)
            {
                $EtatCompresseur = "Inactif sans gonflage";
            }elseif($monEtatCompresseur[0]['etatCompresseur'] == 1)
            {
                $EtatCompresseur = "Inactif et gonflage ";
            }elseif($monEtatCompresseur[0]['etatCompresseur'] == 2)
            {
                $EtatCompresseur = "Actif sans gonflage ";
            }elseif($monEtatCompresseur[0]['etatCompresseur'] == 3)
            {
                $EtatCompresseur = "Actif et gonflage ";
            }else
            {
                $EtatCompresseur = "Erreur reception de l'état ";
            }
    //Zone page de droit
        //error_reporting(0);
        $infoCapteur = getValCapteur();
        $tableuDefaut = getListeAlertes();//Définir le tableau de la BDD ici
        for($i = 1; $i < sizeof($tableuDefaut); $i++)
            {
                $arr[$i] = $tableuDefaut[$i]['dateDefaut'];
            }
        $tableuDefautTrie;
        function compareByTimeStamp($time1, $time2)
            {
                if (strtotime($time1) < strtotime($time2))
                    return 1;
                else if (strtotime($time1) > strtotime($time2)) 
                    return -1;
                else
                    return 0;
            }
        usort($arr, "compareByTimeStamp");
        for($i = 0; $i < sizeof($arr); $i++)
            {
                $tableuDefautTrie[$i] = $arr[$i];
            }
        $elementMax = sizeof($tableuDefaut) - 1;//Savoir combien il y a t'il d'alerte. (-1 car la première ligne du tableau n'est pas un défaut)
        $elementDebut = json_decode(file_get_contents('autre/script/variableTableau.data'), true);//Commencer par rapport au repère
        $nbElement = 4;//Cette variable permet de limite le nombre d'alerte par page
        $nbElementAuto = $nbElement;
        //header("refresh");
        if(($elementMax-$elementDebut) <= 4)
        {
            $nbElementAuto = $elementMax-$elementDebut;
        }
    //affichage
  echo '
    <link rel="stylesheet" href="autre/css/cssCompresseur.css">
    <link rel="stylesheet" href="autre/css/cssCompresseurControlerSysteme.css">
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Refresh" content="20">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Contrôler système</title>
    </head>
    <script>
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
      }
      </script>';
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
    echo'
    <body>
    <script>
            function deroulementTable(valHautBas) {
                // Effectue une requête AJAX vers le script PHP
                var xhr = new XMLHttpRequest();
                xhr.open(\'POST\', \'autre/script/scriptDeroulementTable.php\', true);
                xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Traitement de la réponse du script PHP (optionnel)
                    var reponse = xhr.responseText;
                    console.log(reponse);
                    location.reload();
                    }
                };
                xhr.send(valHautBas);
            }
        </script>';
?>
    <div class="pageDeGauche">
        <div class="allumage">
            <h2 class="second_titre">Etat du compresseur</h2>
            <br>
            <div class="ovale"> <p id=etat><?php echo $EtatCompresseur; ?></p></div>
            <br>
            <div><p class="informationEtat">Le compresseur est <br>actuellement en mode :</p></div>
            <div><p class="informationEtat"><?php echo $monMode[0]['mode'] ?></p></div> 
            <br>
        </div>
        <button id="boutonEteindre" class="boutonVert" type="button"><span style="font-weight: bold;">Desactiver</span></button>
        <button id="boutonAllumer" class="boutonVert" type="button"><span style="font-weight: bold;">Activer</span></button>
        </div>
        <script>
            document.getElementById("boutonEteindre").addEventListener("click", function() {
            // Effectue une requête AJAX vers le script PHP
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "autre/script/scriptEteindreCompresseur.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                // Traitement de la réponse du script PHP (optionnel)
                var reponse = xhr.responseText;
                location.reload();
                }
            };
            xhr.send();
            });
            document.getElementById("boutonAllumer").addEventListener("click", function() {
            // Effectue une requête AJAX vers le script PHP
            var xhr = new XMLHttpRequest();
            xhr.open("GET", "autre/script/scriptAllumerCompresseur.php", true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                // Traitement de la réponse du script PHP (optionnel)
                var reponse = xhr.responseText;
                location.reload();
                }
            };
            xhr.send();
            });
        </script>
<?php
echo'
    <div class="pageDeDroit"><!-- style="float: right;" -->
        <h2 style="margin-top: 0%" >Historique d\'alerte</h2>
        <div style="margin-right:auto">
            <!-- Tableau -->
            <div class="zoneTableau">
                <div style="float: right;">
                    <table class="tableHistoriqueSeuilsAlerte"><!-- Le tableau   -->
                        <tr><!-- LIGNE TYPE -->
                            <th>
                                <CENTER><!--  Le center permet de centre le texte  -->
                                    Type
                                <CENTER>
                            </th>
                            <th>
                                <CENTER>
                                    Date
                                <CENTER>
                            </th>
                            <th>
                                <CENTER>
                                    Heure
                                <CENTER>
                            </th>
                            <th>
                                <CENTER>
                                    Seuil atteint
                                <CENTER>
                            </th>
                        </tr>';
                        for($i1=$elementDebut+1;$i1<$nbElementAuto+$elementDebut+1;$i1++){
                            $laboucle = 1;
                            for($i = 0; $laboucle; $i++)
                            {
                                if($tableuDefaut[$i]['dateDefaut'] == $tableuDefautTrie[$i1 -1])
                                {
                                    echo '
                                    <tr><!-- LIGNE 1 -->
                                        <td>
                                            <CENTER>
                                                '.$tableuDefaut[$i]['typeDefaut'].'
                                            <CENTER>
                                        </td>
                                        <td>
                                            <CENTER>
                                                '.$tableuDefaut[$i]['dateDefaut'].'
                                            <CENTER>
                                        </td>
                                        <td>
                                            <CENTER>
                                                '.$tableuDefaut[$i]['heureDefaut'].'
                                            <CENTER>
                                        </td>
                                        <td>
                                            <CENTER>
                                            '.$tableuDefaut[$i]['seuilAtteint'];
                                            
                                            if($tableuDefaut[$i]['idMesure'] == 1)
                                            {
                                                echo $infoCapteur[0]['uniteMesure'];
                                            }
                                            elseif($tableuDefaut[$i]['idMesure'] == 2)
                                            {
                                                echo $infoCapteur[1]['uniteMesure'];
                                            }
                                            else{
                                                echo 'erreur';
                                            }
                                            echo '
                                            <CENTER>
                                        </td>
                                    </tr>';
                                    $laboucle = 0;
                                }
                                else
                                {
                                    $laboucle = 1;
                                }
                            }
                        }

                    echo'
                    </div>
                </table>
                <table id="tableauBouton">
                <tr>
                    <td>
                        <a id="boutonHaut" onclick="deroulementTable(-1)" href="?debutelement='.($elementDebut).'"><button type="submit" class="lesBoutons"  value="" style="margin-top: 5%; color: #85C1E9;" >▲</button></a>
                    </td>
                    <td>
                        <a id="boutonProgrammerSeuilsAlerte" href="pageDefinirSeuilsAlerte.php" ><button type="submit" class="lesBoutons"  value="" ">Programmer des<br/>seuils d\'alerte</button></a>
                    </td>
                    <td>
                        <a id="boutonBas" onclick="deroulementTable(1)" href="?debutelement='.($elementDebut).'"><button type="button" class="lesBoutons"  onclick="tableauDeroulantBas()" value="" style="margin-top: 5%; color: #85C1E9;" >▼</button></a>
                    </td>
                </tr><!-- Mettre les bons chemins -->
            </table>  
            </div>
        </div>      
    </div>
    <button class="boutonVertRetour" onclick="location.href=\'pageMenu.php\'">
    <span style ="font-weight: bold">Retour</span></button>
    </body>';
  }//NOUVELLE ALERTE -------------------

      
?>
