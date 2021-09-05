<?php
$AdminLevel = LEVEL_WC_OFFERS;
if (!APP_OFFERS || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você Não Está Logado<br>Ou Não Tem Permissão Para Acessar Essa Página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-cart">Ofertas</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="Todas as Ofertas" href="dashboard.php?wc=ofertas/home">Ofertas</a>
        </p>
    </div>
    
    <div class="dashboard_header_search">
        <a title="Nova Oferta" href="dashboard.php?wc=ofertas/create" class="btn_header btn_darkgreen icon-plus">Nova Oferta</a>
    </div>
</header>

<div class="dashboard_content">
    <?php
    $getPage = filter_input(INPUT_GET, 'pg', FILTER_VALIDATE_INT);
    $Page = ($getPage ? $getPage : 1);
    $Paginator = new Pager("dashboard.php?wc=ofertas/home&pg=", '<<', '>>', 5);
    $Paginator->ExePager($Page, 12);

    $Read->FullRead("SELECT * FROM " . DB_OFFERS . " WHERE 1=1 "
            . "ORDER BY offer_status ASC, offer_datecreate DESC "
            . "LIMIT :limit OFFSET :offset", "limit={$Paginator->getLimit()}&offset={$Paginator->getOffset()}");
            
    if (!$Read->getResult()):
        $Paginator->ReturnPage();
        echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Ofertas Cadastrados. Comece Agora Mesmo Cadastrando Sua Primeira Oferta!</span>", E_USER_NOTICE);
    else:
        foreach ($Read->getResult() as $OFFERS):
            extract($OFFERS);

            $OfferImage = (file_exists("../uploads/{$offer_image}") && !is_dir("../uploads/{$offer_image}") ? "uploads/{$offer_image}" : 'admin/_img/no_image.jpg');
            $offer_title = (!empty($offer_title) ? $offer_title : 'Edite Esse Rascunho Para Exibir as Informações da Oferta!');

            echo "<article class='box box25 post_single js-rel-to' id='{$offer_id}'>           
                <div class='post_single_cover'>
                    <img alt='{$offer_title}' title='{$offer_title}' src='../tim.php?src={$OfferImage}&w=" . IMAGE_W / 2 . "&h=" . IMAGE_H / 2 . "'/>
                </div>
                <div class='post_single_content wc_normalize_height'>
                    <h1 class='title icon-cart'>{$offer_title}</h1>
                    <p class='post_single_cat icon-pencil'>" . Check::Words($offer_content, 15) . "</p>
					<p class='post_single_cat icon-coin-dollar'>" . number_format($offer_price, 2, ',', '.') . "</p>
                </div>
                <div class='post_single_actions'>
                    <a title='Editar Oferta' href='dashboard.php?wc=ofertas/create&id={$offer_id}' class='post_single_center icon-pencil icon-notext btn_header btn_darkgreen'></a>
                    <span title='Excluir Oferta' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Offers' callback_action='delete' id='{$offer_id}'></span>
                </div>
            </article>";
        endforeach;

        $Paginator->ExePaginator(DB_OFFERS); 
        echo $Paginator->getPaginator();
    endif;
    ?>
</div>