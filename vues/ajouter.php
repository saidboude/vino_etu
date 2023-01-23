<div class="ajouter">

    <h1>Ajout d'une bouteille au cellier</h1>

    <div class="nouvelleBouteille" vertical layout>

        Recherche : <input type="text" name="nom_bouteille">
        <ul class="listeAutoComplete">

        </ul>
        <div>
            <!-- <p>Nom : <span data-id="" class="nom_bouteille"></span> <input name="nom"> </p> -->
            <p>Nom : <span data-id="" class="nom_bouteille"></span></p>
            <p>Millesime : <input name="millesime" placeholder="aaaa"></p>
            <p>Quantite : <input name="quantite" value="1"></p>
            <p>Date achat : <input name="date_achat" placeholder="aaaa-mm-jj"></p>
            <p>Prix : <input name="prix" placeholder="00.00"></p>
            <p>Garde : <input name="garde_jusqua" placeholder="aaaa-mm-jj ou non" ></p>
            Choisir le Cellier
            <select id="id_cellier">
                <option value="">Choisir le cellier</option>
                <option value="1">Chalet</option>
                <option value="2">Maison</option>
                <!-- Passer ces données à cette vue -->
            </select>            
            <p>Notes <input name="notes"></p>
        </div>
        <button name="ajouterBouteilleCellier" style="margin-bottom: 100px;">Ajouter la bouteille (champs tous obligatoires)</button>
    </div>
</div>
