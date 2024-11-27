<!-- ÉTUDIANT 3 -->
<!-- Il reste de finir le fonctionnement du tableau de droite -->
<?php
require ('autre/accesBDD.php');//Pour accéder à la bdd
include('autre/pageBase.php');
require ('autre/script/scriptEtatNouvelleAlerte.php');//NOUVELLE ALERTE -------------------
$tableauEmailDesorganise = getEmail();
for($i = 0; $i < sizeof($tableauEmailDesorganise) ; ++$i)
  {
    $tableauEmail[$i] = $tableauEmailDesorganise[$i];
  }

$elementTableauEmailMax = sizeof($tableauEmail);
$nbEmailMax = 4;
$affichageMax = 0;
if($elementTableauEmailMax == $nbEmailMax)
  {
    $affichageMax = $nbEmailMax;
  }
else
  {
    $affichageMax = $elementTableauEmailMax;
  }
$verifNouveauEmail = false;
if((($elementTableauEmailMax) - $nbEmailMax) <= 0 )
  {
    $verifNouveauEmail = true;
  }
else{
    $verifNouveauEmail = false;
  }
$tableauInfo = array("Informations","Adresse IP", "Relais", "Email","MDP Email");
$tableauIntitule = array("info","ipCompresseur","relais","adresseMail","motDePasse");
$tableauFonction = array("valeurInformation", "valeurAdresseIP", "valeurRelais", "valeurAdresseMail", "valeurMotDePasse");
$tableauAction = array("modifInformation()", "modifAdresseIP()","modifRelais()","modifEmail()","modifMdp()");
$etatAlerte = getEtatNouvelleAlerte();//NOUVELLE ALERTE -------------------
echo'
  <link rel="stylesheet" href="autre/css/cssCompresseur.css">
  <link rel="stylesheet" href="autre/css/cssCompresseurConfigurationCompte.css">
  <!DOCTYPE html>
  <html lang="fr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="autre/css/cssCompresseur.css">
    <title>Configuration compte</title>
  </head>
  <script>
    function suppEmail(idemail) {
        // Effectue une requête AJAX vers le script PHP
        var xhr = new XMLHttpRequest();
        xhr.open(\'POST\', \'autre/script/scriptSuppEmail.php\', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP (optionnel)
            var reponse = xhr.responseText;
            console.log(reponse);
            location.reload();
            }
          };
        xhr.send(idemail);
      }
    function addEmail() {
        // Effectue une requête AJAX vers le script PHP
        var email = document.querySelector(\'#valeurEmail\').value;
        if(! (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)))
        {
          alert("Adresse email non correct.")
          return (false)
        }
        var xhr = new XMLHttpRequest();
        xhr.open(\'POST\', \'autre/script/scriptAddEmail.php\', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP (optionnel)
            var reponse = xhr.responseText;
            console.log(reponse);
            location.reload();
          }
        };
        xhr.send(email);
      }
    function suppVal(valIntitule){
      // Effectue une requête AJAX vers le script PHP
      var xhr = new XMLHttpRequest();
      xhr.open(\'POST\', \'autre/script/scriptSuppIntitule.php\', true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Traitement de la réponse du script PHP (optionnel)
          var reponse = xhr.responseText;
          console.log(reponse);
          location.reload();
          }
        };
      xhr.send(valIntitule);
      }
    function modifInformation()
      {
        // Effectue une requête AJAX vers le script PHP
        var information = document.querySelector(\'#valeurInformation\').value;
        var xhr = new XMLHttpRequest();
        xhr.open(\'POST\', \'autre/script/scriptModifInfoCompresseur.php\', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP (optionnel)
            var reponse = xhr.responseText;
            console.log(reponse);
            location.reload();
          }
        };
        xhr.send(information);
      }
    function modifAdresseIP()
      {
        // Effectue une requête AJAX vers le script PHP
        var adresseIP = document.querySelector(\'#valeurAdresseIP\').value;
        //      https://regex101.com/codegen?language=javascript
        var expressionReguliere = /^(\d{1,3}\.){3}\d{1,3}$/
        if (!(expressionReguliere.test(adresseIP)))
        {
          alert("Adresse IP non correct.")
          return (false)
        }

        var xhr = new XMLHttpRequest();
        xhr.open(\'POST\', \'autre/script/scriptModifAdresseIP.php\', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP (optionnel)
            var reponse = xhr.responseText;
            console.log(reponse);
            location.reload();
          }
        };
        xhr.send(adresseIP);
      }
    function modifRelais(){
      // Effectue une requête AJAX vers le script PHP
        var relais = document.querySelector(\'#valeurRelais\').value;
        var xhr = new XMLHttpRequest();
        xhr.open(\'POST\', \'autre/script/scriptModifRelais.php\', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP (optionnel)
            var reponse = xhr.responseText;
            console.log(reponse);
            location.reload();
          }
        };
        xhr.send(relais);
      }
    function modifEmail(){
        // Effectue une requête AJAX vers le script PHP
        var mail = document.querySelector(\'#valeurAdresseMail\').value;
        if(! (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(mail)))
        {
          alert("Adresse email non correct.")
          return (false)
        }
        var xhr = new XMLHttpRequest();
        xhr.open(\'POST\', \'autre/script/scriptModifEmail.php\', true);
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse du script PHP (optionnel)
            var reponse = xhr.responseText;
            console.log(reponse);
            location.reload();
          }
        };
        xhr.send(mail);
      }
    function modifMdp(){
      // Effectue une requête AJAX vers le script PHP
      var mdp = document.querySelector(\'#valeurMotDePasse\').value;
      var xhr = new XMLHttpRequest();
      xhr.open(\'POST\', \'autre/script/scriptModifMDP.php\', true);
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
          // Traitement de la réponse du script PHP (optionnel)
          var reponse = xhr.responseText;
          console.log(reponse);
          location.reload();
        }
      };
      xhr.send(mdp);
      }
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
    echo '<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="autre/css/cssCompresseur.css">
        <title>Seuils d\'alerte</title>
    </head>';
    echo '<script>nouvelleAlerte()</script>';//NOUVELLE ALERTE -------------------
  }//NOUVELLE ALERTE -------------------
  if($etatAlerte == 1)//NOUVELLE ALERTE -------------------
  {//NOUVELLE ALERTE -------------------
    echo '<img class="alerteImages" src="autre/images/alerte.png">
    <input type="submit" onclick="bulleAlerte(404)" class="leBoutonNouvelleAlerte" id="boutonNouvelleAlerte" name="boutonTest" value="Nouvelle alerte !" value="">';
  }//NOUVELLE ALERTE -------------------
  else{
    echo'
      <h2>Configuration compte</h2>

      <div class="pageDeGauche" style="float: left;"><!-- style="float: right;" -->
        <h2 class="titreConfig" id="titreEmail">Adresse(s) à avertir :</h2>
        <table class="tableauConfig"><!-- Le tableau   -->
          <tr>
            <th>
              Numéro
            </th>
            <th>
              Email : 4 maximum
            </th>
            <th>
              Action
            </th>
          </tr>';
          for($i = 1; $i < $affichageMax; ++$i)
          {
            echo '
            <tr>
              <td>N°'.($i).' </td>
              <td>'.$tableauEmail[$i]['adresseMail'].'</td>
              <td><a onclick="suppEmail('.$tableauEmail[$i]['id'].')"><img class="images" src="autre/images/inactif.png"></a></td>
            </tr>';
          }
          if($verifNouveauEmail == true)
          {
            echo '
            <tr>
              <td>N°'.($elementTableauEmailMax).'</td>
              <td><input type="text" class="valeur" name="email" id="valeurEmail" placeholder="..."/></td>
              <td><a onclick="addEmail()"><img class="images" src="autre/images/actif.png"></a></td>
            </tr>';
          }
          echo'
        </table>
        <a href="pageMenu.php" id="zoneBoutonRetour"><input type="button" class="lesBoutons" id="boutonRetour" value="Retour" value=""></a>
      </div>

      <div class="pageDeDroit">
        <h2 class="titreConfig" id="titreCompresseur">Compresseur :</h2>
        <table class="tableauConfig">
          <tr>
            <th>
              Intitulé
            </th>
            <th>
              Valeur
            </th>
            <th>
              Action
            </th>
          </tr>';
          for($i = 0; $i < sizeof($tableauInfo); ++$i)
          {//("info","ipCompresseur","relais","adresseMail","motDePasse");
            echo '
              <tr>
                <td>'.$tableauInfo[$i].'</td>';//Intitulé
                if($tableauEmail[0][$tableauIntitule[$i]] != NULL)//Si il y a une valeur
                {
                  if($tableauIntitule[$i]=="motDePasse")//Si c'est le MDP
                  {
                    echo '<td>CONFIDENTIEL</td>';
                    echo '<td><a onclick="suppVal(\'motDePasse\')"><img class="images" src="autre/images/inactif.png"></a></td>
                  </tr>';
                  }
                  else{//si ce n'est pas le mdp
                    echo '<td>'.$tableauEmail[0][$tableauIntitule[$i]].'</td>';
                    echo '<td><a onclick="suppVal(\''.$tableauIntitule[$i].'\')"><img class="images" src="autre/images/inactif.png"></a></td>
                  </tr>';
                  
                  }
                }
                else//Si il n'y a pas de valeur
                {
                  echo '<td><input type="text" class="valeur" name="intitule" id="'.$tableauFonction[$i].'" placeholder="..."/></td>';
                    echo '<td><a onclick="'.$tableauAction[$i].'"><img class="images" src="autre/images/actif.png"></a></td></tr>';
                  
                }
          }
          echo'
        </table>
      </div>
    </body>';
  }//NOUVELLE ALERTE -------------------
?>


<!--  CODE A METTRE DANS LE PHP  -->
<!-- Mémo
Commentaire : Ctrl+K+C / Ctrl+K+U
-->

