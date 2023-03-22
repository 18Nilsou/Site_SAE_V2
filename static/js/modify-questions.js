// Récupération de tous les boutons "Modifier"
var btnsEdit = document.querySelectorAll("input[type=submit][value='Modifier']");

// Fonction pour entourer en rouge
function underline(element) {
    element.style.border = "2px solid red";
}

// Ajout de l'événement "click" à chaque bouton "Modifier"
for (var i = 0; i < btnsEdit.length; i++) {
    btnsEdit[i].addEventListener("click", function(event) {
        event.preventDefault(); // Empêche l'action par défaut du formulaire

        // Récupération de la ligne parente du bouton "Modifier"
        var row = event.target.parentNode.parentNode;

        // Rendre les champs éditables et les entourer en rouge
        var title = row.querySelector("input[name='title']");
        underline(title);
        var assignement = row.querySelector("textarea[name='assignement']");
        underline(assignement);
        var suggestion = row.querySelector("input[name='suggestion']");
        underline(suggestion);
        var answer = row.querySelector("input[name='answer']");
        underline(answer);

        event.target.value = "Valider";
        event.target.removeEventListener("click", arguments.callee); // Supprimer l'événement "click" précédent
        event.target.addEventListener("click", function() {
            // Soumettre le formulaire
            event.target.parentNode.submit();
        });
    });
}