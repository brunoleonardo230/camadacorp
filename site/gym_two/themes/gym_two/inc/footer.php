<?php if($URL[0] == '404'): ?>

<?php else: ?>
<!-- Footer Start-->
<footer itemscope itemtype="http://schema.org/WPFooter" id="" class="main-footer">
    <div class="container">
        <div class="footer-widget-area clearfix">
            <div class="footer-widget about-widget col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated"
                 data-wow-delay="0ms" data-wow-duration="1000ms">
                <a href="<?= BASE; ?>" title="<?= SITE_NAME; ?>">
                    <h2 class="logo_name">
                        GYM <span class="white_text">FIT </span>
                    </h2>
                </a>
                <div class="widget-about">
                    <p>ligula sed porta cursus, lectus ligula interdum tortor, vitae tempor leo eros lobortis ante.
                        Integer semper, metus in tincidunt euismod.</p>
                    <div class="social">
                        <a title="<?= SITE_NAME; ?> No Facebook" href="//www.facebook.com/<?= SITE_SOCIAL_FB_PAGE; ?>" target="_blank" class="fa fa-facebook"></a>
                        <a title="<?= SITE_NAME; ?> No Instagram" href="//www.instagram.com/<?= SITE_SOCIAL_INSTAGRAM; ?>" target="_blank" class="fa fa-instagram"></a>
                        <a title="<?= SITE_NAME; ?> No Twitter" href="//www.twitter.com/<?= SITE_SOCIAL_TWITTER; ?>" target="_blank" class="fa fa-twitter"></a>
                        <a title="<?= SITE_NAME; ?> No Google" href="//plus.google.com/<?= SITE_SOCIAL_GOOGLE_PAGE; ?>" target="_blank" class="fa fa-google-plus"></a>
                        <a title="<?= SITE_NAME; ?> No Linkedin" href="//www.linkedin.com/<?= SITE_SOCIAL_LINKEDIN; ?>" target="_blank" class="fa fa-linkedin"></a>
                    </div>
                </div>
            </div>
            <div class="footer-widget quick-links col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated"
                 data-wow-delay="300ms" data-wow-duration="1000ms">
                <h4>LINKS</h4>
                <div class="widget-link">
                    <ul>
                        <li><a itemprop="url" href="<?= BASE; ?>" title="<?= SITE_NAME; ?>" class="ToTop">Home</a></li>
                        <li><a itemprop="url" href="<?= BASE; ?>/sobre" title="Sobre">Sobre</a></li>
                        <li><a itemprop="url" href="<?= BASE; ?>/aulas" title="Aulas">Aulas</a></li>
                        <li><a itemprop="url" href="<?= BASE; ?>/horarios" title="Horários">Horários</a></li>
                        <li><a itemprop="url" href="<?= BASE; ?>/artigos" title="Blog">Blog</a></li>
                        <li><a itemprop="url" href="<?= BASE; ?>/contato" title="Contato">Contato</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-widget latest-work col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated"
                 data-wow-delay="600ms" data-wow-duration="1000ms">
                <h4>Últimos Posts</h4>
                <div class="widget-post">
                    <div class="clearfix">
                        <?php
                        $Read->FullRead(
                            "SELECT "
                            . "post_cover, "
                            . "post_title, "
                            . "post_name, "
                            . "post_date "
                            . "FROM " . DB_POSTS
                            . " WHERE post_status = :s "
                            . "AND post_date <= NOW() "
                            . "ORDER BY post_date DESC "
                            . "LIMIT :limit", "s=1&limit=9"
                        );
                        if (!$Read->getResult()):
                            echo Erro("Ainda Não Existem Posts Cadastrados! :)", E_USER_NOTICE);
                        else:
                            foreach ($Read->getResult() as $Posts):
                                extract($Posts);
                                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                                date_default_timezone_set('America/Sao_Paulo');
                                ?>
                                <figure class="image">
                                    <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                        <img src="<?= BASE; ?>/tim.php?src=uploads/<?= $post_cover; ?>&w=70&h=70"
                                             title="<?= $post_title; ?>" alt="<?= $post_title; ?>">
                                    </a>
                                </figure>
                            <?php
                            endforeach;
                        endif
                        ?>
                    </div>
                </div>
            </div>
            <div class="footer-widget address col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-delay="900ms"
                 data-wow-duration="1000ms">
                <h4>Contato</h4>
                <div class="widget-content">
                    <div class="address_box col-sm-12">
                        <i class="fa fa-phone col-sm-1"></i>
                        <p class="col-sm-10"><?= SITE_ADDR_PHONE_A; ?></p>
                    </div>
                    <br>
                    <div class="address_box col-sm-12">
                        <i class="fa fa-envelope col-sm-1"></i>
                        <p class="col-sm-10"><?= SITE_ADDR_EMAIL; ?></p>
                    </div>
                    <br>
                    <div class="address_box1 col-sm-12">
                        <i class="fa fa-map-marker col-sm-1"></i>
                        <p class="col-sm-10">
                            <?= SITE_ADDR_ADDR; ?><br>
                            <?= SITE_ADDR_CITY; ?> | <?= SITE_ADDR_UF; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="auto-container text-center">
            Copyright ® <?= date('Y'); ?> - Todos os Direitos Reservados - <a class="copyright-link" href="<?= BASE; ?>" title="<?= SITE_NAME; ?>"><?= SITE_NAME; ?></a><br>
            Desenvolvido Com <i class="icon-heart copyright-heart"></i>Por <a class="copyright-link" href="https://www.gbtechweb.com.br" title="GbTechWeb" target="_blank">GbTechWeb</a>
        </div>
    </div>
</footer>
<!-- Footer End-->
<?php endif; ?>