
<?php
    if(!isset($succes)){
?>

<div class="cellier">
        <div class="sectionIconeBouteille">
            <h1><?= $datacell[0]['nom']?></h1>
            <div class="iconeBP">
     
                    <h3><a href="?requete=ajouterNouvelleBouteilleCellierPrive&id=<?= $datacell[0]['id']?>"><img src="/vino_etu/img/IconeBP.png"></a></h3>
                    <h3><a href="?requete=ajouterNouvelleBouteilleCellier&id=<?= $datacell[0]['id']?>"><img src="/vino_etu/img/IconeBS.png"></a></h3>      
                    <form action="?requete=deletecellier" method="post" class="down">
                    <input type="hidden" name="id"  value="<?php echo $datacell[0]['id'] ?>" />
                    <button type="submit" class="iconS"><img src="/vino_etu/img/iconeCellier1.png" alt="icone supprimer cellier"></button>
                    </form>
            </div>
        </div>
<div class="flexBouteille">
<section class="flexBouteille">
<?php
foreach ($dataprive as $cle => $bouteille) {    
    ?>
    <!-- <div class="bouteille cardcellier"> -->
    <div class="cardBouteille">
    <h2 class="nomB"><?php echo $bouteille['nom'] ?></h2>
     <!--  div flex  -->
    <div class="flexInfoImgBouteille">
         <!--  premiere div deja faite -->   
            <div class="bouteilleImg"> 
                <img src="/vino_etu/img/bte.png" alt="image bouteille privé">
            </div>
         <!--  deuxieme div deja faite -->
        <div class="description">
            <p class="pays"><?php echo $bouteille['pays'] ?></p>
            <?php if(isset($bouteille['notes'])){ echo '<p class="notes">Notes : ' . $bouteille['notes'] . '</p>';}?>
            <p class="type"><?php 
            if($bouteille['id_type'] == 1){
                echo 'Vin Rouge';
            }elseif($bouteille['id_type'] == 2){
                echo 'Vin Blanc';
            }elseif($bouteille['id_type'] == 3){
                echo 'Vin Rosé';
            }elseif($bouteille['id_type'] == 4){
                echo 'Vin Mousseux';
            }?></p>
            <p class="prix_achat"><?php echo $bouteille['prix_achat'] ?> $</p>
            <!-- <p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p> -->
            <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
        </div>
    </div>
         <!-- fin div flex -->

        <!-- <button>Modifier</button> -->
        <div class="options" >
            <div>
                <button class="btnModifier icon" data-id="<?php echo $bouteille['id'] ?>"><img src="/vino_etu/img/iconeMd.png" alt="icone Md"></button>
            </div>
            <div>
                <button class='btnAjouter icon' data-id="<?php echo $bouteille['id'] ?>"><img src="/vino_etu/img/iconeAjout.png" alt="icone Ajouter"></button>
            </div>
            <div>
                <button class='btnBoire icon' data-id="<?php echo $bouteille['id'] ?>"><img src="/vino_etu/img/iconeBoire.png" alt="icone Boire"></button>  
            </div>
            <div>
                <form action="?requete=deleteprive&id=<?= $datacell[0]['id']?>" method="post">
                    <input type="hidden" name="id" value="<?php echo $bouteille['id'] ?>" />
                    <button class="icon" type="submit"><img src="/vino_etu/img/iconeSupp.png" alt="icone Boire"></button>
                </form>
            </div>
        </div>
    </div>
    </section>
<?php
}
?>

<div class="flexBouteille">
    <section class="flexBouteille">
    
    <?php
foreach ($data as $cle => $bouteille) {    
    ?>

    <div class="cardBouteille">
        
        <p class="nomB"><?php echo $bouteille['nom'] ?></p>

        <!--  div flex  -->
        <div class="flexInfoImgBouteille">

                <!--  premiere div deja faite -->
                <div class="bouteilleImg">
                    <img src="<?php echo $bouteille['image'] ?>">
                </div>

                <!--  deuxieme div deja faite -->
                <div class="description">
                    <p class="pays"><?php echo $bouteille['pays'] ?></p>
                    <?php if(isset($bouteille['notes'])){ echo '<p class="notes">Notes : ' . $bouteille['notes'] . '</p>';}?>
                    <p class="type"><?php 
                if($bouteille['type'] == 1){
                    echo 'Vin Rouge';
                }elseif($bouteille['type'] == 2){
                    echo 'Vin Blanc';
                }elseif($bouteille['type'] == 3){
                    echo 'Vin Rosé';
                }elseif($bouteille['type'] == 4){
                    echo 'Vin Mousseux';
                }?></p>
                <p class="format"><?php echo $bouteille['format'] ?></p>
                <p class="prix_saq"><?php echo $bouteille['prix_saq'] ?> $</p>
                <!--<p class="millesime">Millesime : <?php echo $bouteille['millesime'] ?></p>-->
                <p class="quantite">Quantité : <?php echo $bouteille['quantite'] ?></p>
                <p><a href="<?php echo $bouteille['url_saq'] ?>">Voir SAQ</a></p>
            </div>
        
        </div>
        <!-- fin div flex -->
        <div class="options">
            
            <div>
                <button class="btnModifiersaq icon" data-id="<?php echo $bouteille['vbsid'] ?>"><img src="/vino_etu/img/iconeMd.png" alt="icone Md"></button>
            </div>
            <div>
                <button class='btnAjoutersaq icon' data-id="<?php echo $bouteille['vbsid'] ?>"><img src="/vino_etu/img/iconeAjout.png" alt="icone Ajouter"></button>   
            </div>
            <div>
                <button class='btnBoiresaq icon' data-id="<?php echo $bouteille['vbsid'] ?>"><img src="/vino_etu/img/iconeBoire.png" alt="icone Boire"></button>    
            </div>
            <div>
                <form action="?requete=deleteSAQ" method="post">
                    <button class="icon" type="submit"><img src="/vino_etu/img/iconeSupp.png" alt="icone Boire"></button>
                    <input type="hidden" name="id" value="<?php echo $bouteille['id_bouteille'] ?>" />
                </form>
            </div>

        </div>
    </div>
    </section>
<?php
}
?>	
</div>
</div>
<?php
}else{
    echo '<h1>' . $succes. '</h1>';
    echo '<h2>Vous avez supprimé une bouteille</h2>';    
    echo '<div data-id=' . $datacell[0]['id'] .'><button class="cellierid button-28">Accéder a votre cellier</button></div>';   
}
?>