
    <div class="contact-clean">
        <form method="post">
            <h2 class="text-center">Vos identifiants</h2>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required></div><!--<small class="form-text text-danger">Please enter a correct email address.</small></div>-->
            <div class="form-group"><input class="form-control" type="text" name="login" placeholder="Nom d'utilisateur" required></div>
            <div class="form-group"><input class="form-control" type="text" name="nom" placeholder="Nom" required></div>
			<div class="form-group"><input class="form-control" type="text" name="prenom" placeholder="Prénom" required></div>
			<div class="form-group"><input class="form-control" type="password" name="mdp" placeholder="Mot de passe" required></div>
            <div class="form-group"><input class="form-control" type="password" name="cmdp" placeholder="Confirmer mot de passe" required></div>
            <div class="form-group"><button class="btn btn-primary text-center centerbutton" type="submit" style="font-size: 14px;border: 0px none var(--danger);border-top-style: none;border-radius: 25px;">Valider</button></div><a class="text-center d-md-flex align-content-center justify-content-md-center" href="<?= base_url();?>/Connexion" style="color: var(--light);width: auto;text-align: center;height: auto;margin-bottom: auto;margin-left: auto;">Vous avez déjà un compte ?</a> <br/>
            <small class="forgot text-monospace text-danger centerbutton" style="text-align:center;" ><?= esc($exists) ?></small>
        </form>
    </div>
    <section class="footer">
        <p class="text-center d-md-flex align-items-start justify-content-xl-center align-items-xl-end" style="text-align: center;margin-bottom: auto;margin-left: auto;margin-right: auto;margin-top: auto;">Projet PHP 2020-2021 MOLINA &amp; BOUHENAF</p>
