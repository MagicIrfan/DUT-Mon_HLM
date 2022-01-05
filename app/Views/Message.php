
    <div></div>
    <div>
        <?php foreach($messages as $m): {?>
        <div class="row div-message"><div class="col-sm-5 text-break cheat-text" >        
            <p>Message de : <b><?=esc($m['U_pseudo']) ?></b> <?php if ($m['M_lu'] == false) { ?> <small>   NOUVEAU !</small> <?php } ?></p> 
            <p>Nom de l'annonce : <?=esc($m['A_titre']) ?><br/> <a href="<?= base_url();?>/Annonce?id=<?= $m['A_idannonce'] ?>" class="btn btn-primary " >En savoir plus</a><a href="<?= base_url();?>/Conversation/lu?id=<?=esc($m['A_idannonce'])?>&destinataire=<?=esc($m['U_pseudo'])?>&idm=<?=esc($m['M_idmessage'])?>" class="btn btn-primary " >Voir</a></p> 
        </div><div class="col-sm-7 text-break cheat-text  ">
        <p> <?=esc($m['M_texte_message']) ?> </p>
        

</div></div>   
            <?php }endforeach; ?>
    </div>
