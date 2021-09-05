<?php
$AdminLevel = LEVEL_WC_CLASSES;
if (!APP_CLASSES || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você Não Está Logado<br>Ou Não Tem Permissão Para Acessar Essa Página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-power">Classes</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="Todos as Classes" href="dashboard.php?wc=classes/home">Classes</a>
        </p>
    </div>

    <div class="dashboard_header_search">
        <a title="Nova Classe" href="dashboard.php?wc=classes/create" class="btn_header btn_darkgreen icon-plus">Nova Classe</a>
    </div>
</header>

<div class="dashboard_content">
    <?php
    $getPage = filter_input(INPUT_GET, 'pg', FILTER_VALIDATE_INT);
    $Page = ($getPage ? $getPage : 1);
    $Paginator = new Pager("dashboard.php?wc=classes/home&pg=", '<<', '>>', 5);
    $Paginator->ExePager($Page, 12);

    $Read->FullRead("SELECT * FROM " . DB_CLASSES . " WHERE 1=1 "
        . "ORDER BY class_status ASC, class_datecreate DESC "
        . "LIMIT :limit OFFSET :offset", "limit={$Paginator->getLimit()}&offset={$Paginator->getOffset()}");

    if (!$Read->getResult()):
        $Paginator->ReturnPage();
        echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existe Classes Cadastradas. Comece Agora Mesmo Cadastrando Sua Primeira Classe!</span>", E_USER_NOTICE);
    else:
        foreach ($Read->getResult() as $CLASS):
            extract($CLASS);

            $ClassImage = (file_exists("../uploads/{$class_image}") && !is_dir("../uploads/{$class_image}") ? "uploads/{$class_image}" : 'admin/_img/no_image.jpg');
            $class_title = (!empty($class_title) ? $class_title : 'Edite Esse Rascunho Para Exibir as Informações da Classe!');

            echo "<article class='box box25 post_single js-rel-to' id='{$class_id}'>           
                <div class='post_single_cover'>
                    <img alt='{$class_title}' title='{$class_title}' src='../tim.php?src={$ClassImage}&w=" . IMAGE_W / 2 . "&h=" . IMAGE_H / 2 . "'/>
                </div>
                <div class='post_single_content wc_normalize_height'>
                    <h1 class='title icon-power'>{$class_title}</h1>
                    <p class='post_single_cat icon-pencil'>" . Check::Words($class_content, 15) . "</p>
                </div>
                <div class='post_single_actions'>
                    <a title='Editar Classe' href='dashboard.php?wc=classes/create&id={$class_id}' class='post_single_center icon-pencil icon-notext btn_header btn_darkgreen'></a>
                    <span title='Excluir Classe' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete' id='{$class_id}'></span>
                </div>
            </article>";
        endforeach;

        $Paginator->ExePaginator(DB_CLASSES);
        echo $Paginator->getPaginator();
    endif;
    ?>
</div>