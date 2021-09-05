<?php if($URL[0] == 'index'): ?>
    <!-- Header Start -->
    <header itemscope itemtype="http://schema.org/WPHeader" id="" class="main-header index_header">
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
                        <div class="navbar-collapse collapse clearfix animated" data-wow-delay="0ms" data-wow-duration="800ms">
                            <ul class="nav navbar-nav navbar-right ml-auto" id="onenav">
                                <li class="nav-link home <?= ($URL[0] == 'index' ? 'current' : ''); ?>"><a itemprop="url" href="<?= BASE; ?>" title="<?= SITE_NAME; ?>" class="ToTop js-scroll-trigger"><span itemprop="name">Home</span></a></li>
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
<?php elseif($URL[0] == '404'): ?>

<?php else: ?>
    <!-- Header Start -->
    <header itemscope itemtype="http://schema.org/WPHeader" id="" class="main-header">
        <div class="header-lower">
            <div class="container clearfix">
                <div class="logo pull-left">
                    <a href="<?= BASE; ?>" title="<?= SITE_NAME; ?>">
                        <h2 class="logo_name">GYM <span class="white_text">FIT </span></h2>
                    </a>
                </div>
                <div class="right-cont clearfix">
                    <nav class="main-menu">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle menu_btn" data-toggle="collapse"
                                    data-target=".navbar-collapse">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>
                        <div class="navbar-collapse collapse clearfix animated" data-wow-delay="0ms" data-wow-duration="800ms">
                            <ul class="nav navbar-nav navbar-right ml-auto" id="onenav">
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
<?php endif; ?>
