<?php
    $data = file_get_contents('php://input');
    if($data == 404){
        setEtatNouvelleAlerteOff();
    }
    function setEtatNouvelleAlerteOn()
    {
        file_put_contents('variableEtatNouvelleAlerte.data', json_encode(1, JSON_PRETTY_PRINT));
        echo'<script>repage()</script>';
    }
    function setEtatNouvelleAlerteOff()
    {
        file_put_contents('variableEtatNouvelleAlerte.data', json_encode(0, JSON_PRETTY_PRINT)); 
    }
    function getEtatNouvelleAlerte()
    {
        $valEtatNouvelleAlerte = json_decode(file_get_contents('autre/script/variableEtatNouvelleAlerte.data'), true);
        return $valEtatNouvelleAlerte;
    }
?>
