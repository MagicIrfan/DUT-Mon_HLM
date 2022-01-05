<div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Récupéation du mot de passe</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="password" name="nmdp" placeholder="Nouveau mot de passe" required minlength="6" ></div>
            <div class="form-group"><input class="form-control" type="password" name="cnmdp" placeholder="Confirmation du nouveau mot de passe" required ></div>
            <button class="btn btn-primary btn-block" type="submit">Confirmer</button></div><br/>
            <small class="forgot text-monospace text-danger"><?= esc($erreur_mdp) ?></small>
        </form>
        
    </div>