<!-- ÉTUDIANT 3 -->
<?php
    require ('../accesBDD.php');//Pour accéder à la bdd
    $data = file_get_contents('php://input');
    $data = intval($data);
    $valActuelle = getValActuelle();
    $nbTableau = getListeAlertes();
    $nbTableau = sizeof($nbTableau);
    if($data == 1){
        if($valActuelle < $nbTableau - 2)
        {
            deroulementHaut();
        }
    }
    if($data == -1){
        if($valActuelle > 0)
        {
            deroulementBas();
        }
    }
    function deroulementHaut()
    {
        $val = getValActuelle();
        file_put_contents('variableTableau.data', json_encode($val + 1, JSON_PRETTY_PRINT));
    }
    function deroulementBas()
    {
        $val = getValActuelle();
        file_put_contents('variableTableau.data', json_encode($val - 1, JSON_PRETTY_PRINT)); 
    }
    function getValActuelle()
    {
        $valNiveauDeroulement = json_decode(file_get_contents('variableTableau.data'), true);
        return $valNiveauDeroulement;
    }
?>
