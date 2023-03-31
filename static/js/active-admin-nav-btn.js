// Update the active navbar item depending on the current page location
// If the page is an admin page, add the "active" class to the corresponding navbar button
let currentUrl = window.location.pathname;
if (currentUrl === "/admin") {
    document.getElementById("solo-btn").className += " active";
} else if (currentUrl.includes("/admin/multiplayer") || currentUrl.includes("/admin/modifyroom")) {
    document.getElementById("multiplayer-btn").className += " active";
} else if (currentUrl === "/admin/users") {
    document.getElementById("users-btn").className += " active";
}