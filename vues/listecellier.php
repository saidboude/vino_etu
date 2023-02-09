<div class="cellier">


<div class="sectionIcone">
    <h1 class="titre"></h1>
        <div class="iconeCellier">
        <h3><a href="?requete=ajoutercellier" ><img src="/vino_etu/img/IconeCellier.png"></a></h3>
        </div>
    </div>
 

        <div class="flexCellier">
    <?php
    foreach ($data as $cle => $cellier) {
    ?>

<a href="?requete=cellierid&id=<?php echo $cellier['id'] ?>">
    <div class="card cellierid">
        <img src="/vino_etu/img/vin.jpg" alt="cellier" style="width: 240px; border-radius: 15px;">
        <h3 class="nom"><?php echo $cellier['nom'] ?></h3>
        <div class="flexLieu">
            <img src="/vino_etu/img/location.png" alt="">
            <?php echo $cellier['lieu'] ?>
        </div>
       <!--  <div data-id="<?php echo $cellier['id'] ?>">
            <button class="cellierid button-28">Accéder a votre cellier</button>
        </div> -->
        
    </div>
</a>
    
    <?php
    }
    ?>
    </div>

</div>