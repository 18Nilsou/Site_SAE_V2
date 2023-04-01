// This function prevents a room from being deleted if the user does not confirm the action.
// It checks if the user has confirmed the delete action by using a JavaScript confirm window.
// If the user does not confirm, the event is prevented and the room is not deleted.
function confirmDeleteRoom(event) {
    if(!confirm("Êtes-vous sûr de vouloir supprimer la room ?")) {
        event.preventDefault();
    }
}