<!-- Page_banner start -->
<section class="breadcrumb_sec">
    <div class="blog_txt">
        <h1 class="wow fadeInUp animated title_animate"> BLOG </h1>
        <p class="wow fadeInUp animated titlep_animate"> Home <i class="fa fa-angle-right"></i> blog </p>
    </div>
</section>
<!-- Page_banner end -->

<!-- Blog start -->
<div class="blog_main_sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-7 col-md-8 col-xs-12 blog_left">
                        <?php
                        $Page = (!empty($URL[1]) ? $URL[1] : 1);
                        $Pager = new Pager(BASE . "/artigos/", "<i class='fa fa-angle-double-left'></i>", "<i class='fa fa-angle-double-right'></i>", 2);
                        $Pager->ExePager($Page, 2);
                        $Read->FullRead(
                            "SELECT "
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
                            . "WHERE p.post_status = :s "
                            . "AND p.post_date <= NOW()"
                            . "ORDER BY post_date ASC "
                            . "LIMIT :limit OFFSET :offset", "s=1&limit={$Pager->getLimit()}&offset={$Pager->getOffset()}"
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
                                <article class="blog_detail">
                                    <div>
                                        <h2 class="blog_title">
                                            <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                                <?= $post_title; ?>
                                            </a>
                                        </h2>
                                        <p class="upload_info">
                                            <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?= date('d/m/Y', strtotime($post_date)); ?></span>
                                            <span class="date"><i class="fa fa-user" aria-hidden="true"></i> <?= $AuthorName; ?></span>
                                        </p>
                                    </div>
                                    <div class="blog_main_img">
                                        <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                            <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/ images/blog_page.png" alt="">
                                        </a>
                                    </div>
                                    <p class="blog_pera"><?= Check::Words($post_content, 60); ?></p>
                                    <div class="read_social col-sm-12 col-xs-12">
                                        <div class="row">
                                            <div class="pull-left">
                                                <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="Ver Mais">
                                                    Ver Mais
                                                    <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </article>
                                <?php
                            endforeach;
                        endif;

                        $Pager->ExePaginator(DB_POSTS, "WHERE post_status = 1 AND post_date <= NOW()");
                        echo $Pager->getPaginator();
                        ?>
                    </div>
                    <?php require REQUIRE_PATH . '/inc/sidebar.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->
