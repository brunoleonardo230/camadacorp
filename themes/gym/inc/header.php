<!-- Header Start-->
<header itemscope itemtype="http://schema.org/WPHeader" id="" class="main-header">
    <div class="header-top">
        <div class="container clearfix">
            <div class="top-left pull-left clearfix">
                <div class="phone pull-left">
                    <a href="https://wa.me/13155104263?text=Quero+fazer+uma+consultoria+esportiva.+" target="_blank">
                        <i class="fa fa-volume-control-phone" aria-hidden="true" style="margin-right: 5px;"></i> Whatsapp
                    </a>
                </div>
                <div class="email pull-left">
                    <a href="mailto:<?= SITE_ADDR_EMAIL; ?>">
                        <i class="fa fa-envelope" aria-hidden="true" style="margin-right: 5px;"></i> <?= SITE_ADDR_EMAIL; ?>
                    </a>
                </div>
            </div>
            <div class="top-right pull-right clearfix">
                <div class="social">
                    <span class="txt"> REDES SOCIAIS </span>
                    <!-- <a class="circlef" title="<?= SITE_NAME; ?> No Facebook" href="//www.facebook.com/<?= SITE_SOCIAL_FB_PAGE; ?>" target="_blank">
                        <i class="fa fa-facebook-f"></i> -->
                    </a>
                    <a class="circlei" title="<?= SITE_NAME; ?> No Instagram" href="//www.instagram.com/<?= SITE_SOCIAL_INSTAGRAM; ?>" target="_blank">
                        <i class="fa fa-instagram"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-lower">
        <div class="container clearfix">
            <div class="logo pull-left">
                <a href="<?= BASE; ?>" title="<?= SITE_NAME; ?>">
                    <h2 class="logo_name">CAMADA <span class="white_text">CORP </span></h2>
                </a>
            </div>
            <div class="right-cont clearfix">
                <nav itemscope itemtype="http://schema.org/SiteNavigationElement" class="main-menu">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse clearfix">
                        <ul class="nav navbar-nav navbar-right  ml-auto" id="onenav">
                            <li class="nav-link <?= ($URL[0] == 'index' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>" title="<?= SITE_NAME; ?>" class="js-scroll-trigger"><span itemprop="name">Home</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'ebook' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/ebook" title="Ebook" class="js-scroll-trigger"><span itemprop="name">Ebook</span></a></li>
                            <li class=" nav-link <?= ($URL[0] == 'sobre' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/sobre" title="Sobre" class="js-scroll-trigger"><span itemprop="name">Sobre</span></a></li>
                            <!-- <li class="nav-link <?= ($URL[0] == 'aulas' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/aulas" title="Aulas" class="js-scroll-trigger"><span itemprop="name">Aulas</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'horarios' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/horarios" title="Horários" class="js-scroll-trigger"><span itemprop="name">Horários</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'treinadores' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/treinadores" title="Treinadores" class="js-scroll-trigger"><span itemprop="name">Treinadores</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'artigos' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/artigos" title="Blog" class="js-scroll-trigger"><span itemprop="name">Blog</span></a></li> -->
                            <li class="nav-link <?= ($URL[0] == 'contato' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/contato" title="Contato" class="js-scroll-trigger"><span itemprop="name">Contato</span></a></li>
                            <li class="social_nav">
                                <div class="social">
                                    <span class="txt"> Redes Sociais </span>
                                    <a class="circlef" title="<?= SITE_NAME; ?> No Facebook" href="//www.facebook.com/<?= SITE_SOCIAL_FB_PAGE; ?>" target="_blank">
                                        <i class="fa fa-facebook-f"></i>
                                    </a>
                                    <a class="circlei" title="<?= SITE_NAME; ?> No Instagram" href="//www.instagram.com/<?= SITE_SOCIAL_INSTAGRAM; ?>" target="_blank">
                                        <i class="fa fa-instagram"></i>
                                    </a>
                                </div>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- Header End-->