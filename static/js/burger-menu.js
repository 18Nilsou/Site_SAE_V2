// This function toggles the display style of the nav links when the burger button is clicked
// It changes the style from being displayed as flex to being hidden, and vice versa
document.getElementById("burger-btn").addEventListener("click", function () {
    let buttons = document.getElementById("nav-links");
    if (buttons.style.display === "flex") {
        buttons.style.display = "none";
    } else {
        buttons.style.display = "flex";
    }
});