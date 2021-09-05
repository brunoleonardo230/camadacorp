<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="blog_txt">
        <h1 class="wow fadeInUp animated title_animate"> Sobre <?= SITE_NAME; ?> </h1>
        <p class="wow fadeInUp animated titlep_animate"> Home <i class="fa fa-angle-right"></i> Sobre <?= SITE_NAME; ?></p>
    </div>
</section>
<!-- Page_Banner End -->

<!-- About Start -->
<section class="about_inner_page">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="about_con">
                    <h2 class="title"><b> Sobre </b><span class="green_text"> </span><?= SITE_NAME; ?></h2>
                    <p>Cras faucibus in nunc sed volutpat. Duis ac elementum velit, vel ornare lacus. Phasellus eget
                        tincidunt odio. </p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut a convallis nibh. Sed laoreet lacus
                        eu interdum euismod. Fusce condimentum, tortor in fringilla sollicitudin, eros dui blandit
                        risus, sit amet dignissim arcu urna eget nibh. Vestibulum ultrices, libero nec ultrices
                        fermentu.</p>
                    <div class="read_more">
                        <a href="<?= BASE; ?>/contato" class="hvr-grow-shadow primary-btn" title="Contato"> Contato</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="about_img">
                    <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/about-inner.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- About End -->

<!-- Services Start -->
<section class="about_services">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6">
                <div class="services_box">
                    <div class="about_icon">
                        <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/consultation.png" alt="">
                    </div>
                    <h3>Consultoria Gratuita</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce scelerisque.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="services_box">
                    <div class="about_icon">
                        <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/service.png" alt="">
                    </div>
                    <h3>Excelente Serviço</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce scelerisque.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="services_box">
                    <div class="about_icon">
                        <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/trainers.png" alt="">
                    </div>
                    <h3>Melhores Treinadores</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce scelerisque.</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="services_box">
                    <div class="about_icon">
                        <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/programs.png" alt="">
                    </div>
                    <h3>Programas de Treino</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit fusce scelerisque.</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Services End -->

<!-- Testimonials Start -->
<section class="inner_clients">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="section_title1">
                    <h2>O QUE ESTÃO DIZENDO?</h2>
                </div>
                <div class="col-md-offset-2 col-md-8">
                    <div class="owl-carousel owl-theme ss_carousel our_clients_slider" id="slider5">
                        <?php
                        $Read->ExeRead(DB_TESTIMONIALS, "WHERE testimonial_date <= NOW() ORDER BY testimonial_date ASC");
                        if (!$Read->getResult()):
                            echo Erro("Ainda Não Existem Depoimentos Cadastrados! :)", E_USER_NOTICE);
                        else:
                            foreach ($Read->getResult() AS $Testimonials):
                                extract($Testimonials);
                                ?>
                                <div class="item">
                                    <div class="clients_con">
                                        <p><?= Check::Words($testimonial_depoiment, 35); ?></p>
                                    </div>
                                    <div class="client_name1">
                                        <div class="client_img">
                                            <img src="<?= BASE; ?>/uploads/<?= $testimonial_image; ?>" class="img-fluid"
                                                 title="<?= $testimonial_name; ?>" alt="<?= $testimonial_name; ?>">
                                        </div>
                                        <div class="client_name">
                                            <h3><?= $testimonial_name; ?></h3>
                                            <p><?= $testimonial_cargo; ?></p>
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
    </div>
</section>
<!-- Testimonials Start -->

<!-- Team Start -->
<section class="team_sec">
    <div class="container">
        <div class="col-md-12">
            <h2 class="title wow fadeInDown  animated" data-wow-delay="0ms" data-wow-duration="1000ms"><b> NOSSOS TREINADORES</b></h2>
        </div>
        <div class="col-md-12">
            <div class="carousel">
                <div class="owl-carousel owl-theme ss_carousel col-md-12 col-xs-12 col-sm-12" id="slider1">
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
<!-- Team End -->

<!-- Gallery Start -->
<div itemscope itemtype="http://schema.org/ImageGallery" class="gallery">
    <div class="footer-gallery owl-carousel owl-theme ss_carousel" id="slider2">
        <?php
        $Read->ExeRead(DB_GALLERY_IMAGES, "ORDER BY gallery_id ASC LIMIT :limit", "limit=24");
        if (!$Read->getResult()):
            echo Erro("Ainda Não Existe Imagens Cadastradas! :)", E_USER_NOTICE);
        else:
            foreach ($Read->getResult() as $GalleryImages):
                extract($GalleryImages);
                require REQUIRE_PATH . '/inc/gallery_item.php';
            endforeach;
        endif;
        ?>
    </div>
</div>
<!-- Gallery End -->
