<?php
$AdminLevel = LEVEL_WC_PLANS;
if (!APP_PLANS || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você Não Está Logado<br>Ou Não Tem Permissão Para Acessar Essa Página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Create)):
    $Create = new Create;
endif;

$PlanId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($PlanId):
    $Read->ExeRead(DB_PLANS, "WHERE plan_id = :id", "id={$PlanId}");
    if ($Read->getResult()):
        $FormData = array_map('htmlspecialchars', $Read->getResult()[0]);
        extract($FormData);
    else:
        $_SESSION['trigger_controll'] = "<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Um Plano Que Não Existe ou Que Foi Removido Recentemente!";
        header('Location: dashboard.php?wc=planos/home');
    endif;
else:
    $PlanCreate = ['plan_datecreate' => date('Y-m-d H:i:s')];
    $Create->ExeCreate(DB_PLANS, $PlanCreate);
    header('Location: dashboard.php?wc=planos/create&id=' . $Create->getResult());
endif;
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-credit-card">Planos</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=planos/home">Planos</a>
        </p>
    </div>
    
    <div class="dashboard_header_search" style="font-size: 0.875em; margin-top: 16px;">
        <a title="Voltar" class="btn_header btn_darkgreen icon-undo2" href="dashboard.php?wc=planos/home">Voltar</a>
    </div>
</header>

<div class="dashboard_content">
    <div class="box box70">
        <article class="wc_tab_target wc_active" id="info">
            <form class="auto_save" name="create_plan" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="callback" value="Plans"/>
                <input type="hidden" name="callback_action" value="manager"/>
                <input type="hidden" name="plan_id" value="<?= $PlanId; ?>"/>

                <div class="panel_header darkgreen">
                    <h2 class="icon-credit-card">Dados Sobre o Plano</h2>
                </div>
                <div class="panel">
                    <label class="label">
                        <span class="legend">Capa: (JPG <?= IMAGE_W; ?>x<?= IMAGE_H; ?>px)</span>
                        <input type="file" class="wc_loadimage" name="plan_image"/>
                    </label>

                    <label class="label">
                        <span class="legend">Nome do Plano:</span>
                        <input name="plan_title" style="font-size: 1.2em;" value="<?= $plan_title; ?>" placeholder="Informe o Nome do Plano" required/>
                    </label>

                    <label class="label">
                        <span class="legend">Preço do Plano:</span>
                        <input name="plan_price" class="mask-money" value="<?= (!empty($plan_price) ? number_format($plan_price, 2, ',', '.') : null); ?>" placeholder="Informe o Preço do Plano"/>
                    </label>

                    <!-- <label class="label">
                        <span class="legend">Categoria:</span>
                        <select name="plan_category">

                        </select>
                    </label> -->

                    <label class="label">
                        <span class="legend">Recomendado?</span>
                        <select name="plan_recommended" required>
                            <option selected disabled value="">Plano é o Recomendado?</option>
                            <option value="1" <?= ($plan_recommended == 1 ? 'selected="selected"' : ''); ?>>Sim</option>
                            <option value="2" <?= ($plan_recommended == 2 ? 'selected="selected"' : ''); ?>>Não</option>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">Descrição do Plano:</span>
                        <textarea class="work_mce" rows="50" name="plan_content"><?= $plan_content; ?></textarea>
                    </label>

                    <div class="m_top">&nbsp;</div>
                    <div class="wc_actions" style="text-align: center">
                        <button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>

                        <div class="switch__container" style="margin-bottom: 10px;">
                          <input value='1' id="switch-shadow" class="switch switch--shadow" type="checkbox" name='plan_status' <?= ($plan_status == 1 ? 'checked' : ''); ?>>
                          <label for="switch-shadow"></label>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>    
        </article>
        
        <article class="wc_tab_target ds_none" id="benefits">
            <div class="panel_header darkgreen">
                <span>
                    <a href="#" title='Novo Benefício' class="btn_header btn_green icon-plus icon-notext j_create_benefits_modal" data-modal=".js-benefits"></a>
                </span>
                <h2 class="icon-list2">Benefícios do Plano</h2>
            </div>
            <div class="panel" id="plans-benefits">
                <?php
                $Read->ExeRead(DB_PLANS_BENEFITS, "WHERE plan_id = :plan ORDER BY plan_benefits_datecreate DESC, plan_benefits_title ASC", "plan={$plan_id}");
                if (!$Read->getResult()):
                    echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Perguntas Cadastradas Sobre a Empresa. Comece Agora Mesmo Cadastrando a Primeira Pergunta!</span>", E_USER_NOTICE);
                else:
                    foreach ($Read->getResult() as $BENEFITS):
                        extract($BENEFITS);
                        echo "<div class='single_user_addr js-rel-to' id='{$plan_benefits_id}'>
                            <h1 class='icon-list2'>{$plan_benefits_title}</h1>
                            <p class='icon-coin-dollar'>" . number_format($plan_benefits_price, 2, ',', '.') . "</p>
                            <div class='single_user_addr_actions'>
                                <span title='Editar Benefício' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_benefits_modal' callback='Plans' callback_action='edit' id='{$plan_benefits_id}'></span>
                                <span title='Excluir Benefício' class='j_delete_action icon-cancel-circle icon-notext btn_header btn_red' callback='Plans' callback_action='delete_plan_benefits' id='{$plan_benefits_id}'></span>
                                </div>
                            </div>";    
                    endforeach;
                endif;
                ?>
            </div>
            <div class="clear"></div>
            
            <!-- MODAL DE BENEFICÍOS DO PLANO -->
            <div class="bs_ajax_modal js-benefits" style="display: none;">
                <div class="bs_ajax_modal_box">
                    <p class="bs_ajax_modal_title darkgreen"><span class="icon-info">Cadastrar Benefício</span></p>
                    <span title="Fechar" class="bs_ajax_modal_close icon-cross icon-notext j_close_modal" data-modal=".js-benefits"></span>
                    <div class="bs_ajax_modal_content scrollbar">
                        <form name="plan_benefits_create_modal" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="callback" value="Plans"/>
                            <input type="hidden" name="callback_action" value="create_benefits"/>
                            <input type="hidden" name="plan_id" value="<?= $PlanId; ?>"/>
                            <input type="hidden" name="plan_benefits_id" value=""/>
                            
                            <div class="label_100">
                                <label class="label">
                                    <span class="legend">Benefício:</span>
                                    <input style="font-size: 1em;" type="text" name="plan_benefits_title" value="" placeholder="Informe o Benefício:" required/>
                                </label>
                                
                                <label class="label">
                                    <span class="legend">Preço:</span>
                                    <input class="mask-money" style="font-size: 1em;" type="text" name="plan_benefits_price" value="" placeholder="Informe o Preço:"/>
                                </label>
                            </div>    
                                
                            <div class="wc_actions" style="text-align: right">
                                <button title="ENVIAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ENVIAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
                            </div>
                        </form>
                    </div>
                            
                    <div class="bs_ajax_modal_footer">
                        <p>Cadastre o Benefício e o Preço Para Que Apareça Em Seu Site!</p>
                    </div>    
                    <div class="clear"></div>
                </div>
            </div>
            <!-- FECHA MODAL DE BENEFICÍOS DO PLANO -->
            
        </article>
    </div>
    
    <div class="box box30">
        <div class="panel_header green">
            <h2 class="icon-image">Imagem do Plano</h2>
        </div>
        <?php
        $Image = (file_exists("../uploads/{$plan_image}") && !is_dir("../uploads/{$plan_image}") ? "uploads/{$plan_image}" : 'admin/_img/no_image.jpg');
        ?>
        <img class="plan_image" style="width: 100%;" src="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>" alt="" title=""/>
        
        <div class="box_conf_menu no_icon" style="margin-top: 0;">
            <div class="panel">
                <a class='conf_menu wc_tab wc_active' href='#info'><span class="icon-credit-card">Informações</span></a>
                <a class='conf_menu wc_tab' href='#benefits'><span class="icon-list2">Benefícios</span></a>
            </div>    
        </div>
    </div>
</div>