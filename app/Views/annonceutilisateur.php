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
						<a class="nav-link" href="<?= base_url();?>/gererprofil">Gérer mon profil</a>
						<a class="nav-link active" href="<?= base_url();?>/annonceutilisateur">Gérer mes annonces</a>
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
</div><div class="float-right annonce-uti">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>Annonce</th>
                    <th>Liens</th>
                </tr>
            </thead>
            <?php if(empty($pseudoquelconque)) { ?>
                <?php foreach ($mesannonces as $t): { ?>
                    <tbody>
                        <tr>
                            <td><?=esc($t['A_titre'])?></td>
                            <td><a href="<?= base_url();?>/Annonce?id=<?= $t['A_idannonce'] ?>" class="mt-auto btn btn-primary">Regarder</a><a href="<?= base_url();?>/Supprimer?id=<?= $t['A_idannonce'] ?>" class="mt-auto btn btn-primary">Supprimer</a><a href="<?= base_url();?>/ModifierAnnonces?id=<?= $t['A_idannonce'] ?>" class="mt-auto btn btn-primary">Modifier</a></td>
                        </tr>               
                    </tbody>
                <?php }endforeach;} else { ?>
                <?php foreach ($touteannoncepseudo as $t): { ?>
                    <tbody>
                        <tr>
                            <td><?=esc($t['A_titre'])?></td>
                            <td><a href="<?= base_url();?>/Annonce?id=<?= $t['A_idannonce'] ?>" class="mt-auto btn btn-primary">Regarder</a><a href="<?= base_url();?>/Supprimer?id=<?= $t['A_idannonce'] ?>&num=5" class="mt-auto btn btn-primary">Supprimer</a><a href="<?= base_url();?>/ModifierAnnonces?id=<?= $t['A_idannonce'] ?>&num=6" class="mt-auto btn btn-primary">Modifier</a><a href="<?= base_url();?>/SupprimerMessages?id=<?= $t['A_idannonce'] ?>&num=7" class="mt-auto btn btn-primary">Supprimer les messages</a><a href="<?= base_url();?>/SupprimerPhotos?id=<?= $t['A_idannonce'] ?>&num=8" class="mt-auto btn btn-primary">Supprimer les photos</a></td>
                        </tr>               
                    </tbody>
                <?php } endforeach;} ?>
        </table>
    </div>
</div>
