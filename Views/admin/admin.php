<div id="nav-admin">
    <button class="admin-btn" id="default-admin-btn" onclick="openTab(event, 'solo')">Questions partie solo</button>
    <button class="admin-btn" onclick="openTab(event, 'multi')">Questions partie multijoueur</button>
    <button class="admin-btn" onclick="openTab(event, 'users')">Gestion des utilisateurs</button>
</div>

<div id="solo" class="tab">
    <h2>Gestion des parties solo</h2>
</div>

<div id="multi" class="tab hide-tab">
    <h2>Gestion des parties multijoueurs</h2>
</div>

<div id="users" class="tab hide-tab">
    <h2>Gestion des utilisateurs</h2>
</div>

<script>
    function openTab(evt, tabName) {
        var i, tab, adminBtn;
        tab = document.getElementsByClassName("tab");
        for (i = 0; i < tab.length; i++) {
            tab[i].style.display = "none";
        }
        adminBtn = document.getElementsByClassName("admin-btn");
        for (i = 0; i < adminBtn.length; i++) {
            adminBtn[i].className = adminBtn[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    document.getElementById("default-admin-btn").click();
</script>