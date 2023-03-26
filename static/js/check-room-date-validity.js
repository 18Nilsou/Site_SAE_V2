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