<div class="cellier">

<!--
<p><a href="?requete=">Ajouter un nouveau cellier</a></p>
-->

<h3><a href="?requete=ajouterCellier" class="btnlogin button-28">Ajouter un nouveau cellier</a></h3>';


<!--
<h2><a href="?requete=cellier">Cellier --Nom--</a></h2>
-->


<h1>Vos Celliers</h1>
    
<?php
foreach ($data as $cle => $cellier) {
?>	 
    
    <div>
    <p class="id">Id : <?php echo $cellier['id'] ?></p>
    <p class="nom">Nom : <?php echo $cellier['nom'] ?></p>
    <p class="quantite">Lieu : <?php echo $cellier['lieu'] ?></p>
    </div>

<?php
}
?>	

</div>
<br>
    