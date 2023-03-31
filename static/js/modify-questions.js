var btnsEdit = document.querySelectorAll("input[type=submit][value='Modifier']");

function underline(element) {
    element.style.border = "2px solid red";
}

for (var i = 0; i < btnsEdit.length; i++) {
    btnsEdit[i].addEventListener("click", function(event) {
        event.preventDefault();

        var row = event.target.parentNode.parentNode;

        var title = row.querySelector("input[name='title']");
        underline(title);
        var assignement = row.querySelector("textarea[name='assignement']");
        underline(assignement);
        var suggestion = row.querySelector("input[name='suggestion']");
        underline(suggestion);
        var answer = row.querySelector("input[name='answer']");
        underline(answer);

        event.target.value = "Valider";
        event.target.removeEventListener("click", arguments.callee);
        event.target.addEventListener("click", function() {
            event.target.parentNode.submit();
        });
    });
}