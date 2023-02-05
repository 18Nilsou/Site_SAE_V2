const eye = document.querySelector("#password-icon-on");
const eyeoff = document.querySelector("#password-icon-off");
const passwordFields = document.querySelectorAll("input[type=password]");

eye.addEventListener("click", () => {
    eye.style.display = "none";
    eyeoff.style.display = "block";
    passwordFields.forEach(field => {
        field.type = "text";
    });
});

eyeoff.addEventListener("click", () => {
    eyeoff.style.display = "none";
    eye.style.display = "block";
    passwordFields.forEach(field => {
        field.type = "password";
    });
});