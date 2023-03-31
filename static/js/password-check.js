
// Check if the password is at least 12 characters long
// Check if the password includes at least one uppercase, one lowercase, one number, and one symbol
// Check if the password and confirm password match
document.querySelector('.submit').addEventListener('click', function() {
    const password = document.querySelector('#password');
    const passwordConfirm = document.querySelector('#password_confirm');
    const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#$%^&*_+=[\]{};':"\\|,.<>\/?])/;

    if (password.value.length < 12) {
        password.setCustomValidity("Votre mot de passe doit comporter au moins 12 caractères");
    } else {
        password.setCustomValidity("");
    }

    if (!regex.test(password.value)) {
        password.setCustomValidity("Votre mot de passe doit comporter au moins une majuscule, une minuscule, un chiffre et un symbole");
    } else {
        password.setCustomValidity("");
    }

    if (password.value !== passwordConfirm.value) {
        passwordConfirm.setCustomValidity("Les mots de passe ne correspondent pas");
    } else {
        passwordConfirm.setCustomValidity("");
    }
});