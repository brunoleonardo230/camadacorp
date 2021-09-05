<!-- Page_Banner End -->
<section class="breadcrumb_sec">
    <div class="container">
        <div class="row">
            <div class="blog_txt">
                <h1 class="wow fadeInUp animated title_animate"> Sobre <?= SITE_NAME; ?></h1>
                <h3 class="wow fadeInUp animated titlep_animate"> Centro de Treinamento de Atletas</h3>
            </div>
        </div>
    </div>
    <p class="breadcrumb1"><span> Home / Sobre <?= SITE_NAME; ?> </span></p>
</section>
<!-- Page_Banner End -->

<!-- About Start-->
<section class="blog_main_sec">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about_img"><img class="img-responsive"
                                            src="<?= INCLUDE_PATH; ?>/assets/images/about_png.png" alt=""></div>
            </div>
            <div class="col-md-6">
                <div class="inner_about_con">
                    <h1>Sobre <?= SITE_NAME; ?></h1>
                    <p>Cras at cursus lorem, ac blandit leo. Morbi pulvinar orci dui, vitae laoreet arcu ultricies at.
                        Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis
                        egestas.tempus.</p>
                    <p>Fusce dapibus pellentesque pharetra. Phasellus turpis nibh, sagittis quis sollicitudin eget,
                        sollicitudin eget sem. Suspendisse sodales bibendum tellus in rhoncus. Quisque non pellentesque
                        urna, at sodales est. In metus urna, cursus sed porttitor eu, faucibus pulvinar mi.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About End-->

<!-- Why Choose Us Start-->
<section class="why_choose">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="choose_detail">
                    <h1>Porque Nos Escolher?</h1>
                </div>
                <div class="plan_box">
                    <div class="plan_number">
                        <h2>01.</h2>
                    </div>
                    <div class="plan_detail">
                        <h3>Melhores Preços</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent molestie ante at justo.</p>
                    </div>
                </div>
                <div class="plan_box">
                    <div class="plan_number">
                        <h2>02.</h2>
                    </div>
                    <div class="plan_detail">
                        <h3>Aparelhagem Moderna</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent molestie ante at justo.</p>
                    </div>
                </div>
                <div class="plan_box">
                    <div class="plan_number">
                        <h2>03.</h2>
                    </div>
                    <div class="plan_detail">
                        <h3>Aberto Todo Dia, o Tempo Todo</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent molestie ante at justo.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="container-skills">
                    <div class="progress_box">
                        <ul class='skills'>
                            <li class='progressbar1' data-width='90' data-target='90' data-percentage="90%">Gym</li>
                            <li class='progressbar1' data-width='70' data-target='85' data-percentage="85%">YOGA</li>
                            <li class='progressbar1' data-width='90' data-target='95' data-percentage="95%">BUILD BODY </li>
                            <li class='progressbar1' data-width='70' data-target='80' data-percentage="80%">MARTIAL ARTS </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Why Choose Us End-->

<!-- Testimonials Start -->
<section class="testimonials_box">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="testimonials_title">
                    <h2>O QUE ESTÃO DIZENDO</h2>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-theme ss_carousel what_we_do_slider" id="slider4">
                    <?php
                    $Read->ExeRead(DB_TESTIMONIALS, "WHERE testimonial_date <= NOW() ORDER BY testimonial_date ASC");
                    if (!$Read->getResult()):
                        echo Erro("Ainda Não Existem Depoimentos Cadastrados! :)", E_USER_NOTICE);
                    else:
                        foreach ($Read->getResult() AS $Testimonials):
                            extract($Testimonials);
                            ?>
                            <div class="item client_box">
                                <div class="testimonials_con_box">
                                    <p><?= Check::Words($testimonial_depoiment, 35); ?></p>
                                    <div class="test_border"></div>
                                </div>
                                <div class="client_img">
                                    <img src="<?= BASE; ?>/uploads/<?= $testimonial_image; ?>" title="<?= $testimonial_name; ?>"
                                         alt="<?= $testimonial_name; ?>" class="img-responsive">
                                    <div class="client_name">
                                        <p><?= $testimonial_name; ?></p>
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
    </div>
</section>
<!-- Testimonials End -->

<!-- Video Start -->
<section class="video_sec">
    <div class="container-fluid">
        <div class="row">
            <a class="video-link" href="https://www.youtube.com/embed/AulGwjIv3m8" data-width="550"
                 data-height="350" title="Ver Vídeo">
                <img src="<?= INCLUDE_PATH; ?>/assets/images/play.png" alt="">
            </a>
            <h2>Explore Nossa Academia </h2>
            <h2 class="orange_text">Ver Vídeo </h2>
        </div>
    </div>
</section>
<!-- Video End -->

<!-- Trainer Start-->
<section class="trainer_sec" id="trainer">
    <div class="container">
        <div class="col-md-12">
            <h2 class="title"><b>Nossos Treinadores</b></h2>
            <div class="carousel">
                <div class="owl-carousel owl-theme ss_carousel" id="slider3">
                    <?php
                    $Read->ExeRead(DB_TRAINEES, "WHERE trainee_status = 1 AND trainee_datecreate <= NOW() ORDER BY rand() DESC LIMIT :limit", "limit=12");
                    if (!$Read->getResult()):
                        echo Erro("Ainda Não Existem Treinadores Cadastrados! :)", E_USER_NOTICE);
                    else:
                        foreach ($Read->getResult() AS $Trainee):
                            extract($Trainee);
                            require REQUIRE_PATH . '/inc/trainee_item.php';
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Trainer End-->
  
