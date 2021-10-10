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

<!-- Page_banner Start -->
<section class="breadcrumb_sec" style="background-image:url(<?= INCLUDE_PATH; ?>/assets/images/blogbg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title_box_page">
                    <div class="page_banner_img"><img class="img-responsive wow fadeInLeft animated img_animate"
                                                      src="<?= INCLUDE_PATH; ?>/assets/images/title-bg.png" alt="">
                    </div>
                    <div class="page_banner_title">
                        <h2 class="wow fadeInUp animated title_animate">Blog</h2>
                        <p class="wow fadeInUp animated titlep_animate"><?= mb_strtoupper("Centro de Treinamento de Atletas"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page_banner End -->

<!-- /Blog Start-->
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
                    . "p.post_views, "
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
                        <article class="blog_detail">
                            <div class="blog_main_img slass-img">
                                <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                    <img src="<?= BASE; ?>/tim.php?src=uploads/<?= $post_cover; ?>&w=745&h=414"
                                         title="<?= $post_title; ?>" alt="<?= $post_title; ?>">
                                </a>
                                <div class="dd-mm">
                                    <span class="date"><?= date('d', strtotime($post_date)); ?></span><br>
                                    <span class="month"><?= utf8_encode(strftime('%b', strtotime($post_date))); ?></span>
                                </div>
                            </div>
                            <div class="blog_intro">
                                <h3 class="blog_title">
                                    <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                        <?= $post_title; ?>
                                    </a>
                                </h3>
                                <div class="info">
                                    <p>
                                        <span><i class="fa fa-calendar" aria-hidden="true"></i><?= date('d/m/Y', strtotime($post_date)); ?></span>
                                        <span> <i class="fa fa-eye"></i><a href="#"><?= $post_views; ?> Visualizações</a></span>
                                    </p>
                                </div>
                            </div>
                            <p class="blog_pera"><?= Check::Words($post_content, 40); ?></p>
                            <div class="read_social col-sm-12 col-xs-12">
                                <div class="row">
                                    <div class="pull-left">
                                        <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="Ver Mais">
                                            Ver Mais
                                            <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </a>
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
<!-- /Blog End-->
