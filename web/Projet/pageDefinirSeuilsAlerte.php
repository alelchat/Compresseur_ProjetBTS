<!-- ÉTUDIANT 3 -->
<!-- Reste un problème de remise a 0 des etat en désactif. Pour cela je vais voir si dans la base de données l'état des seuils si
ils sont actifs ou non, en accompagnement des conditions if à la dernière partie du code.-->
<?php
  require ('autre/accesBDD.php');//Pour accéder à la bdd
  include('autre/pageBase.php');
  require ('autre/script/scriptEtatNouvelleAlerte.php');//NOUVELLE ALERTE -------------------
  $etatAlerte = getEtatNouvelleAlerte();//NOUVELLE ALERTE -------------------
  $configSeuilsAlerte = getConfigurationSeuilsAlerte();
  $infoCapteur = getValCapteur();
  error_reporting(0);
  file_put_contents('autre/script/variableTableau.data', json_encode(0, JSON_PRETTY_PRINT)); 

  echo'<script>
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

    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="autre/css/cssCompresseur.css">
        <link rel="stylesheet" href="autre/css/cssCompresseurDefinirSeuilsAlerte.css">
        <link rel="stylesheet" href="autre/javascript/jsCompresseurControlerSysteme.js">
        <title>Seuils d\'alerte</title>
    </head>';

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
      <form method = "POST">
      <h2>Seuils d\'alerte</h2>
      <div class="zoneTableau">
        <table class="tableSeuilsAlerte"><!-- Le tableau   -->
          <tr><!--  Le center permet de centre le texte  -->
            <th>
              <CENTER>
                Numéro
              <CENTER>
            </th>
            <th>
              <CENTER>
                Type
              <CENTER>
            </th>
            <th>
              <CENTER>
                Seuil minimun
              <CENTER>
            </th>
            <th>
              <CENTER>
                Activation<br>Désactivation<br>Seuil minimun
              <CENTER>
            </th>
            <th>
              <CENTER>
                Seuil maximun
              <CENTER>
            </th>
            <th>
              <CENTER>
                Activation<br>Désactivation<br>Seuil maximun
              <CENTER>
            </th>
          </tr>
          <tr>
          <td><CENTER>N°1<CENTER>
            </td>
            <td><CENTER>'.$infoCapteur[0]["nomMesure"].'<CENTER></td>
              <!-- Voir pour mettre un text -->
              <td><CENTER><input type="text" class="valeur" name="valeurPressionMin" value="'.$configSeuilsAlerte[0]["seuilMin"].'"/> '.$infoCapteur[0]['uniteMesure'].'<CENTER></td><!--  A modifer avec les données  -->
              <td>
                <CENTER>
                <label class="zoneCheck" style="width:90px" id="checkValeurPressionMin">
                  <input type="checkbox" name="checkValeurPressionMinVal"';
                  if($configSeuilsAlerte[0]["etatSeuilMin"] == 0)
                  {
                    echo 'unchecked';
                  }
                  else
                  {
                    echo 'checked';
                  }
                  echo'>
                  <img class="img-unchecked" src="autre/images/inactif.png" width="89px" >
                  <img class="img-checked" src="autre/images/actif.png" width="90px">
                </label>
                <CENTER>
              </td>
              <td><CENTER><input type="text" class="valeur" name="valeurPressionMax" value="'.$configSeuilsAlerte[0]["seuilMax"].'"/> '.$infoCapteur[0]['uniteMesure'].'<CENTER></td><!--  A modifer avec les données  -->
              <td>
                <CENTER>
                <label class="zoneCheck" style="width:90px" id="checkValeurPressionMax">
                  <input type="checkbox" name= "checkValeurPressionMaxVal"';
                  if($configSeuilsAlerte[0]["etatSeuilMax"] == 0)
                    {
                      echo 'unchecked';
                    }
                  else
                    {
                      echo 'checked';
                    }
                  echo'>
                  <img class="img-unchecked" src="autre/images/inactif.png" width="89px" >
                  <img class="img-checked" src="autre/images/actif.png" width="90px">
                </label>
                <CENTER>
              </td>
          </tr>
          <tr>
          <td><CENTER>N°2<CENTER></td>
            <td><CENTER>'.$infoCapteur[1]["nomMesure"].'<CENTER></td><!--  A modifer avec les données  -->
            <td><CENTER><input type="text" class="valeur" name="valeurWattMin" value="'.$configSeuilsAlerte[1]["seuilMin"].'"/> '.$infoCapteur[1]['uniteMesure'].'<CENTER></td><!--  A modifer avec les données  -->
            <td>
              <CENTER>
              <label class="zoneCheck" style="width:90px" id="checkValeurPressionMax">
                <input type="checkbox" name="checkValeurWattMinVal"';
                if($configSeuilsAlerte[1]["etatSeuilMin"] == 0)
                  {
                    echo 'unchecked';
                  }
                  else
                  {
                    echo 'checked';
                  }
                  echo'>
                  <img class="img-unchecked" src="autre/images/inactif.png" width="89px" >
                  <img class="img-checked" src="autre/images/actif.png" width="90px">
              </label>
              <CENTER>
            </td>
            <td><CENTER><input type="text" class="valeur" name="valeurWattMax" value="'.$configSeuilsAlerte[1]["seuilMax"].'"/> '.$infoCapteur[1]['uniteMesure'].'<CENTER></td><!--  A modifer avec les données  -->
            <td>
              <CENTER>
              <label class="zoneCheck" style="width:90px" id="checkValeurWattMax">
                <input type="checkbox" name="checkValeurWattMaxVal"';
                if($configSeuilsAlerte[1]["etatSeuilMax"] == 0)
                  {
                    echo 'unchecked';
                  }
                else
                  {
                    echo 'checked';
                  }
                  echo'>
                    <img class="img-unchecked" src="autre/images/inactif.png" width="89px" >
                    <img class="img-checked" src="autre/images/actif.png" width="90px">
              </label>
              <CENTER>
            </td>
          </tr>

        </table>
      </div>
      <!--  Les boutons  -->
      <!-- <div class="zoneBouton"> -->

        <table id="tableauBouton">
          <tr>
            <td><a onclick="modif(0)"><input type="button" class="lesBoutons" id="boutonAnnuler" value="  Retour  "/></a></td>
            <td><a onclick="modif(1)"><input type="submit" class="lesBoutons" id="boutonEnregistrer" value="Enregistrer"  /></a></td>
          </tr> 
      </table>
      </form>
    </body>'; 

    }//NOUVELLE ALERTE -------------------

/* LES CHECKS */
/* Check seuil pression MIN */
if($_POST['checkValeurPressionMinVal'] == true)
{
  setConfigurationSeuilsAlerte("etatSeuilMin", 1, 1);
}
elseif($_POST['checkValeurPressionMinVal'] == false)
{
  setConfigurationSeuilsAlerte("etatSeuilMin", 0, 1);
}
else{
  echo'erreur';
}
/* Check seuil pression MAX */
if($_POST['checkValeurPressionMaxVal'] == true)
{
  setConfigurationSeuilsAlerte("etatSeuilMax", 1, 1);
}
elseif($_POST['checkValeurPressionMaxVal'] == false)
{
  setConfigurationSeuilsAlerte("etatSeuilMax", 0, 1);
}
else{
  echo'erreur';
}
/* Check seuil puissance MIN */
if($_POST['checkValeurWattMinVal'] == true)
{
  setConfigurationSeuilsAlerte("etatSeuilMin", 1, 2);
}
elseif($_POST['checkValeurWattMinVal'] == false)
{
  setConfigurationSeuilsAlerte("etatSeuilMin", 0, 2);
}
else{
  echo'erreur';
}
/* Check seuil puissance MAX */
if($_POST['checkValeurWattMaxVal'] == true)
{
  setConfigurationSeuilsAlerte("etatSeuilMax", 1, 2);
}
elseif($_POST['checkValeurWattMaxVal'] == false)
{
  setConfigurationSeuilsAlerte("etatSeuilMax", 0, 2);
}
else{
  echo'erreur';
}
/* LES VALEURS */
//La pression :
if($_POST['valeurPressionMin'] != NULL) // MIN
{      
  setConfigurationSeuilsAlerte("seuilMin", $_POST['valeurPressionMin'], 1);
}
if($_POST['valeurPressionMax'] != NULL) // MAX
{      
  setConfigurationSeuilsAlerte("seuilMax", $_POST['valeurPressionMax'], 1);
}
//LA PUISSANCE
if($_POST['valeurWattMin'] != NULL) // MIN
{      
  setConfigurationSeuilsAlerte("seuilMin", $_POST['valeurWattMin'], 2);
}
if($_POST['valeurWattMax'] != NULL) // MAX
{      
  setConfigurationSeuilsAlerte("seuilMax", $_POST['valeurWattMax'], 2);
}
?>
<!--  CODE A METTRE DANS LE PHP  -->
<script> 
function modif(val)
{
  if(val == 1)
  {
    alert("Modification enregistré.");
  }
  window.location.href="pageControlerSysteme.php"; 
}
</script>