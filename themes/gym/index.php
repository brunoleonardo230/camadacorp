<!-- Carousel Start -->
<section class="slider">
    <div class="carousel fade-carousel slide" data-ride="carousel" data-interval="4000" id="bs-carousel">
        <ol class="carousel-indicators">
            <li data-target="#bs-carousel" data-slide-to="0" class="active first">
                <p></p>
                <span> </span></li>
            <li data-target="#bs-carousel" data-slide-to="1" class="sec">
                <p></p>
                <span> </span></li>
            <li data-target="#bs-carousel" data-slide-to="2" class="last">
                <p></p>
                <span> </span></li>
        </ol>
        <div class="carousel-inner">
            <div class="item slides active">
                <div class="slide-1"></div>
                <div class="hero">
                    <h2 class="sec-title title"><span><?= SITE_NAME; ?></span> Agencia de Consultoria</h2>
                    <p>Oferecemos Equipamentos Moderos, Esteiras, Estúdio de Boxe, TRX e Spinning.</p>
                    <a href="<?= BASE; ?>/contato" class="btn btn-hero btn-lg" role="button" title="Contato">Contato</a>
                </div>
            </div>
            <div class="item slides">
                <div class="slide-2"></div>
                <div class="hero">
                    <h2 class="sec-title title"><span><?= SITE_NAME; ?></span> Agencia de Consultoria</h2>
                    <p>Oferecemos Equipamentos Moderos, Esteiras, Estúdio de Boxe, TRX e Spinning.</p>
                    <a href="<?= BASE; ?>/contato" class="btn btn-hero btn-lg" role="button" title="Contato">Contato</a>
                </div>
            </div>
            <div class="item slides">
                <div class="slide-3"></div>
                <div class="hero">
                    <h2 class="sec-title title"><span><?= SITE_NAME; ?></span> Agencia de Consultoria</h2>
                    <p>Oferecemos Equipamentos Moderos, Esteiras, Estúdio de Boxe, TRX e Spinning.</p>
                    <a href="<?= BASE; ?>/contato" class="btn btn-hero btn-lg" role="button" title="Contato">Contato</a>
                </div>
            </div>
            <a class="left carousel-control" href="#bs-carousel" data-slide="prev"> Prev</a>
            <a class="right carousel-control" href="#bs-carousel" data-slide="next"> Next</a>
        </div>
    </div>
</section>
<!-- Carousel End -->

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

<!-- About Start-->
<section class="about_sec" id="aboutus">
    <div class="about-section">
        <div class="container">
            <div class="abt_left col-lg-6 col-sm-5 col-md-4 col-xs-12">
                <div class="row">
                    <div class="img-wrap">
                        <img class="about_img1" src="<?= INCLUDE_PATH; ?>/assets/images/abt1.png"
                             alt="about-img1" width="238" height="655"/>
                        <img class="about_img2" src="<?= INCLUDE_PATH; ?>/assets/images/abt2.png"
                             alt="about-img2" width="238" height="655"/>
                    </div>
                </div>
            </div>
            <div class="abt_right col-lg-6 col-sm-7 col-md-8 col-xs-12">
                <div class="row">
                    <h2 class="title"><span>Quem somos</span> <?= SITE_NAME; ?></h2>
                    <p>A Corporação Camada é uma agência de consultoria voltada para o desempenho e alta performance através da musculação, crossfit e dieta nutricional, construindo um melhor estilo de vida para você.</p>
                    <p>Trabalhamos com: Avaliação Física com bioimpedância, Nutrição Esportiva, Prescrição de Treino e Recursos Ergogênicos.</p>                    
                    <a href="<?= BASE; ?>/sobre" class="primary-btn" title="Saber Mais"> Saber Mais</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</section>
<!-- About End-->

<!-- Video Start -->
<section class="video_sec">
    <div class="container-fluid">
        <div class="row">
            <a href="https://www.youtube.com/embed/R7h9_9vU8Js" data-width="550" data-height="350" class="video-link">
                <img src="<?= INCLUDE_PATH; ?>/assets/images/play.png" class="img-responsive" alt="">
            </a>
            <h2>Conheça nosso canal no YouTube</h2>
            <a href="https://www.youtube.com/embed/R7h9_9vU8Js" data-width="550" data-height="350"
               class="video-link primary-btn"> Ver Vídeo 
            </a>
        </div>
    </div>
</section>
<!-- Video End -->




<!-- Course Start-->
<section class="course_sec" id="course">
    <div class="container">
        <div class="col-md-12">
            <div class="title_box_course">
                <div class="course_sec_img">
                    <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/title-bg.png" alt="">
                </div>
                <div class="course_sec_title">
                    <h2>Nossos Resultados</h2>
                    <!-- <p>Nosso Objetivo é Transformar Seu Corpo</p> -->
                </div>
            </div>
        </div>
        <div class="course-list">
            <?php
            $Read->ExeRead(DB_CLASSES, "WHERE class_status = 1 ORDER BY class_datecreate ASC LIMIT :limit", "limit=6");
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
</section>
<!-- Course End -->

<!-- Trainers Start -->
<!-- <section class="Trainer_sec" id="Trainer">
    <div class="container">
        <div class="row">
            <div class="col-md-6"></div>
            <div class="col-lg-6 col-md-8">
                <div class="title-right">
                    <h2 class="title"><span>Nossos</span> Treinadores </h2>
                    <p class="aftertitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestib ulum porttitor
                        egestas orci, vinec at velit vestibulum.
                    </p>
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
</section> -->
<!-- Trainers End -->

<!-- Timetable Start-->
<!-- <section class="timetable_sec" id="timetable">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-xs-12 col-md-12 timetable_sec1">
                <div class="col-sm-9 col-xs-12 col-md-9">
                    <div class="row">
                        <h2 class="title"><span>Nossos</span> Horários</h2>
                        <p class="aftertitle">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestib ulum
                            porttitor egestas orci, vinec at velit vestibulum,</p>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-3 col-md-3">
                    <ul class="tabs ampmtime nav nav-tabs">
                        <li class="active" rel="tab1">Manhã</li>
                        <li rel="tab2">Tarde</li>
                    </ul>
                </div>
            </div>
            <div class="contnet-table">
                <div id="tab1" class="tab_content">
                    <table>
                        <tr>
                            <td>
                                <div class="td-date-time"><span class="td-empty"></span></div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">8:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">9:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">10:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">11:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">12:00</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Segunda</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/></div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt5.png" alt="boot-camp"
                                                 width="41" height="55"/></div>
                                        <span class="td-title">BOOT CAMP</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                 width="46" height="54"/></div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Terça</span></td>
                            <td><a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                 width="46" height="54"/>
                                        </div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td><a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td class="slide-bottom two">
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Quarta</span></td>
                            <td><a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt5.png" alt="boot-camp"
                                                 width="41" height="55"/>
                                        </div>
                                        <span class="td-title">BOOT CAMP</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Quinta</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt6.png" alt="boxing"
                                                 width="52" height="18"/>
                                        </div>
                                        <span class="td-title">BOXING</span>
                                        <span class="td-desc">(MANAL)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                 width="46" height="54"/>
                                        </div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Sexta</span></td>
                            <td><a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span> <span
                                            class="td-desc">(SHEREEN)</span></div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td><a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="boot-camp"
                                                 width="41" height="55"/>
                                        </div>
                                        <span class="td-title">BOOT CAMP</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                 width="46" height="54"/></div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Sábado</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td><a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/></div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <div class="td-services">
                                    <div class="td-img-wrap">
                                        <img src="<?= INCLUDE_PATH; ?>/assets/images/tt7.png" alt="core"
                                             width="52" height="52"/>
                                    </div>
                                    <span class="td-title">CORE</span>
                                    <span class="td-desc">(ANNA)</span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div id="tab2" class="tab_content">
                    <table>
                        <tr>
                            <td>
                                <div class="td-date-time"><span class="td-empty"></span></div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">13:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">14:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">15:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">16:00</span>
                                </div>
                            </td>
                            <td>
                                <div class="td-date-time">
                                    <span class="td-time">17:00</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Segunda</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                width="54" height="53"/></div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt5.png" alt="boot-camp"
                                                 width="41" height="55"/></div>
                                        <span class="td-title">BOOT CAMP</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                width="46" height="54"/></div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Terça</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                 width="46" height="54"/>
                                        </div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td class="slide-bottom two">
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Quarta</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt5.png" alt="boot-camp"
                                                 width="41" height="55"/>
                                        </div>
                                        <span class="td-title">BOOT CAMP</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Quinta</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/>
                                        </div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt6.png" alt="boxing"
                                                width="52" height="18"/>
                                        </div>
                                        <span class="td-title">BOXING</span>
                                        <span class="td-desc">(MANAL)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                 width="46" height="54"/>
                                        </div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Sexta</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt3.png" alt="spinning"
                                                 width="59" height="56"/>
                                        </div>
                                        <span class="td-title">Spinning</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                                      width="54" height="53"/>
                                        </div>
                                        <span class="td-title">BEGGINERS</span> <span
                                                class="td-desc">(SHEREEN)</span></div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="boot-camp"
                                                 width="41" height="55"/>
                                        </div>
                                        <span class="td-title">BOOT CAMP</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt2.png" alt="trx"
                                                 width="46" height="54"/></div>
                                        <span class="td-title">TRX</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="day">Sábado</span></td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt1.png" alt="immediate"
                                                 width="58" height="60"/></div>
                                        <span class="td-title">INTERMIDIATE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt4.png" alt="beginners"
                                                 width="54" height="53"/></div>
                                        <span class="td-title">BEGGINERS</span>
                                        <span class="td-desc">(SHEREEN)</span>
                                    </div>
                                </a>
                            </td>
                            <td>
                                <a href="javascript:void(0);">
                                    <div class="td-services">
                                        <div class="td-img-wrap">
                                            <img src="<?= INCLUDE_PATH; ?>/assets/images/tt7.png" alt="core"
                                                 width="52" height="52"/>
                                        </div>
                                        <span class="td-title">CORE</span>
                                        <span class="td-desc">(ANNA)</span>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Timetable End -->


<!-- Blog Start -->
<!-- <section itemscope itemtype="http://schema.org/Blog" id="blog" class="blog_sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title"><span>Nosso Blog</span> Confira as Últimas do Blog!</h2>
            </div>
            <div class="col-md-12">
                <div class="carousel blog_list" style="margin-bottom: 120px;">
                    <div class="owl-carousel owl-theme ss_carousel" id="slider4">
                        <?php
                        $Read->ExeRead(DB_POSTS, "WHERE post_status = 1 AND post_date <= NOW() ORDER BY post_date DESC LIMIT :limit", "limit=3");
                        if (!$Read->getResult()):
                            echo Erro("Ainda Não Existe Posts Cadastrados! :)", E_USER_NOTICE);
                        else:
                            foreach ($Read->getResult() as $Posts):
                                extract($Posts);
                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                date_default_timezone_set('America/Sao_Paulo');
                                require REQUIRE_PATH . '/inc/blog_item.php';
                            endforeach;
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> -->
<!-- Blog End -->

<!-- Contact End -->
<div id="contactus" class="map-section">
    <div class="conatct-us wow">
        <form class="contato-form" name="contact_form" method="post"
              enctype="multipart/form-data" action="">
            <input type="hidden" name="subject">
            <h2>Contato</h2>
            <p>
                <input type="text" name="name" placeholder="Seu Nome" required>
            </p>
            <p>
                <input type="email" name="email" placeholder="Seu E-mail" required>
            </p>
            <p>
                <input type="text" name="phone" placeholder="Seu Telefone">
            </p>
            <p>
                <textarea name="message" placeholder="Mensagem"></textarea>
            </p>
            <input type="submit"  name="submit" class="send_mes" value="Enviar" title="Enviar">
        </form>
        <div style="display: none;" class="wc_contact_sended_white jwc_contact_sended">
            <p class="h2"><span>&#10003;</span> Solicitação Enviada Com Sucesso!</p>
            <p><b>Prezado(a) <span class="jwc_contact_sended_name">NOME</span>. Obrigado Pelo
                    Contato,</b></p>
            <p>Informamos que recebemos sua mensagem, e que vamos responder o mais breve
                possível.</p>
            <p><em>Atenciosamente <?= SITE_NAME; ?>.</em></p>
            <span title="Fechar" class="btn btn_red jwc_contact_close" style="margin-top: 20px;">FECHAR</span>
        </div>
    </div>
</div>
<!-- Contact End -->
