
// This function adds a user to the list by creating a new div element with the necessary inputs
// The newly created element is then appended to the existing container
function adduser() {
    var newElement = document.createElement('div');
    newElement.innerHTML = "<label>Pseudo : </label><input type='text'  placeholder='Pseudo' name='id[]' required='required'><br><br>";
    container.appendChild(newElement);
}