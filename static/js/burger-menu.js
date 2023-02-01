document.getElementById("burger-btn").addEventListener("click", function () {
    let buttons = document.getElementById("nav-links");
    if (buttons.style.display === "flex") {
        buttons.style.display = "none";
    } else {
        buttons.style.display = "flex";
    }
});