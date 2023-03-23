<section class="tab">
    <h2>Gestion des questions du jeu solo</h2>

<div class="navSolo"><a href="#Entrainement">Partie Entrainement</a> <a href="#jeu">Partie Jeu</a></div>

<div class="row">
    <div class="addquestions">
        <form class="questionForm" method="post" action="admin/addQuestion">
            <h3>Ajouter une Question</h3>
            <label>Titre de la question : </label>
            <input type="text"  placeholder="Titre" name="title" maxlength="40" required="required"><br/>
            <label>Consigne :</label>
            <textarea name="assignement" rows="5" cols="30" maxlength="255" placeholder="Consigne" aria-required="true"></textarea><br/>
            <label>Réponse : </label>
            <input type="text"  placeholder="Réponse" name="answer" maxlength="255" required="required"><br/>
            <label>Indice : </label>
            <textarea name="suggestion" rows="5" cols="30" maxlength="255" placeholder="Indice" aria-required="true"></textarea><br/>
            <legend>Choisir la salle:</legend>
            <div>
                <label for="game">Jeu : </label>
                <input type="radio" id="game" name="room_id" value="game">
                <label for="practice">Entrainement : </label>
                <input type="radio" id="practice" name="room_id" value="practice">
            </div>
            <br>
            <input type="submit" value="Valider">
        </form>
        <form class="questionForm" method="post"  enctype='multipart/form-data' action="admin/getquestionfromfile">
            <h3>Ajouter des questions avec un fichier dans la partie Entrainement</h3>
            <a href="/admin/getfilequestions">Exemple de format du fichier.csv</a>
            <legend>Choisir la salle:</legend>
            <div>
                <label for="game">Jeu : </label>
                <input type="radio" id="game" name="room_id" value="game">
                <label for="practice">Entrainement : </label>
                <input type="radio" id="practice" name="room_id" value="practice">
            </div>
            <br>
            <label>Titre de la question : </label>
            <input type="file" name="file" id="file" accept=".csv" required="required"><br/>
            <input type="submit" value="Valider">
        </form>
    </div>
    
</div>

<h2 id="Entrainement" class='titlesolo'>Partie Entrainement</h2>
<div class= "arrayQuestion">
    <?php echo($A_view['training']);?>
</div>
<br/>
<h2 id = "jeu" class='titlesolo'>Partie Jeu</h2>
<div class= "arrayQuestion">
    <?php echo($A_view['play']);?>
</div>
</section>
<script type="text/javascript" src="/static/js/modify-questions.js"></script>