
    <div class="container-xl">
        <div class="row justify-content-left col-13"><div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <?php for($i=1; $i<count($photos); ++$i) { ?>
            <li data-target="#carouselExampleIndicators" data-slide-to="<?esc($i)?>"></li>
          <?php } ?>
        </ol>
  <div class="carousel-inner">

      <div class="carousel-item active">
        <img class="d-block w-100" src="<?=esc($photos[0]['P_titre'])?>" alt="Second slide">
      </div>
      <?php for($i=1; $i<count($photos); ++$i) { ?>
        <div class="carousel-item">
          <img class="d-block w-100" src="<?=esc($photos[$i]['P_titre'])?>" alt="Second slide">
        </div>
      <?php }?>
      
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
    <div class="text-end col-5">
                <?php if ($annonce->U_pseudo != $pseudo) {?>
                  <form method = "post">
                      <div class="form-group">
                          <p>Annonce de : <?=esc($annonce->U_pseudo)?></p><?php if (isset($pseudo)) { ?><a class="btn btn-primary centerbutton col-12" href="<?= base_url();?>/Annonce/louer?id=<?=esc($annonce->A_idannonce)?>" role="button" style="border-bottom-color: var(--blue);background: var(--blue);">Louer</a>
                      </div>
                      <div class="form-group">
                          <p>Contacter l'annonceur :</p><textarea class="form-control" type="text" name="description" rows="4" placeholder="Envoyer un message"></textarea><br/><button class="btn btn-primary centerbutton col-12" type="submit" style="background: var(--blue);">Envoyer</button> <br/> <button class="btn btn-primary centerbutton col-12" type="reset" style="background: var(--blue);">Effacer</button> 
                      </div><?php } else { ?> <p> Vous devez vous connecter pour envoyer un message ou louer le logement ! </p><button class="btn btn-primary col-12" type="button" style="background: var(--gray);">Se connecter</button> <?php } ?>
                  </form> <br/>
                <?php } else { ?>
                  <div class="form-group">
                          <p> C'est une de vos annonces </p>
                  </div>
                <?php } ?>

        </div>
    </div>
    <div>
            <h2 class="c-paragraphe" style="padding-top: 10px;"><?=esc($annonce->A_titre)?>&nbsp;&nbsp;</h2>
            <p style="color: rgb(255,95,5);"><?=esc($annonce->A_cout_loyer)?> € de loyer </p><?php if(!empty($annonce->A_cout_charges)) { ?> <p style="color: rgb(255,95,5);"> et <?=esc($annonce->A_cout_charges)?> € de charges</p> <?php } ?>
            <p class="c-paragraphe"> Adresse : <?=esc($annonce->A_adresse)?> <?=esc($annonce->A_CP)?> <?=esc($annonce->A_ville)?></p>
            <p class="c-paragraphe">Superficie :<?=esc($annonce->A_superficie)?> m²&nbsp;</p>
            <p class="c-paragraphe">Type de chauffages : <?=esc($annonce->A_type_chauffage)?></p>
            <?php if(!empty($annonce->E_id_engie)) { ?> <p class="c-paragraphe">Type d'énergie : <?=esc($annonce->E_description) ?> </p> <?php } ?>
            <p class="c-paragraphe">Description : <?=esc($annonce->A_description)?></p>
            <p class="text-muted">Date de création : <?=esc($annonce->A_date)?></p>
    </div>
    <div class="mapouter">
              <div class="gmap_canvas"><iframe width="550" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=<?=esc($annonce->A_adresse)?>,<?=esc($annonce->A_ville)?>e&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe></div>
    </div>
