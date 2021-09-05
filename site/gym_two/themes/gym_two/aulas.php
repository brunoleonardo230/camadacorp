<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="container">
        <div class="row">
            <div class="blog_txt wow fadeIn animated" data-wow-delay="1s" data-wow-duration="1000ms">
                <h1 class="wow fadeInUp animated title_animate"> Nossas Aulas</h1>
                <h3 class="wow fadeInUp animated titlep_animate"> Centro de Treinamento de Atletas</h3>
            </div>
        </div>
    </div>
    <p class="breadcrumb1"><span> Home / Aulas </span></p>
</section>
<!-- Page_Banner End -->

<!-- Classes Start-->
<section class="classes">
    <div class="container">
        <div class="row">
            <?php
            $Read->ExeRead(DB_CLASSES, "WHERE class_status = 1 ORDER BY class_datecreate ASC LIMIT :limit", "limit=12");
            if (!$Read->getResult()):
                echo Erro("Ainda Não Existem Aulas Cadastradas! :)", E_USER_NOTICE);
            else:
                foreach ($Read->getResult() AS $Class):
                    extract($Class);
                    ?>
                    <div class="col-md-4 col-sm-6">
                        <div class="classes_box">
                            <div class="classes_img">
                                <img src="<?= BASE; ?>/uploads/<?= $class_image; ?>"
                                     title="<?= $class_title; ?>" alt="<?= $class_title; ?>" class="img-responsive" >
                            </div>
                            <div class="classes_detail">
                                <h3><?= $class_title; ?></h3>
                                <p><?= Check::Words($class_content, 10); ?></p>
                                <p class="read_more">
                                    <a href="<?= BASE; ?>/contato" class="classes_more" title="Saber Mais">Saber Mais</a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
<!-- Classes End-->
