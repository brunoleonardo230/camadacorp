<!-- Page_Banner Start -->
<section class="breadcrumb_sec" style="background-image: url(<?= INCLUDE_PATH; ?>/assets/images/classes_bg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title_box_page">
                    <div class="page_banner_img">
                        <img class="img-responsive wow fadeInLeft animated img_animate" src="<?= INCLUDE_PATH; ?>/assets/images/title-bg.png" alt="">
                    </div>
                    <div class="page_banner_title">
                        <h2 class="wow fadeInUp animated title_animate">Nossas Aulas</h2>
                        <p class="wow fadeInUp animated titlep_animate"><?= mb_strtoupper("Centro de Treinamento de Atletas"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page_Banner End -->

<!-- /Classes_Box Start-->
<div class="inner_classes">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="portfolioFilter clearfix">
                    <ul id="filter_box">
                        <li><a href="#" data-filter="*" class="current">All</a></li>
                        <?php
                        $Read->ExeRead(DB_CLASSES, "WHERE class_status = 1 GROUP BY class_category ORDER BY class_datecreate ASC LIMIT :limit", "limit=6");
                        if (!$Read->getResult()):
                            echo Erro("Ainda Não Existem Aulas Cadastradas! :)", E_USER_NOTICE);
                        else:
                            foreach ($Read->getResult() AS $Class):
                                extract($Class);
                                ?>
                                <li><a href="#" data-filter=".<?= $class_category; ?>"><?= getCategoryClasses($class_category); ?></a></li>
                            <?php
                            endforeach;
                        endif;
                        ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="filter-list">
                <div class="portfolioContainer">
                    <?php
                    $Read->ExeRead(DB_CLASSES, "WHERE class_status = 1 ORDER BY class_datecreate ASC LIMIT :limit", "limit=6");
                    if (!$Read->getResult()):
                        echo Erro("Ainda Não Existem Aulas Cadastradas! :)", E_USER_NOTICE);
                    else:
                        foreach ($Read->getResult() AS $Class):
                            extract($Class);
                            ?>
                            <div class="<?= $class_category; ?>">
                                <article class="coueses-box col-md-12">
                                    <div class="item">
                                        <div class="course_box1">
                                            <div class="img_course1">
                                                <img src="<?= BASE; ?>/uploads/<?= $class_image; ?>" title="<?= $class_title; ?>"
                                                     alt="<?= $class_title; ?>" class="img-responsive" >
                                                <a href="<?= BASE; ?>/contato" class="course_read" title="Saber Mais">
                                                    Saber Mais
                                                </a>
                                            </div>
                                            <div class="course_con1">
                                                <h3><?= $class_title; ?></h3>
                                            </div>
                                        </div>
                                    </div>
                                </article>
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
<!-- /Classes_Box End-->

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