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
                        <h2 class="wow fadeInUp animated title_animate">Ebook </h2>
                        <p class="wow fadeInUp animated titlep_animate"><?= mb_strtoupper("Anabolic Expert - Ciclos Masculinos, Femininos e  TPC"); ?></p>
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
                    <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/EbookGabriel.jpg" alt="">
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="about_inner_page_con">
                        <h2 class="title"><span>Conheça </span> nosso ebook</h2>
                        <p>Está cansado de seguir dietas e rotinas de exercícios rigorosas e ainda assim não ver resultados significativos? Eu te ensino tudo que precisa fazer nesse Ebook.</p>
                        <p>Te ofereço orientações práticas para a administração adequada dessas substâncias, incluindo ciclos de uso, opções de dosagem e a famosa TPC (terapia pós-ciclo). Se você está pensando em usar esteróides anabolizantes para melhorar seu desempenho físico, este livro é um recurso valioso para ajudá-lo a tomar decisões informadas e seguras.</p>
                        <p>Compre agora e obtenha acesso a informações valiosas que podem ajudá-lo a alcançar seus objetivos de forma segura e eficaz. Não arrisque sua saúde e bem-estar com o uso imprudente de esteróides anabolizantes. Leia este ebook e comece a sua jornada de condicionamento físico com segurança e confiança.</p>
                        
                        <a href="https://pay.hotmart.com/K80019717A" class="primary-btn about_btn" title="Contato"> Adquira já!</a></div>
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
  