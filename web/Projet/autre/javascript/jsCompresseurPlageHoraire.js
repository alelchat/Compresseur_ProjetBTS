//ÉTUDIANT 2
initialisationDuTableau();
function initialisationDuTableau(){
    for(id = 1; id <= 52; id++)
        {
            var semaine = document.getElementById('element'+id);
            if(document.getElementById("inputSemaine"+id).value == "1")
                {
                    semaine.style.backgroundColor = "green";
                }
            else
                {
                    semaine.style.backgroundColor = "whitesmoke";
                }
        }
    for(id = 1; id <= 168; id++)
        {
            var semaine = document.getElementById('creneaux'+id);
            if(document.getElementById("inputCreneaux"+id).value == "1")
                {
                    semaine.style.backgroundColor = "green";
                }
            else
                {
                    semaine.style.backgroundColor = "whitesmoke";
                }
        }
    if(document.getElementById('semaineEntretien').value == "")
        {
            alert("Veuillez indiquer une semaine d'entretien valide (valeur remise à 0)");
            document.getElementById('semaineEntretien').value = "0";
        }
    //rechercher chque input pour savoir si il est à 0 ou 1
    }
function changerSemaine(id)
    {
        let element = document.getElementById("element"+id);
        if(element.style.backgroundColor == "whitesmoke")
            {
                element.style.backgroundColor = "green";
                document.getElementById("inputSemaine"+id).value = 1;
            }
        else
            {
                element.style.backgroundColor = "whitesmoke";
                document.getElementById("inputSemaine"+id).value = 0;
            }
    }
function changerCreneaux(id)
    {
        let element = document.getElementById("creneaux"+id);
        if(element.style.backgroundColor == "whitesmoke")
            {
                element.style.backgroundColor = "green";
                document.getElementById("inputCreneaux"+id).value = 1;
            }
        else
            {
                element.style.backgroundColor = "whitesmoke";
                document.getElementById("inputCreneaux"+id).value = 0;
            }
    }
function sendData() {
    console.log("coucou");
    // Récupérer les données du formulaire
    var resultat = new Array(221); 
    // 0 à 51 => Semaine
    // 52 à 219 => Creneaux
    // 220 => SemaineEntretien
    for(index = 1; index <= 52; index++)
        {
            var element = document.getElementById('element'+index);
            if(element.style.backgroundColor === "whitesmoke")
                {
                resultat[index - 1] = 0;
                }
            else {
                resultat[index - 1] = 1;
                }
        }
    for(index = 1; index <= 168; index++)
        {
            var element = document.getElementById('creneaux'+$index)
            if(element.style.backgroundColor === "whitesmoke")
                {
                resultat[index+52 - 1] = 0;
                }
            else {
                resultat[index+52 - 1] = 1;
                }
        }
    var element = document.getElementById('semaineEntretien');
    resultat[220] = element.value;
    // Envoyer les données au serveur en utilisant une requête AJAX
    console.log("Liste data : ");
    console.log(JSON.stringify(resultat));
    }
function annulerData()
    {
        alert("❌ Modification annulée.");
    }
function enregistrerData()
    {
        alert("✔ Modification enregistrée.");
    }