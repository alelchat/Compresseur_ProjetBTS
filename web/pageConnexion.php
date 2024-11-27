<!-- ÉTUDIANT 2 -->
<?php
    require('Projet/autre/accesBDD.php');
    if(!empty($_POST)) 
        {
            $bdd = connexionBDD();
            if($bdd == true)
                {
                    $mailRecu = getEmailConnexion();
                    $mdpRecu = getMotDePasse();
                }
            $nbFalseConnexion = 0;
            for($index = 0; $index < count($mailRecu); $index++)
                {
                    if(($_POST['mailInput'] == $mailRecu[$index]['adresseMail']) && (hash('sha256' ,$_POST['mdpInput']) == $mdpRecu[$index]['motDePasse']))
                        {
                            $validation = "true";
                        }
                    else
                        {
                            $nbFalseConnexion += 1;
                        }
                }
            if($nbFalseConnexion == count($mailRecu))
                {
                    $validation = "false";
                }
        }
    else
        {
        $validation = " ";
        }
    $header = '
        <link rel="stylesheet" href="Projet/autre/css/cssCompresseurPageConnexion.css">
        <link rel="stylesheet" href="Projet/autre/css/cssCompresseurPageDeBase.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <title>Connexion</title>';
    $script = '
        <script src="Projet/autre/javascript/jsCompresseurPageConnexion.js"></script>';
    $content = '
        <div class="rectangle">
            <form method="POST" action="pageConnexion.php">
                <h1 class="connexion" style=>Connexion</h1>
                <div class="mail">
                    <input type="text" id="mail" name="mailInput" required value=""/>
                    <label id="labelMail"><i>Adresse Mail*</i> </label>
                </div>
                <div class="password">
                    <img src="Projet/autre/images/invisible2.png" id="eye" onClick="changer()"/>
                    <input type="password" id="mdp" name="mdpInput" required value=""/>
                    <label id="labelMdp"><i>Mot de passe*</i> </label>
                </div>
                <div id="tableauBouton">
                    <input type="submit" class="lesBoutons" id="boutonEnregistrer" value="Valider" onClick="sendDataConnexion()"/>
                </div>
            </form>
        </div>
        <input type="hidden" id="validationConnexion" name="validationConnexionInput" value="'.$validation.'"/>';
        include('Projet/autre/pageBase.php');
?>

