<div class="login-dark">
        <form method="post">
            <h2 class="sr-only">Mot de passe oublié</h2>
            <div class="illustration"><i class="icon ion-ios-locked-outline"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="nemail" placeholder="Email" required></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Envoyer</button></div><a class="text-monospace text-danger forgot" href="<?= base_url();?>/Connexion">Retour</a> <br/>
            <small class="forgot text-monospace text-danger"><?= esc($messageemail) ?></small>
        </form>
        
</div>