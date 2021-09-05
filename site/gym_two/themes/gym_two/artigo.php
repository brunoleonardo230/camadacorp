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
    <div class="container">
        <div class="row">
            <div class="blog_txt wow fadeIn animated" data-wow-delay="1s" data-wow-duration="1000ms">
                <h1 class="wow fadeInUp animated title_animate"> Blog</h1>
                <h3 class="wow fadeInUp animated titlep_animate"> Centro de Treinamento de Atletas</h3>
            </div>
        </div>
    </div>
    <p class="breadcrumb1"><span> Home / Blog / <?= Check::Chars($post_title, 20); ?> </span></p>
</section>
<!-- Page_Banner End -->

<!-- Blog Start -->
<div class="blog_main_sec">
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-md-8 col-xs-12 blog_left">
                <div class="blog-post">
                    <article id="post-3690" class="post-3690 post type-post status-publish format-standard has-post-thumbnail hentry category-karate-school category-kickboxing tag-boxing tag-coaches tag-gym tag-karate">
                        <div class="image">
                            <img width="1400" height="907"
                                class="img-responsive attachment-artkombat-post size-artkombat-post wp-post-image"
                                 src="<?= BASE; ?>/uploads/<?= $post_cover; ?>"
                                 title="<?= $post_title; ?>" alt="<?= $post_title; ?>">
                        </div>
                        <div class="blog-info blog-info-post-top">
                            <ul>
                                <li class="icon-fav m_right">
                                    <span class="fa fa-calendar"></span>
                                    <i><a href="#"><?= date('d/m/Y', strtotime($post_date)); ?></a></i>
                                </li>
                                <li class="icon-comments">
                                    <span class="fa fa-eye"></span>
                                    <a href="#"><?= $post_views; ?> Visualizações</a>
                                </li>
                            </ul>
                            <div class="ltx-user">
                                <img alt="" src="<?= BASE; ?>/tim.php?src=uploads/<?= $AuthorThumb; ?>&w=30&h=30"
                                    class="avatar avatar-50 photo" height="30" width="30">
                                <span class="info">Por: <?= $AuthorName; ?></span>
                            </div>
                        </div>
                        <div class="description" style="border-bottom: 1px solid #ee6c0c">
                            <div class="text text-page">
                                <p><?= $post_content; ?></p>
                            </div>
                        </div>
                    </article>
                    <div id="comments" class="comments-area">

                        <div class="comments-form-wrap"><a class="anchor" id="comments-form"></a>
                            <div class="comments-form anchor">
                                <div id="respond" class="comment-respond">
                                    <h3 class="comment-reply-title">Comentários</h3>
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
            </div>
            <?php require REQUIRE_PATH . '/inc/sidebar.php'; ?>
        </div>
    </div>
</div>
<!-- Blog end -->

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
<div id="fb-root"></div>
<script>(function (d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s);
js.id = id;
js.src = 'https://connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.12&appId=<?= SITE_SOCIAL_FB_APP; ?>';
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

  
