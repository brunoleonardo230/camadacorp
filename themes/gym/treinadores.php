<!-- Page_Banner Start -->
<section class="breadcrumb_sec" style="background-image: url(<?= INCLUDE_PATH; ?>/assets/images/blogbg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title_box_page">
                    <div class="page_banner_img">
                        <img class="img-responsive wow fadeInLeft animated img_animate"
                            src="<?= INCLUDE_PATH; ?>/assets/images/title-bg.png" alt="">
                    </div>
                    <div class="page_banner_title">
                        <h2 class="wow fadeInUp animated title_animate">Treinadores</h2>
                        <p class="wow fadeInUp animated titlep_animate"><?= mb_strtoupper("Centro de Treinamento de Atletas"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page_Banner End -->

<!-- /Contact Start-->
<section class="tainers_box">
    <div class="container">
        <div class="row">
            <div class="trainers-list carousel">
                    <?php
                    $Read->ExeRead(DB_TRAINEES, "WHERE trainee_status = 1 AND trainee_datecreate <= NOW() ORDER BY rand() DESC LIMIT :limit", "limit=12");
                    if (!$Read->getResult()):
                        echo Erro("Ainda Não Existem Treinadores Cadastrados! :)", E_USER_NOTICE);
                    else:
                        foreach ($Read->getResult() AS $Trainee):
                            extract($Trainee);
                            ?>
                            <div class="col-md-4 col-sm-6">
                            <?php
                            require REQUIRE_PATH . '/inc/trainee_item.php';
                            ?>
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
<!-- /Contact End-->

<!-- /Discount Start-->
<section class="discount_con">
    <div class="container">
        <div class="row">
            <div class="col-md-7 col-sm-7">
                <div class="discount_title">
                    <h1>Aulas Especiais Para o Verão!<br>
                        Comece Agora & Receba 35% de Desconto</h1>
                </div>
            </div>
            <div class="col-md-5">
                <div class="discount_btn">
                    <a href="<?= BASE; ?>/contato" class="discount_button" title="Saber Mais">Saber Mais</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- /Discount End-->
