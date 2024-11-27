<!-- ÉTUDIANT 1 -->
<?php
    require ('autre/accesBDD.php');
    require ('autre/script/scriptEtatNouvelleAlerte.php');//NOUVELLE ALERTE -------------------
    include('autre/pageBase.php');
    $etatAlerte = getEtatNouvelleAlerte();//NOUVELLE ALERTE -------------------
    file_put_contents('autre/script/variableTableau.data', json_encode(0, JSON_PRETTY_PRINT)); 
    echo'
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <meta http-equiv="X-UA-Compatible" content="ie=edge">
                <link rel="stylesheet" href="autre/css/cssCompresseur.css">
                <title>Menu</title>
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
            </script>
            <body>';
                for($i = 0; $i < 1; ++$i)//NOUVELLE ALERTE -------------------
                    {//NOUVELLE ALERTE -------------------
                        echo '<script>nouvelleAlerte()</script>';//NOUVELLE ALERTE -------------------
                    }
                if($etatAlerte == 1)//NOUVELLE ALERTE -------------------
                    {//NOUVELLE ALERTE -------------------
                        echo '<img class="alerteImages" src="autre/images/alerte.png">
                        <input type="submit" onclick="bulleAlerte(404)" class="leBoutonNouvelleAlerte" id="boutonNouvelleAlerte" name="boutonTest" value="Nouvelle alerte !" value="">';
                    }
                else
                    {
                        echo'
                        <CENTER><button class="boutonVert" onclick="location.href=\'pageConfigurationCompte.php\'"><span style ="font-weight: bold;">Configuration<br> du <br> compte</span></button><CENTER>
                        <table>
                            <button class="boutonVert" onclick="location.href=\'pageControlerSysteme.php\'"><span style ="font-weight: bold;">Contrôler <br>le <br>système</span></button>
                            <button class="boutonVert" onclick="location.href=\'pagePlageHoraire.php\'"><span style ="font-weight: bold;">Visualiser et programmer les plages de fonctionnement</span></button>
                            <button class="boutonVert" onclick="location.href=\'pageVisualiserLesConditionsDexploitations.php\'"> <span style ="font-weight: bold;">Visualiser les conditions d\'exploitations</span></button>
                        </table>
                        <br> <br> <br> <br> <br>
                        <img src="autre/images/lyceeRaymondQueneau" alt="Lycée Raymond Queneau" width="870" height="232">';
                    }
                echo'        
            </body>
        </html>';
?>