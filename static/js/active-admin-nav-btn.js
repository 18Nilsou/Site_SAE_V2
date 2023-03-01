let currentUrl = window.location.pathname;
if (currentUrl === "/admin") {
    document.getElementById("solo-btn").className += " active";
} else if (currentUrl.includes("/admin/multiplayer") || currentUrl.includes("/admin/modifyroom")) {
    document.getElementById("multiplayer-btn").className += " active";
} else if (currentUrl === "/admin/users") {
    document.getElementById("users-btn").className += " active";
}