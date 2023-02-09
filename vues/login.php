<div class="login">


<div class="form-style-8">
  <h2>Connexion</h2>

    <form autocomplete="off" id="login" action="?requete=login" method="post" >      
      <input type="email" name="email" placeholder="Email" autocomplete="off" />
      <input type="password" name="mdp" placeholder="Mot de passe" autocomplete="off" />
      
      <?php
        if(isset($erreur)) {
          echo '<span id="erreurLogin" class="error-message">'.$erreur.'</span>';
        }
      ?>
      <button type="submit" class="top button-28">Se Connecter</button>
    </form>
</div>


