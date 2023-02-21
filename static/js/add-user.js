function adduser() {
    var newElement = document.createElement('div');
    newElement.innerHTML = "<label>Pseudo : </label><input type='text'  placeholder='Pseudo' name='id[]' required='required'><br><br>";
    container.appendChild(newElement);
}