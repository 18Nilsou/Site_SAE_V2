// Check if the form fields start_date and end_date have valid values
// before submitting the form. If the start date is greater than the end date,
// prevent form submission and alert the user. If the current url includes
// '/admin/modifyroom/', alert the user that their room has been modified.
// Otherwise, alert the user that their room has been created but is empty
// and they should click modify to add questions and invite players.
const start_date = document.getElementById("start_date");
const end_date = document.getElementById("end_date");
const btnSubmit = document.getElementById("room_date");

btnSubmit.addEventListener("click", function(e){
    if (start_date.value >= end_date.value) {
        alert("La date de début est supérieure à la date de fin !");
        e.preventDefault();
    } else if (currentUrl.includes('/admin/modifyroom/')) {
        alert("Votre salon de jeu a été modifié !");
    } else {
        alert("Votre salon de jeu a été créé mais il est vide" +
            ", cliquez sur 'Modifier' pour " +
            "ajouter des questions et inviter des joueurs !");
    }
});