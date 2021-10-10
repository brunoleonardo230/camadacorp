<?php
$AdminLevel = LEVEL_WC_PLANS;
if (!APP_PLANS || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você Não Está Logado<br>Ou Não Tem Permissão Para Acessar Essa Página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-credit-card">Planos</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="Todas os Planos" href="dashboard.php?wc=planos/home">Planos</a>
        </p>
    </div>
    
    <div class="dashboard_header_search">
        <a title="Novo Plano" href="dashboard.php?wc=planos/create" class="btn_header btn_darkgreen icon-plus">Novo Plano</a>
    </div>
</header>

<div class="dashboard_content">
    <?php
    $getPage = filter_input(INPUT_GET, 'pg', FILTER_VALIDATE_INT);
    $Page = ($getPage ? $getPage : 1);
    $Paginator = new Pager("dashboard.php?wc=planos/home&pg=", '<<', '>>', 5);
    $Paginator->ExePager($Page, 12);

    $Read->FullRead("SELECT * FROM " . DB_PLANS . " WHERE 1=1 "
            . "ORDER BY plan_status ASC, plan_datecreate DESC "
            . "LIMIT :limit OFFSET :offset", "limit={$Paginator->getLimit()}&offset={$Paginator->getOffset()}");
            
    if (!$Read->getResult()):
        $Paginator->ReturnPage();
        echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existe Planos Cadastrados. Comece Agora Mesmo Cadastrando Seu Primeiro Plano!</span>", E_USER_NOTICE);
    else:
        foreach ($Read->getResult() as $PLANS):
            extract($PLANS);

            $PlanImage = (file_exists("../uploads/{$plan_image}") && !is_dir("../uploads/{$plan_image}") ? "uploads/{$plan_image}" : 'admin/_img/no_image.jpg');
            $plan_title = (!empty($plan_title) ? $plan_title : 'Edite Esse Rascunho Para Exibir as Informações do Plano!');

            echo "<article class='box box25 post_single js-rel-to' id='{$plan_id}'>           
                <div class='post_single_cover'>
                    <img alt='{$plan_title}' title='{$plan_title}' src='../tim.php?src={$PlanImage}&w=" . IMAGE_W / 2 . "&h=" . IMAGE_H / 2 . "'/>
                </div>
                <div class='post_single_content wc_normalize_height'>
                    <h1 class='title icon-credit-card'>{$plan_title}</h1>
                    <p class='post_single_cat icon-pencil'>" . Check::Chars($plan_content, 30) . "</p>
					<p class='post_single_cat icon-coin-dollar'>{$plan_price}</p>
                </div>
                <div class='post_single_actions'>
                    <a title='Editar Plano' href='dashboard.php?wc=planos/create&id={$plan_id}' class='post_single_center icon-pencil icon-notext btn_header btn_darkgreen'></a>
                    <span title='Excluir Plano' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Plans' callback_action='delete' id='{$plan_id}'></span>
                </div>
            </article>";
        endforeach;

        $Paginator->ExePaginator(DB_PLANS); 
        echo $Paginator->getPaginator();
    endif;
    ?>
</div>