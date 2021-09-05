<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="container">
        <div class="row">
            <div class="blog_txt wow fadeIn animated" data-wow-delay="1s" data-wow-duration="1000ms">
                <h1> Treinadores </h1>
                <h3> Centro de Treinamento de Atletas </h3>
            </div>
        </div>
    </div>
    <p class="breadcrumb1"><span> Home / Treinadores </span></p>
</section>
<!-- Page_Banner End -->

<!-- /Schedule Start-->
<section class="trainer_sec" id="trainer">
    <div class="container">
        <div class="col-md-12">
            <div class="carousel">
                <?php
                $Read->ExeRead(DB_TRAINEES, "WHERE trainee_status = 1 AND trainee_datecreate <= NOW() ORDER BY rand() DESC LIMIT :limit", "limit=12");
                if (!$Read->getResult()):
                    echo Erro("Ainda Não Existem Treinadores Cadastrados! :)", E_USER_NOTICE);
                else:
                    foreach ($Read->getResult() AS $Trainee):
                        extract($Trainee);
                        ?>
                        <div class="col-md-4 col-sm-6 col-sx-12 item six circle1">
                        <div class="circle2">
                            <img src="<?= BASE; ?>/uploads/<?= $trainee_cover; ?>" title="<?= $trainee_name; ?>" alt="<?= $trainee_name; ?>">
                        </div>
                        <div class="trainer_info1">
                            <div class="info">
                                <h4> <?= $trainee_name; ?> </h4>
                                <h5> <?= getSpecialtiesTrainees($trainee_specialty); ?> </h5>
                                <div class="trainer_social">
                                    <a title="<?= $trainee_name; ?> No Facebook" href="//www.facebook.com/<?= $trainee_facebook; ?>" target="_blank"><i class="fa fa-facebook-f"></i></a>
                                    <a title="<?= $trainee_name; ?> No Instagram" href="//www.instagram.com/<?= $trainee_instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                    <a title="<?= $trainee_name; ?> No Twitter" href="//www.twitter.com/<?= $trainee_twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                    <a title="<?= $trainee_name; ?> No Linkedin" href="//www.linkedin.com/<?= $trainee_linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<!-- /Schedule end-->

<!-- /Personal_Trainer Start-->
<section class="personal_trainer">
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="personal_detail">
                    <h1>Você Quer Um<br>
                        <span class="color"> Personal Trainer?</span>
                    </h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum odio diam, ultrices vel
                        gravida nec, luctus quis metus. Nam tristique, dui eu suscipit eleifend, ante est pulvinar
                        tellus, ut pharetra mauris nulla quis elit.</p>
                    <a href="<?= BASE; ?>/contato" class="primary-btn" title="Saber Mais"> Saber Mais</a></div>
            </div>
            <div class="col-md-5">
                <div class="personal_img">
                    <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/personal_trainer.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Personal_trainer end-->
  
