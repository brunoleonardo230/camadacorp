<?php
ob_start();
session_start();

require './_app/Config.inc.php';

//CHANCE THEME IN SESSION
$WC_THEME = filter_input(INPUT_GET, "wctheme", FILTER_DEFAULT);
if ($WC_THEME && $WC_THEME != 'null'):
    $_SESSION['WC_THEME'] = $WC_THEME;
    header("Location: " . BASE);
    exit;
elseif ($WC_THEME && $WC_THEME == 'null'):
    unset($_SESSION['WC_THEME']);
    header("Location: " . BASE);
    exit;
endif;

//READ CLASS AUTO INSTANCE
if (empty($Read)):
    $Read = new Read;
endif;

$Sesssion = new Session(SIS_CACHE_TIME);

//USER SESSION VALIDATION
if (!empty($_SESSION['userLogin']) && !empty($_SESSION['userLogin']['user_id'])):
    if (empty($Read)):
        $Read = new Read;
    endif;
    $Read->ExeRead(DB_USERS, "WHERE user_id = :user_id", "user_id={$_SESSION['userLogin']['user_id']}");
    if ($Read->getResult()):
        $_SESSION['userLogin'] = $Read->getResult()[0];
    else:
        unset($_SESSION['userLogin']);
    endif;
endif;

//GET PARAMETER URL
$getURL = strip_tags(trim(filter_input(INPUT_GET, 'url', FILTER_DEFAULT)));
$setURL = (empty($getURL) ? 'index' : $getURL);
$URL = explode('/', $setURL);
$SEO = new Seo($setURL);

//CHECK IF THIS POST ABLE TO AMP
if (APP_POSTS_AMP && (!empty($URL[0]) && $URL[0] == 'artigo') && file_exists(REQUIRE_PATH . '/amp.php')):
    $Read->ExeRead(DB_POSTS, "WHERE post_name = :name", "name={$URL[1]}");
    $PostAmp = ($Read->getResult()[0]['post_amp'] == 1 ? true : false);
endif;

//INSTANCE AMP (valid single article only)
if (APP_POSTS_AMP && (!empty($URL[0]) && $URL[0] == 'artigo') && file_exists(REQUIRE_PATH . '/amp.php') && (!empty($URL[2]) && $URL[2] == 'amp') && (!empty($PostAmp) && $PostAmp == true)):
    require REQUIRE_PATH . '/amp.php';
else:
?><!DOCTYPE html>
<html lang="pt-br" itemscope itemtype="https://schema.org/<?= $SEO->getSchema(); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="mit" content="2018-01-03T21:07:08-02:00+19935">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=0">

    <title><?= $SEO->getTitle(); ?></title>
    <meta name="description" content="<?= $SEO->getDescription(); ?>"/>
    <meta name="robots" content="index, follow"/>

    <link rel="base" href="<?= BASE; ?>"/>
    <link rel="canonical" href="<?= BASE; ?>/<?= $getURL; ?>"/>
    <?php
    if (APP_POSTS_AMP && (!empty($URL[0]) && $URL[0] == 'artigo') && file_exists(REQUIRE_PATH . '/amp.php') && (!empty($PostAmp) && $PostAmp == true)):
        echo '<link rel="amphtml" href="' . BASE . '/' . $getURL . '/amp" />' . "\r\n";
    endif;
    ?>
    <link rel="alternate" type="application/rss+xml" href="<?= BASE; ?>/rss.php"/>
    <link rel="sitemap" type="application/xml" href="<?= BASE; ?>/sitemap.xml"/>
    <?php
    if (SITE_SOCIAL_GOOGLE):
        echo '<link rel="author" href="https://plus.google.com/' . SITE_SOCIAL_GOOGLE_AUTHOR . '/posts"/>' . "\r\n";
        echo '            <link rel="publisher" href="https://plus.google.com/' . SITE_SOCIAL_GOOGLE_PAGE . '"/>' . "\r\n";
    endif;
    ?>

    <meta itemprop="name" content="<?= $SEO->getTitle(); ?>"/>
    <meta itemprop="description" content="<?= $SEO->getDescription(); ?>"/>
    <meta itemprop="image" content="<?= $SEO->getImage(); ?>"/>
    <meta itemprop="url" content="<?= BASE; ?>/<?= $getURL; ?>"/>

    <meta property="og:type" content="article"/>
    <meta property="og:title" content="<?= $SEO->getTitle(); ?>"/>
    <meta property="og:description" content="<?= $SEO->getDescription(); ?>"/>
    <meta property="og:image" content="<?= $SEO->getImage(); ?>"/>
    <meta property="og:url" content="<?= BASE; ?>/<?= $getURL; ?>"/>
    <meta property="og:site_name" content="<?= SITE_NAME; ?>"/>
    <meta property="og:locale" content="pt_BR"/>
    <?php
    if (SITE_SOCIAL_FB):
        echo '<meta property="article:author" content="https://www.facebook.com/' . SITE_SOCIAL_FB_AUTHOR . '" />' . "\r\n";
        echo '<meta property="article:publisher" content="https://www.facebook.com/' . SITE_SOCIAL_FB_PAGE . '" />' . "\r\n";

        if (SITE_SOCIAL_FB_APP):
            echo '<meta property="og:app_id" content="' . SITE_SOCIAL_FB_APP . '" />' . "\r\n";
        endif;

        if (SEGMENT_FB_PAGE_ID):
            echo '<meta property="fb:pages" content="' . SEGMENT_FB_PAGE_ID . '" />' . "\r\n";
        endif;
    endif;
    ?>

    <meta property="twitter:card" content="summary_large_image"/>
    <?php
    if (SITE_SOCIAL_TWITTER):
        echo '<meta property="twitter:site" content="@' . SITE_SOCIAL_TWITTER . '" />' . "\r\n";
    endif;
    ?>
    <meta property="twitter:domain" content="<?= BASE; ?>"/>
    <meta property="twitter:title" content="<?= $SEO->getTitle(); ?>"/>
    <meta property="twitter:description" content="<?= $SEO->getDescription(); ?>"/>
    <meta property="twitter:image" content="<?= $SEO->getImage(); ?>"/>
    <meta property="twitter:url" content="<?= BASE; ?>/<?= $getURL; ?>"/>

    <link type="image/x-icon" rel="shortcut icon" href="<?= INCLUDE_PATH; ?>/assets/images/favicon.png"/>
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,200,300,400,500,600,700,800" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=<?= SITE_FONT_NAME; ?>:<?= SITE_FONT_WHIGHT; ?>'
          rel='stylesheet' type='text/css'>
    <style>* {
            font-family: '<?= SITE_FONT_NAME; ?>', sans-serif;
        }</style>

    <link rel="stylesheet" href="<?= BASE; ?>/_cdn/bootcss/reset.css"/>
    <link rel="stylesheet" href="<?= BASE; ?>/_cdn/bootcss/fonticon.css"/>

    <!-- ******* CSS THEME ******* -->
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/assets/css/style.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/assets/css/responsive.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/assets/css/owl.carousel.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/assets/css/owl.theme.default.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/assets/css/magnific-popup.css">
    <link rel="stylesheet" href="<?= INCLUDE_PATH; ?>/assets/css/animate.css">

    <?php
    // MAIN STYLE THEME
    if (file_exists('themes/' . THEME . '/style.css')):
        echo '<link rel="stylesheet" href="' . INCLUDE_PATH . '/style.css"/>' . "\r\n";
    endif;

    if (APP_EAD):
        echo '<link rel="stylesheet" href="' . BASE . '/_ead/wc_ead.css"/>' . "\r\n";
    endif;

    //WC THEME CSS FILES
    if (file_exists("themes/" . THEME . "/wc_css")):
        foreach (scandir("themes/" . THEME . "/wc_css") as $wcCssThemeFiles) :
            if (file_exists("themes/" . THEME . "/wc_css/{$wcCssThemeFiles}") && !is_dir("themes/" . THEME . "/wc_css/{$wcCssThemeFiles}") && pathinfo("themes/" . THEME . "/wc_css/{$wcCssThemeFiles}")['extension'] == 'css'):
                echo '<link rel="stylesheet" href="' . INCLUDE_PATH . '/wc_css/' . $wcCssThemeFiles . '"/>';
            endif;
        endforeach;
    endif;
    ?>

    <?php
    // MAIN SCRIPT THEME
    if (file_exists('themes/' . THEME . '/scripts.js')):
        echo '<script src="' . INCLUDE_PATH . '/scripts.js"></script>' . "\r\n";
    endif;

    // WC THEME JS FILES
    if (file_exists("themes/" . THEME . "/wc_js")):
        foreach (scandir("themes/" . THEME . "/wc_js") as $wcJsThemeFiles):
            if (file_exists("themes/" . THEME . "/wc_js/{$wcJsThemeFiles}") && !is_dir("themes/" . THEME . "/wc_js/{$wcJsThemeFiles}") && pathinfo("themes/" . THEME . "/wc_js/{$wcJsThemeFiles}")['extension'] == 'js'):
                echo '            <script src="' . INCLUDE_PATH . '/wc_js/' . $wcJsThemeFiles . '"></script>' . "\r\n";
            endif;
        endforeach;
    endif;
    ?>
</head>
<body>
    <?php if ($URL[0] == 'index'): ?>
        <div class="page-wrapper">
    <?php elseif ($URL[0] == '404' || $URL[0] == 'coming_soon'): ?>
        <div class="wrapper1">
    <?php else: ?>
        <div class="page-wrapper blogpage3">
    <?php endif; ?>
    <!-- Preloader -->
    <div class="preloader"></div>
    <!-- Preloader -->
    <?php
    // MESSAGE MAINTENANCE FOR ADMIN
    if (ADMIN_MAINTENANCE && !empty($_SESSION['userLogin']['user_level']) && $_SESSION['userLogin']['user_level'] >= 6):
        echo "<div class='workcontrol_maintenance'>&#x267A; O MODO de manutenção está ativo. Somente administradores podem ver o site assim &#x267A;</div>";
    endif;

    // REDIRECT PUBLIC TO MAINTENANCE
    if (ADMIN_MAINTENANCE && (empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < 6)):
        require 'maintenance.php';
    else:

        // PESQUISA
        $Search = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        if ($Search && !empty($Search['s'])):
            $Search = urlencode(strip_tags(trim($Search['s'])));
            header('Location: ' . BASE . '/pesquisa/' . $Search);
            exit;
        endif;

        // HEADER
        if (file_exists(REQUIRE_PATH . "/inc/header.php")):
            require REQUIRE_PATH . "/inc/header.php";
        else:
            trigger_error('Crie Um Arquivo /inc/header.php Na Pasta do Tema!');
        endif;

        // CONTENT
        $URL[1] = (empty($URL[1]) ? null : $URL[1]);

        if ($URL[0] == 'rss' || $URL[0] == 'feed' || $URL[0] == 'rss.xml'):
            header("Location: " . BASE . "/rss.php");
            exit;
        endif;

        $Pages = array();
        $Read->FullRead("SELECT page_name FROM " . DB_PAGES);
        if ($Read->getResult()):
            foreach ($Read->getResult() as $SinglePage):
                $Pages[] = $SinglePage['page_name'];
            endforeach;
        endif;

        if (in_array($URL[0], $Pages) && file_exists(REQUIRE_PATH . '/pagina.php')):
            if (file_exists(REQUIRE_PATH . "/page-{$URL[0]}.php")):
                require REQUIRE_PATH . "/page-{$URL[0]}.php";
            else:
                require REQUIRE_PATH . '/pagina.php';
            endif;
        elseif (file_exists(REQUIRE_PATH . '/' . $URL[0] . '.php')):
            if ($URL[0] == 'artigos' && file_exists(REQUIRE_PATH . "/cat-{$URL[1]}.php")):
                require REQUIRE_PATH . "/cat-{$URL[1]}.php";
            else:
                require REQUIRE_PATH . '/' . $URL[0] . '.php';
            endif;
        elseif (file_exists(REQUIRE_PATH . '/' . $URL[0] . '/' . $URL[1] . '.php')):
            require REQUIRE_PATH . '/' . $URL[0] . '/' . $URL[1] . '.php';
        else:
            if (file_exists(REQUIRE_PATH . "/404.php")):
                require REQUIRE_PATH . '/404.php';
            else:
                trigger_error("Não Foi Possível Incluir o Arquivo themes/" . THEME . "/{$getURL}.php <b>(O Arquivo 404 Também Não Existe!)</b>");
            endif;
        endif;

        // FOOTER
        if (file_exists(REQUIRE_PATH . "/inc/footer.php")):
            require REQUIRE_PATH . "/inc/footer.php";
        else:
            trigger_error('Crie Um Arquivo /inc/footer.php Na Pasta do Tema!');
        endif;
    endif;

    // WC CODES
    $Read->ExeRead(DB_WC_CODE);
    if ($Read->getResult()):

        if (empty($Update)):
            $Update = new Update;
        endif;

        $ActiveCodes = filter_input(INPUT_GET, 'url', FILTER_DEFAULT);
        echo "\r\n\r\n\r\n<!--WorkControl Codes-->\r\n";
        foreach ($Read->getResult() as $HomeCodes):

            if (empty($HomeCodes['code_condition'])):
                echo $HomeCodes['code_script'];
                $UpdateCodes = ['code_views' => $HomeCodes['code_views'] + 1];
                $Update->ExeUpdate(DB_WC_CODE, $UpdateCodes, "WHERE code_id = :id", "id={$HomeCodes['code_id']}");
            elseif (preg_match("/" . str_replace("/", "\/", $HomeCodes['code_condition']) . "/", $ActiveCodes)):
                echo $HomeCodes['code_script'];
                $UpdateCodes = ['code_views' => $HomeCodes['code_views'] + 1];
                $Update->ExeUpdate(DB_WC_CODE, $UpdateCodes, "WHERE code_id = :id", "id={$HomeCodes['code_id']}");
            endif;
        endforeach;
        echo "\r\n<!--/WorkControl Codes-->\r\n\r\n\r\n";
    endif;

    if (!empty(SEGMENT_FB_PIXEL_ID)):
        require '_cdn/wc_track.php';
    endif;

    // GOOGLE ANALYTICS WITH DEFINE IN CONFIG
    if (!empty(SEGMENT_GL_ANALYTICS_UA)):
        echo "<script>(function (i, s, o, g, r, a, m) {i['GoogleAnalyticsObject'] = r;i[r] = i[r] || function () {(i[r].q = i[r].q || []).push(arguments)}, i[r].l = 1 * new Date();a = s.createElement(o),m = s.getElementsByTagName(o)[0];a.async = 1;a.src = g;m.parentNode.insertBefore(a, m)})(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');ga('create', '" . SEGMENT_GL_ANALYTICS_UA . "', 'auto');ga('send', 'pageview');</script>";
    endif;
    ?>    
    </div>
    <a href="#" class="scrollToTop" title="Voltar ao Topo!"><i class="fa fa-arrow-up" aria-hidden="true"></i></a>

<!-- ******* JS THEME ******* -->
<!-- jQuery -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/bootstrap.min.js"></script>
<!-- Scroll_To_Top -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/ScrollToPlugin.min.js"></script>
<!-- Classes_Portfolio -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/jquery.isotope.min.js"></script>
<!-- Carousel Slider -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/owl.carousel.js"></script>
<!-- Blog -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/jquery.magnific-popup.min.js"></script>
<!-- Classes_Portfolio -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/jquery.bxslider.min.js"></script>
<!-- Wow -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/wow.min.js"></script>
<!-- Global Init -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/custom.js"></script>
<!-- THEME AJAX -->
<script src="<?= INCLUDE_PATH; ?>/assets/js/scripts.js"></script>
</body>
</html>
<?php
endif;
ob_end_flush();

if (!file_exists('.htaccess')):
    $htaccesswrite = "# Habilita o Módulo de Reescrever URL\r\nRewriteEngine On\r\nOptions All -Indexes\r\n\r\n\r\n" .
        "# 1) Apenas Para Quem Tem Mais de 1 Domínio\r\n#RewriteOptions inherit\r\n#RewriteCond" .
        " %{HTTP_HOST} ^segundodominio\.com\.br$ [OR]\r\n#RewriteCond %{HTTP_HOST} ^www\.segundodominio\.com\.br$\r\n#RewriteRule ^/?$ 'https\:\/\/www\.principaldominio\.com\.br\/' [" .
        "R=301,L]\r\n\r\n\r\n# 2) WC FORÇAR PARA SER HTTPS\r\nRewriteCond %{HTTP:X-Forwarded-Proto} !https\r\nRewriteCond %{HTTPS} off\r\nRewriteRule ^ https://%{HTTP_HOST}%{REQUEST_URI} [" .
        "L,R=301]\r\n\r\n\r\n# 3) WC FORÇAR PARA TER WWW\r\n#RewriteCond %{HTTP_HOST} !^www\. [NC]\r\n#RewriteRule ^ https://www.%{HTTP_HOST}%{REQUEST_URI} [L,R=301]\r\n\r\n\r\n# 4) " .
        "REESCREVE URL PARA NÃO EXIBIR ARQUIVOS.PHP\r\n\r\nRewriteCond %{SCRIPT_FILENAME} !-f\r\nRewriteCond %{SCRIPT_FILENAME} !-d\r\nRewriteRule ^(.*)$ index.php?url=$1\r\n\r\n\r\n# 5) " .
        "PARTE DE OTIMIZAÇÃO E CACHE\r\n<FilesMatch 'index\.(html|htm)$'>\r\nAddDefaultCharset UTF-8\r\n<ifModule mod_headers.c>\r\nFileETag None\r\nHeader unset ETag\r\nHeader set " .
        "Cache-Control 'max-age=0, no-cache, no-store, must-revalidate'\r\nHeader set Pragma 'no-cache'\r\nHeader set Expires 'Mon, 29 Oct 1923 20:30:00 " .
        "GMT'\r\n</ifModule>\r\n</FilesMatch>\r\n# END WpFastestCache\r\n# BEGIN LBCWpFastestCache\r\n<FilesMatch " .
        "'\.(webm|ogg|mp4|ico|pdf|flv|jpg|jpeg|png|gif|webp|js|css|swf|x-html|css|xml|js|woff|woff2|ttf|svg|eot)(\.gz)?$'>\r\n<IfModule mod_expires.c>\r\nAddType application/font-woff2 " .
        ".woff2\r\nExpiresActive On\r\nExpiresDefault A0\r\nExpiresByType video/webm A10368000\r\nExpiresByType video/ogg A10368000\r\nExpiresByType video/mp4 A10368000\r\nExpiresByType " .
        "image/webp A10368000\r\nExpiresByType image/gif A10368000\r\nExpiresByType image/ico A10368000\r\nExpiresByType image/svg+xml A10368000\r\nExpiresByType text/css " .
        "A10368000\r\nExpiresByType text/javascript A10368000\r\nExpiresByType application/javascript A10368000\r\nExpiresByType application/x-javascript A10368000\r\nExpiresByType " .
        "application/font-woff2 A10368000\r\n</IfModule>\r\n<IfModule mod_headers.c>\r\nHeader set Expires 'max-age=A10368000, public'\r\nHeader unset ETag\r\nHeader set Connection " .
        "keep-alive\r\nFileETag None\r\n</IfModule>\r\n</FilesMatch>\r\n\r\n\r\n" .
        "# 6) Em Caso de Página Não Existente Manda Para a 404\r\nErrorDocument 404 /themes/tema/404.php";
    $htaccess = fopen('.htaccess', "w");
    fwrite($htaccess, str_replace("'", '"', $htaccesswrite));
    fclose($htaccess);
endif;
