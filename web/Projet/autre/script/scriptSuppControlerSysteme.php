<!-- ÉTUDIANT 3 -->
<?php
    require ('../accesBDD.php');//Pour accéder à la bdd
    $tableuDefaut = getListeAlertes();//Définir le tableau de la BDD ici
    $valeur = $tableuDefaut[0]['seuilAtteint'];
    if(($valeur != 0) && ($valeur>0))
    {
        setSuppPage($valeur);
    }
?>