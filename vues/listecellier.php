<div class="cellier">

    <h2>Vos Celliers</h2>
    <div class="wrapajout">
        <h3><a href="?requete=ajoutercellier" class="button-28">Ajouter un nouveau cellier</a></h3>
    </div>


    <div class="flexCellier">
        <?php
        foreach ($data as $cle => $cellier) {
        ?>

            <div class="card">
                <img src="/vino_etu/img/vin.jpg" alt="cellier" />
                <h3 class="nom"><?php echo $cellier['nom'] ?></h3>
                <div class="flexLieu">
                    <img src="/vino_etu/img/location.png" alt="">
                    <?php echo $cellier['lieu'] ?>
                </div>

                <div data-id="<?php echo $cellier['id'] ?>">
                    <button class="cellierid button-28">Accéder a votre cellier</button>
                </div>

            </div>

        <?php
        }
        ?>
    </div>

</div>