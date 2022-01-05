
    <div></div>
    <h1 style="color:white;"> Annonce : <?=esc($conversation[0]['A_titre'])?> </h1> <a href="<?= base_url();?>/Annonce?id=<?= $conversation[0]['A_idannonce'] ?>" class="btn btn-primary " >En savoir plus</a> <br/>
    <div>
        <br/>
        <?php foreach($conversation as $c) :{?>
        <div class="row div-message"><div class="col-sm-5 text-break cheat-text" >        
            <p>Message de : <b><?=esc($c['U_pseudo']) ?></b> </p> 
            <br/> 
            <p>Date : <?=esc($c['M_dateheure_message']) ?> </p>
        </div><div class="col-sm-7 text-break cheat-text  ">
        <p> <?=esc($c['M_texte_message']) ?> </p>
        

</div></div>   
            <?php }endforeach; ?>
            <form method="post">
                <textarea class="form-control" type="text" name="description" rows="4" placeholder="Envoyer un message"></textarea><button class="btn btn-primary col-3" type="submit" style="background: var(--blue);">Envoyer</button><button class="btn btn-primary col-3" type="reset" style="background: var(--blue);">Effacer</button>
            </form>
    </div>
