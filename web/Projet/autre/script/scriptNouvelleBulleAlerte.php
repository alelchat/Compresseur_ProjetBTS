<!-- ÉTUDIANT 3 -->
<?php
    require ('../accesBDD.php');//Pour accéder à la bdd
    require ('scriptEtatNouvelleAlerte.php');
    $tableauDates = getListeAlertes();//Définir le tableau de la BDD ici
    $nbDateDefaut = 0;
    $nbHeureDefaut = 0;
    //while(1){
        //---------------------------------------------------
        //Triage des dates
        // Tableau de dates non triées
        for($i = 0; $i < sizeof($tableauDates); $i++){
            $dates[$i] = $tableauDates[$i]['dateDefaut'];
            //$nbDateDefaut = $i;
        }
        // Fonction de comparaison pour le tri
        function compareDates($date1, $date2) {
            return strtotime($date1) - strtotime($date2);
        }
        // Tri du tableau
        usort($dates, "compareDates");
        foreach ($dates as $date) {
            $derniereDate = $date;
        }
        //---------------------------------------------------
        $tableauHeures = getHeureDerniereAlerete($derniereDate);
        //---------------------------------------------------
        //Triage des heures
        // Tableau de heures non triées
        for($i = 0; $i < sizeof($tableauHeures); $i++){
            $heures[$i] = $tableauHeures[$i]['heureDefaut'];
            $nbHeureDefaut = $i;
        }
        // Fonction de comparaison pour le tri
        function compareHeures($heure1, $heure2) {
            return strtotime($heure1) - strtotime($heure2);
        }
        // Tri du tableau
        usort($heures, "compareHeures");
        foreach ($heures as $heure) {
            $derniereHeure = $heure;
        }
        //Comparaison des dates :
        $variableDernierDefaut = json_decode(file_get_contents('variableDernierDefaut.data'), true);
        if((!empty($variableDernierDefaut["dateDernierDefaut"])) && (!empty($variableDernierDefaut["heureDernierDefaut"])))
        {
            if(($variableDernierDefaut["dateDernierDefaut"] == $derniereDate)&&($variableDernierDefaut["heureDernierDefaut"] == $derniereHeure))
            {
                echo 'Même defaut';
            }
            else
            {
                echo 'Nouveau defaut';
                setEtatNouvelleAlerteOn();
                $variableDernierDefaut["dateDernierDefaut"] = $derniereDate;
                $variableDernierDefaut["heureDernierDefaut"] = $derniereHeure;
                file_put_contents('variableDernierDefaut.data', json_encode($variableDernierDefaut, JSON_PRETTY_PRINT));
            }
        }
        else
        {
            echo '<br> Vide, modification';
            $variableDernierDefaut["dateDernierDefaut"] = $derniereDate;
            $variableDernierDefaut["heureDernierDefaut"] = $derniereHeure;
            file_put_contents('variableDernierDefaut.data', json_encode($variableDernierDefaut, JSON_PRETTY_PRINT));
        }
        
    //}
?>