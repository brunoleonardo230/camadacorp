<?php
if (!$Read):
    $Read = new Read;
endif;

$Read->ExeRead(DB_POSTS, "WHERE post_name = :nm", "nm={$URL[1]}");
if (!$Read->getResult()):
    require REQUIRE_PATH . '/404.php';
    return;
else:
    extract($Read->getResult()[0]);
    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
    date_default_timezone_set('America/Sao_Paulo');

    $Update = new Update;
    $UpdateView = ['post_views' => $post_views + 1, 'post_lastview' => date('Y-m-d H:i:s')];
    $Update->ExeUpdate(DB_POSTS, $UpdateView, "WHERE post_id = :id", "id={$post_id}");

    $Read->FullRead("SELECT category_title, category_name FROM " . DB_CATEGORIES . " WHERE category_id = :id", "id={$post_category}");
    $CategoryTitle = $Read->getResult()[0]['category_title'];
    $CategoryName = $Read->getResult()[0]['category_name'];

    $Read->FullRead("SELECT user_name, user_lastname, user_content, user_thumb, user_facebook, user_instagram, user_google, user_youtube, user_linkedin FROM " . DB_USERS . " WHERE user_id = :user", "user={$post_author}");
    $AuthorThumb = "{$Read->getResult()[0]['user_thumb']}";
    $AuthorName = "{$Read->getResult()[0]['user_name']} {$Read->getResult()[0]['user_lastname']}";
    $AuthorContent = "{$Read->getResult()[0]['user_content']}";
endif;
?>

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
                        <h2 class="wow fadeInUp animated title_animate">Blog</h2>
                        <p class="wow fadeInUp animated titlep_animate"><?= mb_strtoupper("Centro de Treinamento de Atletas"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page_Banner End -->

<!-- /Blog Start-->
<div class="blog_main_sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-xs-12 blog_left">
                <div class="ft-blog-post">
                    <div class="main-content">
                        <div class="single-blog-post clearfix post-2245 post type-post status-publish
                            format-standard has-post-thumbnail hentry category-cardio-fitness-course-offer
                            category-gym-fitness tag-donec tag-pretium tag-quam tag-ultricies">
                            <div class="image">
                                <img width="750" height="224" src="<?= BASE; ?>/tim.php?src=uploads/<?= $post_cover; ?>&w=750&h=224"
                                     title="<?= $post_title; ?>" alt="<?= $post_title; ?>" class="img-responsive wp-post-image">
                            </div>
                            <div class="info">
                                <div class="date-wrapper">
                                    <div class="date">
                                        <p class="post-date"><?= date('d', strtotime($post_date)); ?></p>
                                        <p class="post-month"><?= utf8_encode(strftime('%b', strtotime($post_date))); ?></p>
                                    </div>
                                </div>
                                <div class="title-info">
                                    <div class="title">
                                        <h2 class="tittle"><?= $post_title; ?></h2>
                                    </div>
                                    <div class="info">
                                        <p>
                                            <span> <i class="fa fa-user"></i> Por:
                                                <a href="#" title="Visit templatation’s website" rel="author external"><?= $AuthorName; ?></a>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="main-content-box">
                                <p><?= $post_content; ?></p>
                            </div>
                        </div>

                        <div class="admin-info-box">
                            <div class="img-box">
                                <img alt="" src="<?= BASE; ?>/tim.php?src=uploads/<?= $AuthorThumb; ?>&w=114&h=114"
                                     class="avatar avatar-114 photo" height="114" width="114">
                            </div>
                            <div class="text-box">
                                <h3><?= $AuthorName; ?></h3>
                                <p class="text_detail"> <?= Check::Words($AuthorContent, 25); ?></p>
                            </div>
                        </div>
                        <div class="comment-part">
                            <div class="comments-box">
                                <h3 class="title"><span>Comentários</span></h3>
                                <div id="comments">
                                    <div class="fb-comments"
                                         data-href="<?= BASE; ?>/artigo/<?= $post_name; ?>"
                                         data-width="100%" data-numposts="5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php require REQUIRE_PATH . '/inc/sidebar.php'; ?>
        </div>
    </div>
</div>
<!-- /Blog End-->
<div id="fb-root"></div>
<script>(function (d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s);
js.id = id;
js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.12&appId=<?= SITE_SOCIAL_FB_APP; ?>';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
