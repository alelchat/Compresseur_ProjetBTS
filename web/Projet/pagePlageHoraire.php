<!-- ÉTUDIANT 2 -->
<?php
    require('autre/accesBDD.php'); 
    require ('autre/script/scriptEtatNouvelleAlerte.php');//NOUVELLE ALERTE -------------------
    $etatAlerte = getEtatNouvelleAlerte();//NOUVELLE ALERTE -------------------
    //si des données ont été transmise alors les enregistrer dans la bdd

    echo '<script>function nouvelleAlerte(){//NOUVELLE ALERTE -------------------
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

    if(!empty($_POST)) 
        {
            $bdd = connexionBDD();
            if($bdd == true)
                {
                    for($index = 1; $index <= 52; $index++)
                        {
                            UpdateSemaine($_POST['s'.$index], $index, $bdd);
                        }
                    for($index = 1; $index <= 168; $index++)
                        {
                            UpdateCreneaux($_POST['c'.$index], $index, $bdd);
                        }
                    UpdateSemaineEntretien($_POST['sEntretien'], $bdd);
                }
        }
    //lire dans la bdd les états des semaines
    $donneesRecuSemaine = getSemaine();
    $donneesRecuCreneaux = getCreneaux();
    $donneeRecuSemaineEntretien = getSemaineEntretien();
    if($donneeRecuSemaineEntretien == false)
        {
            if(!empty($_POST))
                {
                    if($_POST['sEntretien'] == 0)
                        {
                            $donneeRecuSemaineEntretien['id'] = "0";
                        }
                    else
                        {
                            $donneeRecuSemaineEntretien['id'] = "";
                        }
                }
            else
                {
                $donneeRecuSemaineEntretien['id'] = "0";
                }
        }
    $listeSemaine1 = 1;
    $listeSemaine2 = 13;
    $semaine1 = 1;
    $header = ' <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="autre/css/cssCompresseurPlageHoraire.css">
                <title>Plage horaire</title>';
    $script = '<script src="autre/javascript/jsCompresseurPlageHoraire.js"></script>';

    for($i = 0; $i < 1; ++$i)//NOUVELLE ALERTE -------------------
    {//NOUVELLE ALERTE -------------------
        echo '<script>nouvelleAlerte()</script>';//NOUVELLE ALERTE -------------------
    }//NOUVELLE ALERTE -------------------
    if($etatAlerte == 1)//NOUVELLE ALERTE -------------------
    {//NOUVELLE ALERTE -------------------
        include('autre/pageBase.php'); 
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
        $rectangleSemaine = '<input id="semaineAffichage" type="text" readonly="readonly" class="sAffichage" value="0"/>';
    // Affichage des semaines. Cela permettra à l'utilisateur de définir les semaines actives.
    $semainehoraire = '
        <form method="POST" action="pagePlageHoraire.php">
        <div id="bloc1">
        <table id=tableau1 class="table table-bordered">';
    for($ligne = 0; $ligne < 4 ; $ligne++){
        if($ligne != 0)
            {
                $listeSemaine1 += 13;
                $listeSemaine2 += 13;
            }
        $semainehoraire .= '<tr>
        <th> Semaine '.$listeSemaine1.' - '.$listeSemaine2.' </th>';
        for($colonne = 0; $colonne < 13; $colonne++)
            {
                $index = ($colonne+1)+($ligne*13)+$semaine1-1;
                $semainehoraire .= '<td id="element'.$index.'" onClick="changerSemaine('.$index.')" style="background-color:whitesmoke">';
                $semainehoraire .= $index;
                $semainehoraire .= '<input id="inputSemaine'.$index.'" type="hidden" name="s'.$index.'" value="'.$donneesRecuSemaine[$index-1]['actif'] .'" />';//changer value 0 par la valeur présente dans la bdd
                $semainehoraire .= '</td>';
            }
        $semainehoraire .= '</tr>';
        }
    $semainehoraire .= '</div>';
    $semainehoraire .= '</table>';
    $semainehoraire .= '<div id= divSemaineEntretion>';
    $semainehoraire .= '<p> Semaine d entretien </p> <input id="semaineEntretien" type="text" name="sEntretien" value="'.$donneeRecuSemaineEntretien['id'].'" />';
    $semainehoraire .= '</div>';
    // Affichage des creneaux horaire. Cela permettra à l'utilisateur de définir les jours et heures de fonctionnement.
    $creneauxHoraire = '<table id=tableau2 class="table table-bordered">';
    for($ligne = 0; $ligne < 8; $ligne++){
        $jour;
        switch($ligne){
            case 0:
                $jour = 'Jour | Heure';
                break;
            case 1:
                $jour = 'Lundi';
                break;
            case 2:
                $jour = 'Mardi';
                break;
            case 3:
                $jour = 'Mercredi';
                break;
            case 4:
                $jour = 'Jeudi';
                break;
            case 5:
                $jour = 'Vendredi';
                break;
            case 6:
                $jour = 'Samedi';
                break;
            case 7:
                $jour = 'Dimanche';
                break;
            }
        $index = -1;
        $creneauxHoraire .= '<tr>';
        $creneauxHoraire .= '<th>'.$jour.'</th>';
        if($ligne == 0)
            {
                for($colonne = 0; $colonne < 24; $colonne++)
                {
                    if($colonne <= 9)
                        {
                            $creneauxHoraire .= '<th>0'.$colonne.'h</th>';
                        }
                    else
                        {
                            $creneauxHoraire .= '<th>'.$colonne.'h</th>';
                        }
                }
            }
        else
            {
                for($colonne = 0; $colonne < 24; $colonne++)
                    {
                        $index = ($colonne+1)+(($ligne-1)*24);
                        $creneauxHoraire .= '<td id="creneaux'.$index.'" onClick="changerCreneaux('.$index.')" style="background-color:whitesmoke">';
                        $creneauxHoraire .= '<input id="inputCreneaux'.$index.'" type="hidden" name="c'.$index.'" value="'.$donneesRecuCreneaux[$index-1]['actif'].'"/>';
                        $creneauxHoraire .= '</td>';
                    }     
            }
        $creneauxHoraire .= '</tr>';
    }
    $creneauxHoraire .= '</table>';
    $boutonValidation = '<table id="tableauBouton">
    <tr>
        <td><a href="pageMenu.php"><input type="button" class="lesBoutons" id="boutonAnnuler" value="  Annuler  "onClick="annulerData()" /></a></td>
        <td><a href="pageMenu.php"><input type="button" class="lesBoutons" id="boutonRetour" value="  Retour "/></a></td>
        <td><input type="submit" class="lesBoutons" id="boutonEnregistrer" value="Enregistrer" onClick="enregistrerData();sendData()"/></td>
    </tr>  <!-- Mettre les bons chemins -->
    </table></form>';
    $bodyHtml = $rectangleSemaine;
    $content = $semainehoraire;
    $content .= $creneauxHoraire;
    $content .= $boutonValidation;
    include('autre/pageBase.php'); 
    }//NOUVELLE ALERTE -------------------

    
    
?>