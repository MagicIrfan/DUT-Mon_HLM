
    <!------ Include the above in your HEAD tag ---------->
      <div class="container">
        <h1 class="text-left" style="color: var(--white);border-top-style: solid;border-bottom-style: none;">6 dernières annonces:</h1>
        <?php foreach ($annonces as $i => $a): {?>
        <div class="container py-3">
            <div class="title h1 text-center"><?=esc($annonces[$i]['A_titre']) ?></div>
            <!-- Card Start -->
            <div class="card">
              <div class="row ">

                <div class="col-md-7 px-3">
                  <div class="card-block px-6">
                    <h4 class="card-title"><?=esc($annonces[$i]['A_cout_loyer']) ?>€</h4>
                    <p class="card-text"><?=esc($annonces[$i]['A_ville'])?> <?=esc($annonces[$i]['A_CP'])?></p>
                    <p class="card-text"><?=esc($annonces[$i]['A_date'])?></p>
                    <br> <br> <br> <br> <br>
                    <?php if ($pseudo == $annonces[$i]['U_pseudo']) { ?>
                      <a href="<?= base_url();?>/ModifierAnnonces?id=<?= $annonces[$i]['A_idannonce'] ?>" class="mt-auto btn btn-primary">Modifier</a>
                      <a href="<?= base_url();?>/Supprimer?id=<?= $annonces[$i]['A_idannonce'] ?>" class="mt-auto btn btn-primary">Supprimer</a>
                    <?php } ?>
                    <a href="<?= base_url();?>/Annonce?id=<?= $annonces[$i]['A_idannonce'] ?>" class="mt-auto btn btn-primary">En savoir plus</a>
                  </div>
                </div>
                    <div class="col-md-5">
                      <div id="CarouselTest" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                          <div class="carousel-item active">
                            <img class="d-block" style="width:300px;height:320px;" src="<?=esc($annonces[$i]['image'])?>" alt="<?=esc($annonces[$i]['image'])?>">
                          </div>
                        </div>
                      </div>
                    </div>
                <!-- Carousel start -->
                
                <!-- End of carousel -->
              </div>
            </div>
            <!-- End of card --> 
        </div>
      <?php } endforeach; ?>
      </div>
      <br>
      <br>
      <br>
