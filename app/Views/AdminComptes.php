<table id="example" class="table table-striped table-bordered thead-light" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Pseudo</th>				
                <th>Mail</th>
				<th>Modifier compte</th>
                <th>Supprimer compte</th>
				<th>Bloquer / Débloquer la publication des annonces </th>
                <th>Voir ses annonces</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($utilisateurs as $i => $uti): { ?>
                <?php if ($admin->U_pseudo != $utilisateurs[$i]['U_pseudo'] ) {?>
                    <tr>
                        <td><?=esc($utilisateurs[$i]['U_nom'])?></td>
                        <td><?=esc($utilisateurs[$i]['U_prenom'])?></td>
                        <td><?=esc($utilisateurs[$i]['U_pseudo'])?></td>
                        <td> <a href="<?= base_url();?>/messageadmin?pseudo=<?=esc($utilisateurs[$i]['U_pseudo'])?>"><?=esc($utilisateurs[$i]['U_mail'])?></a> </td>
                        <td><a href="<?= base_url();?>/gererprofil?pseudo=<?=esc($utilisateurs[$i]['U_pseudo'])?>&num=1"> Modifier </a> </td>
                        <td><a href="<?= base_url();?>/MailSupression?pseudo=<?=esc($utilisateurs[$i]['U_pseudo'])?>&num=2">Supprimer</a> </td>
                        <?php if ($utilisateurs[$i]['U_publication']) { ?>
                            <td><a href="<?= base_url();?>/bloquer?pseudo=<?=esc($utilisateurs[$i]['U_pseudo'])?>&num=3"> Bloquer </a> </td>
                        <?php } else { ?>
                            <td><a href="<?= base_url();?>/bloquer?pseudo=<?=esc($utilisateurs[$i]['U_pseudo'])?>&num=4"> Débloquer </a> </td>
                        <?php } ?>
                        <td><a href="<?= base_url();?>/annonceutilisateur?pseudo=<?=esc($utilisateurs[$i]['U_pseudo'])?>"> Voir </a> </td>
                    </tr>
                <?php } ?>
            <?php } endforeach; ?>
            
            
        </tbody>
    </table>