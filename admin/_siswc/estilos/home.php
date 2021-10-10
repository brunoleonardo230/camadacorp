<?php
$AdminLevel = LEVEL_WC_STYLES;
if (!APP_STYLES || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você Não Está Logado<br>Ou Não Tem Permissão Para Acessar Essa Página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-magic-wand">Estilos</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="Todos os Estilos" href="dashboard.php?wc=estilos/home">Estilos</a>
        </p>
    </div>
    
    <div class="dashboard_header_search">
        <a title="Novo Estilo" href="dashboard.php?wc=estilos/create" class="btn_header btn_purple icon-plus">Novo Estilo</a>
    </div>
</header>

<div class="dashboard_content">
    <?php
    $getPage = filter_input(INPUT_GET, 'pg', FILTER_VALIDATE_INT);
    $Page = ($getPage ? $getPage : 1);
    $Paginator = new Pager("dashboard.php?wc=estilos/home&pg=", '<<', '>>', 5);
    $Paginator->ExePager($Page, 12);

    $Read->FullRead("SELECT * FROM " . DB_STYLES . " WHERE 1=1 "
            . "ORDER BY style_status ASC, style_datecreate DESC "
            . "LIMIT :limit OFFSET :offset", "limit={$Paginator->getLimit()}&offset={$Paginator->getOffset()}");
            
    if (!$Read->getResult()):
        $Paginator->ReturnPage();
        echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existe Estilos Cadastrados. Comece Agora Mesmo Cadastrando Seu Primeiro Estilo!</span>", E_USER_NOTICE);
    else:
        foreach ($Read->getResult() as $STYLES):
            extract($STYLES);

            $StyleImage = (file_exists("../uploads/{$style_cover}") && !is_dir("../uploads/{$style_cover}") ? "uploads/{$style_cover}" : 'admin/_img/no_image.jpg');
            $style_title = (!empty($style_title) ? $style_title : 'Edite Esse Rascunho Para Exibir as Informações do Estilo!');

            echo "<article class='box box25 post_single js-rel-to' id='{$style_id}'>           
                <div class='post_single_cover'>
                    <img alt='{$style_title}' title='{$style_title}' src='../tim.php?src={$StyleImage}&w=" . IMAGE_W / 2 . "&h=" . IMAGE_H / 2 . "'/>
                </div>
                <div class='post_single_content wc_normalize_height'>
                    <h1 class='title icon-magic-wand'>{$style_title}</h1>
                    <p class='post_single_cat icon-pencil'>" . Check::Words($style_content, 15) . "</p>
                </div>
                <div class='post_single_actions'>
                    <a title='Editar Estilo' href='dashboard.php?wc=estilos/create&id={$style_id}' class='post_single_center icon-pencil icon-notext btn_header btn_purple'></a>
                    <span title='Excluir Estilo' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Styles' callback_action='delete' id='{$style_id}'></span>
                </div>
            </article>";
        endforeach;

        $Paginator->ExePaginator(DB_STYLES); 
        echo $Paginator->getPaginator();
    endif;
    ?>
</div>