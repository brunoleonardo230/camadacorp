<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="blog_txt">
        <h1 class="wow fadeInUp animated title_animate"> Treinadores </h1>
        <p class="wow fadeInUp animated titlep_animate"> Home <i class="fa fa-angle-right"></i> Treinadores</p>
    </div>
</section>
<!-- Page_Banner End -->

<!-- Team Start -->
<section class="team_sec">
    <div class="container">
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

<!-- Call_To_Action Start -->
<section class="call_to_action">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="call_to_action_con">
                    <h1>Aulas Especiais Para o Verão, <br><span class="color_change">35% de Desconto!</span></h1>
                    <p>Nunc malesuada, odio sit amet aliquam pulvinar, justo lectus auctor nisl, vitae volutpat erat
                        arcu sit amet tellus. In sodales metus sed varius lobortis.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="call_to_action_btn">
                    <a href="<?= BASE; ?>/contato" class="action_btn" title="Saber Mais">Saber Mais</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Call_To_Action End -->
  
