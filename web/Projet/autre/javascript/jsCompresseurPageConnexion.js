//ÉTUDIANT 2
changementPage();
function changementPage() {

    if(document.getElementById('validationConnexion').value == "true")
    {
        window.location.href='Projet/pageMenu.php';
    }
    else if(document.getElementById('validationConnexion').value == "false")
    {
        const backForward = (
            (PerformanceNavigationTiming && PerformanceNavigationTiming.TYPE === 1) ||
              window.performance
                .getEntriesByType('navigation')
                .map((nav) => nav.type)
                .includes('back_forward')
            );
        const reload = (
            (PerformanceNavigationTiming && PerformanceNavigationTiming.TYPE === 1) ||
                window.performance
                .getEntriesByType('navigation')
                .map((nav) => nav.type)
                .includes('reload')
            );

        if (backForward !== true && reload !== true) 
        {
            alert('Mot de passe ou adresse mail incorrecte.');
        }
    }
}
function sendDataConnexion() {
    console.log("coucou");
    // Récupérer les données du formulaire
    var resultat = new Array(2); 
    // 0 => Email
    // 1 => Mot de passe

    var element = document.getElementById('mail');
    resultat[0] = element.value;

    var element2 = document.getElementById('mdp');
    resultat[1] = element2.value;

        // Envoyer les données au serveur en utilisant une requête AJAX
    console.log("Liste data : ");
    console.log(JSON.stringify(resultat));
}
visible=true;
function changer() {
    if(visible)
    {
        document.getElementById("mdp").setAttribute("type", "text");
        document.getElementById("eye").src="Projet/autre/images/visible.png";
        visible=false;
    }
    else
    {
        document.getElementById("mdp").setAttribute("type", "password");
        document.getElementById("eye").src="Projet/autre/images/invisible2.png";
        visible=true;
    }
}
