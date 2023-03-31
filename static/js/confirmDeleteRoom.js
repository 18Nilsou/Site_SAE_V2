function confirmDeleteRoom(event) {
    if(!confirm("Êtes-vous sûr de vouloir supprimer la room ?")) {
        event.preventDefault();
    }
}