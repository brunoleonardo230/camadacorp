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
<section class="breadcrumb_sec">
    <div class="blog_txt">
        <h1 class="wow fadeInUp animated title_animate"> <?= Check::Chars($post_title, 20); ?> </h1>
        <p class="wow fadeInUp animated titlep_animate"> Home <i class="fa fa-angle-right"></i> <?= Check::Chars($post_title, 20); ?> </p>
    </div>
</section>
<!-- Page_Banner End -->

<!-- Blog Start -->
<div class="blog_main_sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-xs-12">
                <div class="row">
                    <div class="col-sm-12 col-md-8 col-xs-12 blog_left">
                        <article
                                class="c-post c-big-post marg-sm-t40 marg-xs-t30 marg-lg-b90 marg-md-b70 marg-sm-b60 marg-xs-b30 post-27 post type-post status-publish format-standard has-post-thumbnail hentry category-boxing category-fitness category-training tag-compose-dola tag-loremi tag-lorsitameta tag-nulla tag-psumde">
                            <header class="entry-header marg-lg-b45 scrol">
                                <h2 class="entry-title marg-lg-b20"><?= $post_title; ?></h2>
                                <span class="posted-on footer-elems">
                                    <a href="#" rel="bookmark">
                                      <time class="entry-date" datetime="<?= date('d/m/Y H:i', strtotime($post_title)); ?>"><?= date('d/m/Y H:i', strtotime($post_title)); ?></time>
                                    </a>
                                </span>
                            </header>

                            <a class="post-img-link" href="#">
                                <div class="wpc-bg-img s-back-switch">
                                    <img width="800" height="458" src="<?= INCLUDE_PATH; ?>/assets/ images/blog_page.png"
                                         class="img-responsive attachment-large size-large wp-post-image" alt="">
                                </div>
                            </a>
                            <div class="entry-content marg-lg-t55 marg-md-t40 marg-sm-t35 marg-xs-t25">
                                <p><?= $post_content; ?></p>
                                <div class="tags-links single-pager clearfix">
                                    <a href="#" class="prev"> <i class="icon fa fa-angle-left"></i>
                                        SOBRE O AUTOR
                                    </a>
                                </div>
                                <section class="c-post-author clearfix c-line">
                                    <img src="<?= BASE; ?>/tim.php?src=uploads/<?= $AuthorThumb; ?>&w=115&h=115" title="<?= $AuthorName; ?>"
                                         alt="<?= $AuthorName; ?>" class="avatar avatar-115 wp-user-avatar wp-user-avatar-115 alignnone photo">
                                    <div class="author-info">
                                        <h5 class="author-name"><?= $AuthorName; ?></h5>
                                        <p class="author-desc marg-lg-t20"><?= Check::Words($AuthorContent, 30); ?></p>
                                    </div>
                                </section>

                                <div class="post-comments">
                                    <div id="comments" class="c-post-comments c-line marg-lg-t30 marg-xs-t20 t-left">
                                        <h2 class="c-heading"><span class="count">Comentários</span></h2>
                                        <div id="comments">
                                            <div class="fb-comments"
                                                 data-href="<?= BASE; ?>/artigo/<?= $post_name; ?>"
                                                 data-width="100%" data-numposts="5">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                    <?php require REQUIRE_PATH . '/inc/sidebar.php'; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Blog End -->
<div id="fb-root"></div>
<script>(function (d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s);
js.id = id;
js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.12&appId=<?= SITE_SOCIAL_FB_APP; ?>';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
