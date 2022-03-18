<!-- Page_Banner Start -->
<section class="breadcrumb_sec" style="background-image:url(<?= INCLUDE_PATH; ?>/assets/images/about_bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title_box_page">
                    <div class="page_banner_img">
                        <img class="img-responsive wow fadeInLeft animated img_animate"
                             src="<?= INCLUDE_PATH; ?>/assets/images/title-bg.png" alt="">
                    </div>
                    <div class="page_banner_title">
                        <h2 class="wow fadeInUp animated title_animate">Sobre <?= SITE_NAME; ?></h2>
                        <p class="wow fadeInUp animated titlep_animate"><?= mb_strtoupper("Centro de Treinamento de Atletas"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page_Banner End -->

<!-- /About Start-->
<section class="about_sec about_inner_page">
    <div class="container">
        <div class="row">
            <div class="col-xl-6 col-lg-6 col-md-4">
                <div class="about_img">
                    <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/about_inner.png" alt="">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="about_inner_page_con">
                        <h2 class="title"><span>Sobre </span> <?= SITE_NAME; ?></h2>
                        <p>Temos profissionais especialistas em Educação Física e Nutrição, treinados e concentrados para organizar sua rotina e potencializar seus resultados com treino e dieta.</p>
                        <p>Trabalhamos com todos os tipos de condicionamento físico para todas as idades: obesos, magros, fisiculturistas, lutadores, vida saudável, etc...</p>
                        <p>Uma dieta esportiva é uma parte importante para o seu desempenho atlético. Um plano nutricional deve ser tão individual quanto seu treinamento, pois depende de seus objetivos, condição física e esporte.</p>

                        <a href="<?= BASE; ?>/contato" class="primary-btn about_btn" title="Contato"> Contato</a></div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /About End-->

<!-- /Counter Start-->
<div class="achivments" id="counter">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-6 col-6 border_col wow fadeInLeft animated">
                <div class="achievements_box">
                    <img class="img-fluid" src="<?= INCLUDE_PATH; ?>/assets/images/customers.png" alt="Days Worked">
                    <div class="counter-value number" data-count="11">0</div>
                    <p>Dias de Treinos</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-6 col-6 border_col wow fadeInLeft animated">
                <div class="achievements_box">
                    <img class="img-fluid" src="<?= INCLUDE_PATH; ?>/assets/images/coffee.png" alt="Project Finished">
                    <div class="counter-value number" data-count="49">0</div>
                    <p>Energéticos Ingeridos</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-6 col-6 border_col wow fadeInLeft animated">
                <div class="achievements_box">
                    <img class="img-fluid" src="<?= INCLUDE_PATH; ?>/assets/images/equipments.png" alt="Coffee Cup">
                    <div class="counter-value number" data-count="316">0</div>
                    <p>Exercícios Realizados</p>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-xs-6 col-6 border_col wow fadeInLeft animated">
                <div class="achievements_box">
                    <img class="img-fluid" src="<?= INCLUDE_PATH; ?>/assets/images/experience.png" alt="Client Satisfied">
                    <div class="counter-value number" data-count="168">0</div>
                    <p>Clientes Satisfeitos</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Counter End-->

<!-- /Testimonials Start-->
<section class="testimonials">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about_inner_page_con title_box">
                    <h2 class="title"><span>Depoimentos</span>O Que Estão Dizendo?</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestib<br>
                        ulum porttitor egestas orci, vinec at velit vestibulum,</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="owl-carousel owl-theme ss_carousel" id="testimonials_slider">
                    <?php
                    $Read->ExeRead(DB_TESTIMONIALS, "WHERE testimonial_date <= NOW() ORDER BY testimonial_date ASC");
                    if (!$Read->getResult()):
                        echo Erro("Ainda Não Existem Depoimentos Cadastrados! :)", E_USER_NOTICE);
                    else:
                        foreach ($Read->getResult() AS $Testimonials):
                            extract($Testimonials);
                            ?>
                            <div class="item">
                                <div class="client_img">
                                    <img src="<?= BASE; ?>/uploads/<?= $testimonial_image; ?>" title="<?= $testimonial_name; ?>"
                                         alt="<?= $testimonial_name; ?>" class="img-responsive">
                                </div>
                                <div class="testimonials_box">
                                    <div class="client_name">
                                        <p><?= $testimonial_name; ?></p>
                                        <i class="fa fa-quote-left" aria-hidden="true"></i>
                                        <h5><?= Check::Words($testimonial_depoiment, 35); ?></h5>
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
<!-- /Testimonials End-->

<!-- /Trainer Start-->
<section class="inner_trainer Trainer_sec" id="Trainer">
    <div class="container">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-lg-6 col-md-8">
                <div class="title-right">
                    <h2 class="title"><span>Treinadores</span> Fazendo Atletas Perfeitos </h2>
                    <p class="aftertitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestib ulum porttitor
                        egestas orci, vinec at velit vestibulum,</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="trainers-list carousel">
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
    </div>
</section>
<!-- /Trainer End-->

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
  