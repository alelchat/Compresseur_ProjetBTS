<!-- ÉTUDIANT 3 -->
<?php
    require ('../accesBDD.php');//Pour accéder à la bdd
    $data = file_get_contents('php://input');
    var_dump($_SERVER['REMOTE_ADDR']);
    //verifier la conformtié de data
    //if($_SERVER['REMOTE_ADDR']=="::1"){
        //$mdp = hash('sha256', strval($data))
        $mdp = strval($data);
        modifMDP(hash('sha256', $mdp));
    //}
?>