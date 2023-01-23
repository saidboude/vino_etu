<div class="modifier">
    <div class="nouvelleBouteille" vertical layout>
        
        <div class="" >        
            <p>Nom : <input class="nom_bouteille" name="nom" data-id="<?= $data["id_bouteille_modif"] ?>" value="<?= $data["nom_saq"] ?>"></p> <!-- -->
            <!--  <p>Nom : <span data-id="" class="nom_bouteille"></span></p>-->
            <p>Millesime : <input name="millesime" value="<?= $data["millesime"] ?>"></p>
            <p>Quantite : <input name="quantite" value="<?= $data["quantite"] ?>"></p>
            <p>Date achat : <input name="date_achat" value="<?= $data["date_achat"] ?>"></p>
            <p>Prix : <input name="prix" value="<?= $data["prix"] ?>"></p>
            <p>Garde : <input name="garde_jusqua" value="<?= $data["garde_jusqua"] ?>"></p>
            Choisir le Cellier
            <select id="id_cellier">
                <option value="<?= $data["id_cellier"] ?>"><?= $data["nom_cellier"] ?></option>
                <option value="1">Chalet</option>
                <option value="2">Maison</option>
                <!-- Passer ces données à cette vue -->
            </select>            
            <p>Notes <input name="notes" value="Bon"></p>
        </div>
        <div>
            <input type="hidden" name="id" value="<?= $data["id_bouteille_modif"] ?>">
            <button class="modifierBouteille" name="modifierBouteilleCellier" data-id="<?= $data["id_bouteille_modif"] ?>">Modifier ma bouteille</button>
        </div>
    </div>
</div>
