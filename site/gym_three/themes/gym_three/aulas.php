<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="blog_txt">
        <h1 class="wow fadeInUp animated title_animate"> Aulas </h1>
        <p class="wow fadeInUp animated titlep_animate"> Home <i class="fa fa-angle-right"></i> Aulas</p>
    </div>
</section>
<!-- Page_Banner Start -->

<!-- Coueses Start -->
<section class="home_course_sec" id="course">
    <div class="container">
        <div class="row">
            <div class="coueses-container filter-list clearfixcol-xs-12 col-sm-12 col-md-12 col-lg-12">
                <?php
                $Read->ExeRead(DB_CLASSES, "WHERE class_status = 1 ORDER BY class_datecreate ASC LIMIT :limit", "limit=12");
                if (!$Read->getResult()):
                    echo Erro("Ainda Não Existem Aulas Cadastradas! :)", E_USER_NOTICE);
                else:
                    foreach ($Read->getResult() AS $Class):
                        extract($Class);
                        require REQUIRE_PATH . '/inc/classes_item.php';
                    endforeach;
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<!-- Coueses End -->

