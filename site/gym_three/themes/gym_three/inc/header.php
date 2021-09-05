<!-- Header Start -->
<header itemscope itemtype="http://schema.org/WPHeader" class="main-header">
    <div class="header-top">
        <div class="container clearfix">
            <div class="top-left pull-left clearfix">
                <div class="phone pull-left">
                    <a href="tel:<?= SITE_ADDR_PHONE_A; ?>">
                        <i class="fa fa-phone" style="margin-right: 5px;"></i> <?= SITE_ADDR_PHONE_A; ?>
                    </a>
                </div>
                <div class="email pull-left">
                    <a href="mailto:<?= SITE_ADDR_EMAIL; ?>">
                        <i class="fa fa-envelope-o" style="margin-right: 5px;"></i> <?= SITE_ADDR_EMAIL; ?>
                    </a>
                </div>
            </div>
            <div class="top-right pull-right clearfix">
                <div class="social">
                    <a title="<?= SITE_NAME; ?> No Facebook" href="//www.facebook.com/<?= SITE_SOCIAL_FB_PAGE; ?>" target="_blank" class="fa fa-facebook"></a>
                    <a title="<?= SITE_NAME; ?> No Instagram" href="//www.instagram.com/<?= SITE_SOCIAL_INSTAGRAM; ?>" target="_blank" class="fa fa-instagram"></a>
                    <a title="<?= SITE_NAME; ?> No Twitter" href="//www.twitter.com/<?= SITE_SOCIAL_TWITTER; ?>" target="_blank" class="fa fa-twitter"></a>
                    <a title="<?= SITE_NAME; ?> No Google" href="//plus.google.com/<?= SITE_SOCIAL_GOOGLE_PAGE; ?>" target="_blank" class="fa fa-google-plus"></a>
                    <a title="<?= SITE_NAME; ?> No Linkedin" href="//www.linkedin.com/<?= SITE_SOCIAL_LINKEDIN; ?>" target="_blank" class="fa fa-linkedin"></a>
                </div>
            </div>
        </div>
    </div>
    <div class="header-lower">
        <div class="container clearfix">
            <div class="logo pull-left">
                <a href="<?= BASE; ?>" title="<?= SITE_NAME; ?>">
                    <h2 class="logo_name">GYM <span class="white_text">FIT </span></h2>
                </a>
            </div>
            <div class="right-cont clearfix">
                <nav itemscope itemtype="http://schema.org/SiteNavigationElement" class="main-menu">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle menu_btn" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="navbar-collapse collapse clearfix">
                        <ul class="nav navbar-nav navbar-right  ml-auto" id="onenav">
                            <li class="nav-link home <?= ($URL[0] == 'index' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>" title="<?= SITE_NAME; ?>" class="js-scroll-trigger"><span itemprop="name">Home</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'sobre' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/sobre" title="Sobre" class="js-scroll-trigger"><span itemprop="name">Sobre</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'aulas' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/aulas" title="Aulas" class="js-scroll-trigger"><span itemprop="name">Aulas</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'horarios' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/horarios" title="Horários" class="js-scroll-trigger"><span itemprop="name">Horários</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'treinadores' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/treinadores" title="Treinadores" class="js-scroll-trigger"><span itemprop="name">Treinadores</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'artigos' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/artigos" title="Blog" class="js-scroll-trigger"><span itemprop="name">Blog</span></a></li>
                            <li class="nav-link <?= ($URL[0] == 'contato' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>/contato" title="Contato" class="js-scroll-trigger"><span itemprop="name">Contato</span></a></li>
                            <li class="search-btn" onclick="openSearch()">
                                <a><i class="fa fa-search"></i></a>
                            </li>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </nav>
            </div>
            <div id="myOverlay" class="overlay zoomIn animated" data-wow-delay="0ms" data-wow-duration="1000ms">
                <span class="closebtn" onclick="closeSearch()" title="Close Overlay"> x </span>
                <div class="overlay-content">
                    <form name="search" action="" method="post" enctype="multipart/form-data">
                        <input type="search" name="s" id="search" placeholder="Pesquisar...">
                        <button type="submit" title="Pesquisar"><i class="fa fa-search"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- Header End -->