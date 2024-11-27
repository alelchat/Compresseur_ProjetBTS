<!-- ÉTUDIANT 3 -->
<?php
    require ('../accesBDD.php');//Pour accéder à la bdd
    $data = file_get_contents('php://input');
    var_dump($_SERVER['REMOTE_ADDR']);
    $idmail = intval($data);
    suppEmail($idmail);
?>
