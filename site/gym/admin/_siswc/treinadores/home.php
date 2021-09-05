<?php
$AdminLevel = LEVEL_WC_TRAINEES;
if (!APP_TRAINEES || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você Não Está Logado<br>Ou Não Tem Permissão Para Acessar Essa Página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

$Read->ExeRead(DB_TRAINEES);
$Trainees = $Read->getResult();
$Total = count($Trainees);
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-user">Treinadores</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="Todos os Treinadores" href="dashboard.php?wc=treinadores/home">Treinadores</a>
        </p>
    </div>
    
    <div class="dashboard_header_search">
        <a title="Novo Treinador" href="dashboard.php?wc=treinadores/create" class="btn_header btn_darkgreen icon-plus">Novo Treinador</a>
    </div>
</header>

<div class="bs_ajax_modal js-marketing-mail" style="display: none;">
    <div class="bs_ajax_modal_box">
        <p class="bs_ajax_modal_title darkgreen"><span class="icon-envelop">Nova Mensagem</span></p>
        <span title="Fechar" class="bs_ajax_modal_close icon-cross icon-notext js-modal-close" data-modal="js-marketing-mail"></span>
        <div class="bs_ajax_modal_content scrollbar">        

            <form method="post">
                <input type="hidden" name="callback" value="Trainees"/>
                <input type="hidden" name="callback_action" value="send"/>
                <input class="js-total-users" type="hidden" value="<?= $Total; ?>"/>
                <input class="js-users-checked" type="hidden" name="trainees" value=""/>
    
                <div class="modal__wrapper">
                    <div class="modal__label">
                        <span class="modal__group">
                            <i class="icon-user icon-notext modal__icon"></i>
                        </span>
    
                        <span class="modal__count js-modal-toggle">
                            Selecione o(s) Treinador(es)
                        </span>
    
                        <div class="modal__message js-modal-message">
                            <input class="modal__search js-modal-search" type="text" placeholder="Pesquisar">
    
                            <div class="modal__buttons">
                                <button class="modal__mark js-modal-mark" type="button">Marcar Todos</button>
                                <button class="modal__unmark js-modal-unmark" type="button">Desmarcar Todos</button>
                            </div>
    
                            <div class="modal__users">
                                <p class="modal__legend">Treinadores</p>
    
                                <ul class="modal__list js-modal-content">
                                    <?php foreach ($Trainees as $Trainee):
                                        extract($Trainee); ?>
                                        <li class="modal__item">
                                            <span class="modal__link js-user-toggle" data-name="<?= $trainee_name; ?>" data-id="<?= $trainee_id; ?>">
                                                <?= $trainee_name; ?> <i class="icon-checkmark icon-notext modal__check"></i>
                                            </span>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
    
                    <label class="modal__label">
                        <span class="modal__group">
                            <i class="icon-pencil icon-notext modal__icon"></i>
                        </span>
    
                        <input class="modal__field" type="text" name="subject" placeholder="Assunto da Mensagem">
                    </label>
    
                    <label class="modal__label">
                        <textarea name="body" class="work_mce_basic" rows="10"></textarea>
                    </label>
                </div>
    
                <div class="wc_actions" style="text-align: right;">
                    <button title="ENVIAR" name="public" value="1" class="btn_big btn_purple_brown icon-share">ENVIAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
                </div>
            </form>
        </div>
                            
        <div class="bs_ajax_modal_footer">
            <p>Escolha os Treinadores e Envie o E-mail Com a Mensagem Desejada!</p>
        </div>    
        <div class="clear"></div>
    </div>
</div>
<!-- FECHA MODAL DE ENVIO DE E-MAIL -->    


<div class="dashboard_content">
    <div class="marketing">
        <div class="marketing__box">
            <form class="marketing__filter" autocomplete="off">
                <label class="marketing__search">
                    <input class="js-marketing-search" type="search" name="search" placeholder="Digite o Nome ou E-mail do Treinador..."/>

                    <button title="Pesquisar" type="button">
                        <i class="icon-search icon-notext j-marketing-load"></i>
                    </button>
                </label>
                
                <button title="Enviar E-mail" class="marketing__selected js-modal-open" type="button" data-modal="js-marketing-mail">
                    <i class="icon-envelop icon-notext"></i>
                </button>

                <div class="marketing__pagination">
                    <button title="Anterior" class="js-marketing-back" type="button" data-offset="0">
                        <i class="icon-arrow-left icon-notext"></i>
                    </button>

                    <button title="Recarregar" class="js-marketing-initial" type="button" data-offset="0">
                        <i class="icon-radio-checked icon-notext"></i>
                    </button>

                    <button title="Próximo" class="js-marketing-next" type="button" data-offset="0">
                        <i class="icon-arrow-right icon-notext"></i>
                    </button>
                </div>
            </form>

            <div class="marketing__content">

                <article class="marketing__table marketing__table--header">
                    <div class="marketing__data">
                        <p></p>
                        <p>Nome</p>
                        <p>E-mail</p>
                        <p>Telefone</p>
                        <p>Ações</p>
                    </div>
                </article>

                <div class="js-marketing-content">
                    <?php
                    $Read->ExeRead(DB_TRAINEES, 'LIMIT :limit OFFSET :offset', 'limit=10&offset=0');
                    $Trainees = $Read->getResult();
  
                    if (!$Read->getResult()):
                        echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Treinadores Cadastrados. Comece Agora Mesmo Cadastrando o Primeiro Treinador(a)!</span>", E_USER_NOTICE);
                    else:
                        foreach ($Trainees as $Trainee):
                            extract($Trainee);
                            
                            if(empty($trainee_cover) && $trainee_genre == 1):
                                $TraineeImage = "../tim.php?src=admin/_img/avatarm.png&w=40&h=40";
                            elseif(empty($trainee_cover) && $trainee_genre == 2):
                                $TraineeImage = "../tim.php?src=admin/_img/avatarf.png&w=40&h=40";
                            else:
                                $TraineeImage = BASE . "/tim.php?src=uploads/{$trainee_cover}&w=40&h=40";
                            endif;

                            $TraineeLink = "dashboard.php?wc=treinadores/create&id={$trainee_id}";
        
                            echo "<article class='marketing__table js-marketing-table js-rel-to' id='{$trainee_id}'> <div class='marketing__data'> <p class='payment'> <span class='img'> <img src='{$TraineeImage}'/> </span> </p> <p>" . Check::Chars($trainee_name, 25) . "</p> <p class='icon-envelop'>" . Check::Chars($trainee_email, 25) . "</p> <p class='icon-phone'>{$trainee_cell}</p> <p> <a title='Editar Treinador' class='btn_header btn_darkgreen icon-pencil icon-notext' href='{$TraineeLink}'></a> <span title='Excluir Barbeiro' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Trainees' callback_action='delete' id='{$trainee_id}'></span> </p> </div> </article>";
                        endforeach;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>