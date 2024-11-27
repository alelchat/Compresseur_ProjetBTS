<!-- ÉTUDIANT 1 -->
<?php
    require('../accesBDD.php');
    $valeurEtatMarche = getEtatMarche();
    if($valeurEtatMarche[0]['etatMarche'] == 0)
        {
            modifierFonctionnementCompresseur(1);
            modifierHeureDebutMarcheCompresseur();
            modifierDateChangement();
            passageManuel();
        }
?>


