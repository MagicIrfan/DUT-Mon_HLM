
    <!------ Include the above in your HEAD tag ---------->
      <h1 class="text-left" style="color: var(--white);border-top-style: solid;border-bottom-style: none;">Annonces disponibles :</h1>
      <div class="container">
        <?php foreach ($touteannonce as $i => $a): {?>
        <div class="container py-3">
            <div class="title h1 text-center"><?=esc($touteannonce[$i]['A_titre']) ?></div>
            <!-- Card Start -->
            <div class="card">
              <div class="row ">

                <div class="col-md-7 px-3">
                  <div class="card-block px-6">
                    <h4 class="card-title"><?=esc($touteannonce[$i]['A_cout_loyer']) ?>€</h4>
                    <p class="card-text"><?=esc($touteannonce[$i]['A_ville'])?> <?=esc($touteannonce[$i]['A_CP'])?></p>
                    <p class="card-text"><?=esc($touteannonce[$i]['A_date'])?></p>
                    <br> <br> <br> <br> <br>
                    <?php if ($pseudo == $touteannonce[$i]['U_pseudo']) { ?>
                      <a href="<?= base_url();?>/Modifier?id=<?= $touteannonce[$i]['A_idannonce'] ?>" class="mt-auto btn btn-primary">Modifier</a>
                      <a href="<?= base_url();?>/Supprimer?id=<?= $touteannonce[$i]['A_idannonce'] ?>" class="mt-auto btn btn-primary">Supprimer</a>
                    <?php } ?>
                    <a href="<?= base_url();?>/Annonce?id=<?= $touteannonce[$i]['A_idannonce'] ?>" class="mt-auto btn btn-primary">En savoir plus</a>
                  </div>
                </div>
                <!-- Carousel start -->
                <div class="col-md-5">
                  <div id="CarouselTest" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block" style="width:300px;height:320px;" src="<?=esc($touteannonce[$i]['image'])?>" alt="<?=esc($touteannonce[$i]['image'])?>">
                      </div>
                    </div>
                  </div>
                </div>
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