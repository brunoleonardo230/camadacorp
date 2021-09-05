<?php
$Search = urldecode($URL[1]);
$SearchPage = urlencode($Search);

if (empty($_SESSION['search']) || !in_array($Search, $_SESSION['search'])):
    $Read->FullRead("SELECT search_id, search_count FROM " . DB_SEARCH . " WHERE search_key = :key", "key={$Search}");
    if ($Read->getResult()):
        $Update = new Update;
        $DataSearch = ['search_count' => $Read->getResult()[0]['search_count'] + 1];
        $Update->ExeUpdate(DB_SEARCH, $DataSearch, "WHERE search_id = :id", "id={$Read->getResult()[0]['search_id']}");
    else:
        $Create = new Create;
        $DataSearch = ['search_key' => $Search, 'search_count' => 1, 'search_date' => date('Y-m-d H:i:s'), 'search_commit' => date('Y-m-d H:i:s')];
        $Create->ExeCreate(DB_SEARCH, $DataSearch);
    endif;
    $_SESSION['search'][] = $Search;
endif;
?>

<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="container">
        <div class="row">
            <div class="blog_txt wow fadeIn animated" data-wow-delay="1s" data-wow-duration="1000ms">
                <h1 class="wow fadeInUp animated title_animate"> Blog</h1>
                <h3 class="wow fadeInUp animated titlep_animate"> Centro de Treinamento de Atletas</h3>
            </div>
        </div>
    </div>
    <p class="breadcrumb1"><span> Home / Blog / <?= Check::Chars($Search, 20); ?> </span></p>
</section>
<!-- Page_Banner End -->

<!-- Blog Start -->
<div class="blog_main_sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-xs-12 blog_left">
                <?php
                $Page = (!empty($URL[1]) ? $URL[1] : 1);
                $Pager = new Pager(BASE . "/artigos/", "<i class='fa fa-angle-double-left'></i>", "<i class='fa fa-angle-double-right'></i>", 2);
                $Pager->ExePager($Page, 3);
                $Read->FullRead(
                    "SELECT "
                    . "p.post_id, "
                    . "p.post_cover, "
                    . "p.post_title, "
                    . "p.post_name, "
                    . "p.post_content, "
                    . "p.post_category, "
                    . "p.post_tags, "
                    . "p.post_video, "
                    . "p.post_author, "
                    . "p.post_date, "
                    . "c.category_title, "
                    . "c.category_name "
                    . "FROM " . DB_POSTS . " p "
                    . "INNER JOIN " . DB_CATEGORIES . " c ON c.category_id = p.post_category "
                    . "WHERE p.post_status = 1 "
                    . "AND (post_title LIKE '%' :s '%' OR post_subtitle LIKE '%' :s '%')"
                    . "AND p.post_date <= NOW()"
                    . "ORDER BY post_date DESC "
                    . "LIMIT :limit OFFSET :offset ", "limit={$Pager->getLimit()}&offset={$Pager->getOffset()}&s={$Search}"
                );
                if (!$Read->getResult()):
                    echo Erro("Ainda Não Existe Posts Cadastrados! :)", E_USER_NOTICE);
                else:
                    foreach ($Read->getResult() as $Posts):
                        extract($Posts);
                        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                        date_default_timezone_set('America/Sao_Paulo');

                        $Read->FullRead("SELECT category_title, category_name FROM " . DB_CATEGORIES . " WHERE category_id = :id", "id={$post_category}");
                        $CategoryTitle = $Read->getResult()[0]['category_title'];
                        $CategoryName = $Read->getResult()[0]['category_name'];

                        $Read->ExeRead(DB_USERS, "WHERE user_id = :pa", "pa={$post_author}");
                        $AuthorName = $Read->getResult() ? $Read->getResult()[0]['user_name'] . " " . $Read->getResult()[0]['user_lastname'] : null;
                        $AuthorThumb = $Read->getResult() ? $Read->getResult()[0]['user_thumb'] : null;
                        ?>
                        <article class="blog_detail wow fadeInUp animated" data-wow-delay="1s" data-wow-duration="1000ms">
                            <div class="blog_main_img">
                                <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                    <img src="<?= BASE; ?>/uploads/<?= $post_cover; ?>" title="<?= $post_title; ?>"
                                         alt="<?= $post_title; ?>" class="img-responsive" >
                                </a>
                            </div>
                            <div class="blog_intro col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="blog_date col-sm-2 cop-md-2 col-xs-3">
                                        <p><span> <?= date('d', strtotime($post_date)); ?> </span></p>
                                        <p> <?= utf8_encode(strftime('%b', strtotime($post_date))); ?></p>
                                    </div>
                                    <div class="blog_intro_title col-sm-10 cop-md-10 col-xs-9">
                                        <h3 class="blog_title">
                                            <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                                <?= $post_title; ?>
                                            </a>
                                        </h3>
                                        <p> Postado Por:
                                            <span class="orange_text">
                                                <a href="#"><?= $AuthorName; ?></a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <p class="blog_pera"><?= Check::Words($post_content, 40); ?></p>
                            <div class="read_social col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="pull-left">
                                        <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="Ver Mais">
                                            Ver Mais
                                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                                        </a>
                                    </div>
                                    <div class="pull-right">
                                        <span class="right_tag">
                                            <i class="fa fa-tag" aria-hidden="true"></i>
                                            <span  class="orange_text">
                                                <a href="<?= BASE; ?>/categorias/<?= $CategoryName; ?>"> <?= $CategoryTitle; ?></a>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php
                    endforeach;
                endif;

                $Pager->ExePaginator(DB_POSTS, "WHERE post_status = 1 AND post_date <= NOW() AND (post_title LIKE '%' :s '%' OR post_subtitle LIKE '%' :s '%')", "s={$Search}");
                echo $Pager->getPaginator();
                ?>
            </div>
            <?php require REQUIRE_PATH . '/inc/sidebar.php'; ?>
        </div>
    </div>
</div>
<!-- Blog End -->

<!-- Contact_From Start -->
<section id="contact" class="home_contact_sec wow fadeInUp animated" data-wow-delay="400ms" data-wow-duration="1000ms">
    <div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 col-xs-12 col-md-5 col-lg-5 right">
                    <div class="right_form">
                        <h2>Fale Conosco</h2>
                        <form class="site-contact-form contato-form" name="contact_form" method="post"
                              enctype="multipart/form-data" action="">
                            <input type="hidden" name="phone">
                            <input type="hidden" name="subject">
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <input type="text" name="name" placeholder="Seu Nome" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <input type="email" name="email" placeholder="Seu E-mail" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-sm-12">
                                <div class="row">
                                    <textarea name="message" rows="3" placeholder="Sua Mensagem" required></textarea>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <button type="submit" class="primary-btn" title="Enviar"> ENVIAR</button>
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
            </div>
        </div>
    </div>
</section>
<!-- Contact_From End -->
