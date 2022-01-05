<div class="sidebar bg-dark">
    <div class="brand">
        <a class="navbar-brand"><?=esc($pseudo)?></a> <br/> <br/>
        <a href = "<?= base_url();?>/disconnect" class="mt-auto btn btn-primary">Se déconnecter</a>
    </div>
    
    <nav class="navbar navbar-dark navbar-expand">
        <div class="container-fluid">
            <ul class="nav navbar-nav mr-auto flex-column mr-auto">
                <li class="nav-item">
                    <div>
						<a class="nav-link active " href="<?= base_url();?>/gererprofil">Gérer mon profil</a>
						<a class="nav-link" href="<?= base_url();?>/annonceutilisateur">Gérer mes annonces</a>
            <a class="nav-link" href="<?= base_url();?>/Ajouter">Ajouter une annonce</a>
						<a class="nav-link <?= ($nombremessages == 0) ? esc("fa fa-envelope-open-o") : esc("fa fa-envelope-o") ?>" href="<?= base_url();?>/Message">Messages</a>
						<?php if (!empty($pseudo) && ($admin->U_pseudo != $pseudo)) { ?><a class="nav-link" href="<?= base_url();?>/SupprimerCompte">Supprimer mon compte</a> <?php } ?>
						<b><hr color="white" align="center"></b>
						<?php if ($admin->U_pseudo == $pseudo) { ?>  <a class="nav-link" href="<?= base_url();?>/AdminComptes">Espace administrateur</a> <?php } ?>
						
						
					</div>
                </li>
            </ul>
        </div>
    </nav>
</div><div class ="formulaire_donnees">
<form class="form-horizontal" role="form" method = "post">
  <div class="form-group">
    <label class="control-label" for="Pseudo">Pseudo</label>
    <div>
      <input class="form-control" id="Pseudo" name="mpseudo" type="text" value="<?=esc($perso->U_pseudo)?>" placeholder="Pseudo" />
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nom</label>
      <input type="text" class="form-control" id="Nom" name="mnom" value="<?=esc($perso->U_nom)?>" placeholder="Nom">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Prénom</label>
      <input type="text" class="form-control" id="Prénom" name="mprenom" value="<?=esc($perso->U_prenom)?>" placeholder="Prénom">
    </div>
  </div>
  <button type="submit" class="btn btn-primary centerbutton">Valider</button>
</form>
</div>

<div class ="formulaire_donnees">
<form class="form-horizontal" role="form" method = "post">
  <div class="form-group">
    <label class="control-label" for="Name">Ancien mot de passe</label>
    <div class="">
      <input class="form-control" id="Name" name="amdp" type="password" minlength="6" />
    </div>
  </div>
  <div class="form-group">
    <label class="control-label" for="Name">Nouveau mot de passe</label>
    <div class="">
      <input class="form-control" id="Name" name="nmdp" type="password" minlength="6" />
    </div>
  </div>  
  <div class="form-group">
    <label class="control-label" for="Name">Confirmation du mot de passe</label>
    <div class="">
      <input class="form-control" id="Name" name="cnmdp" type="password" minlength="6" />
    </div>
  </div>  
  <button type="submit" class="btn btn-primary centerbutton">Valider</button>
</form>
</div>
