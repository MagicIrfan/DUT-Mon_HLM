
    <div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Login Form</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="alogin" placeholder="Login" required></div>
            <div class="form-group"><input class="form-control" type="password" name="amdp" placeholder="Password" required minlength="1"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Se Connecter</button></div><a class="text-monospace text-danger forgot" href="<?= base_url();?>/Inscription">Pas encore inscrit ?</a> <br/>
            <a class="text-monospace text-danger forgot" href="<?= base_url();?>/mdpoublie?num=9">Mot de passe oublié ?</a> <br/>
            <small class="forgot text-monospace text-danger"><?= esc($erreur_connexion) ?></small>
        </form>
        
    </div>
