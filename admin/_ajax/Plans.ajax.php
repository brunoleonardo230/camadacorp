<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_PLANS;

if (!APP_PLANS || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['alert'] = ["red", "wondering2", "OPSSS", "Você Não Tem Permissão Para Essa Ação ou Não Está Logado Como Administrador!"];
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Plans';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    // AUTO INSTANCE OBJECT READ
    if (empty($Read)):
        $Read = new Read;
    endif;

    // AUTO INSTANCE OBJECT CREATE
    if (empty($Create)):
        $Create = new Create;
    endif;

    // AUTO INSTANCE OBJECT UPDATE
    if (empty($Update)):
        $Update = new Update;
    endif;
    
    // AUTO INSTANCE OBJECT DELETE
    if (empty($Delete)):
        $Delete = new Delete;
    endif;

    //SELECIONA AÇÃO
    switch ($Case):
        //GERENCIA PLANOS
        case 'manager':
            $PlanId = $PostData['plan_id'];
            unset($PostData['plan_id']);

            $Read->ExeRead(DB_PLANS, "WHERE plan_id = :id", "id={$PlanId}");
            $ThisPlan = $Read->getResult()[0];
            
            $PlanName = (!empty($PostData['plan_name']) ? $PostData['plan_name'] : $PostData['plan_title']);
            $PostData['plan_name'] = Check::Name($PlanName);
            $Read->FullRead("SELECT plan_name FROM " . DB_PLANS . " WHERE plan_name = :nm AND plan_id != :id", "nm={$PostData['plan_name']}&id={$PlanId}");
            if ($Read->getResult()):
                $PostData['plan_name'] = "{$PostData['plan_name']}-{$PlanId}";
            endif;
            $jSON['name'] = $PostData['plan_name'];

            if (!empty($_FILES['plan_image'])):
                $File = $_FILES['plan_image'];

                if ($ThisPlan['plan_image'] && file_exists("../../uploads/{$ThisPlan['plan_image']}") && !is_dir("../../uploads/{$ThisPlan['plan_image']}")):
                    unlink("../../uploads/{$ThisPlan['plan_image']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['plan_name'] . '-' . time(), IMAGE_W, 'planos');
                if ($Upload->getResult()):
                    $PostData['plan_image'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG Ou PNG Para Enviar Como Capa!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['plan_image']);
            endif;

            $PostData['plan_datecreate'] = (!empty($PostData['plan_datecreate']) ? Check::Data($PostData['plan_datecreate']) : date('Y-m-d H:i:s'));

            $Update->ExeUpdate(DB_PLANS, $PostData, "WHERE plan_id = :id", "id={$PlanId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Plano <b>{$PostData['plan_title']}</b> Foi Atualizado Com Sucesso!"];
            break;
            
        //DELETE
        case 'delete':
            $PostData['plan_id'] = $PostData['del_id'];
            $Read->FullRead("SELECT plan_image FROM " . DB_PLANS . " WHERE plan_id = :ps", "ps={$PostData['plan_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['plan_image']}") && !is_dir("../../uploads/{$Read->getResult()[0]['plan_image']}")):
                unlink("../../uploads/{$Read->getResult()[0]['plan_image']}");
            endif;

            $Delete->ExeDelete(DB_PLANS, "WHERE plan_id = :id", "id={$PostData['plan_id']}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Plano Foi Excluído Com Sucesso!"];
            break;        
            
        //CADASTRA BENEFÍCIOS
        case 'create_benefits':
            $PlanId = $PostData['plan_id'];
            unset($PostData['plan_id']);
            
            if (empty($PostData['plan_benefits_title'])):
                $jSON['alert'] = ["yellow", "warning", "OPSSS {$_SESSION['userLogin']['user_name']}", "Para Cadastrar Um Benefício, é Preciso Informar o Título. Por Favor, Tente Novamente!"];
            else:
                if (empty($PostData['plan_benefits_id'])):
                    //Realiza Cadastro
                    $PostData['plan_id'] = $PlanId;
                    $PostData['plan_benefits_datecreate'] = date("Y-m-d H:i:s");
                    $Create->ExeCreate(DB_PLANS_BENEFITS, $PostData);

                    //Realtime
                    $jSON['add_content'] = null;

                    $Read->ExeRead(DB_PLANS_BENEFITS, "WHERE plan_benefits_id = :id", "id={$Create->getResult()}");
                    if ($Read->getResult()):
                        extract($Read->getResult()[0]);

                        $jSON['add_content'] = ['#plans-benefits' => "<div class='single_user_addr js-rel-to' id='{$plan_benefits_id}'> <h1 class='icon-list2'>{$plan_benefits_title}</h1> <p class='icon-coin-dollar'>" . number_format($plan_benefits_price, 2, ',', '.') . "</p> <div class='single_user_addr_actions'> <span title='Editar Benefício' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_benefits_modal' callback='Plans' callback_action='edit' id='{$plan_benefits_id}'></span> <span title='Excluir Benefício' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Plans' callback_action='delete_benefits' id='{$plan_benefits_id}'></span></div></div>"];
                    endif;

                    $divremove = [".js-trigger", ".js-benefits"];
                    $jSON['divremove'] = $divremove;
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Benefício do Plano Foi Cadastrado Com Sucesso!"];
                else:
                    $BenefitsId = $PostData['plan_benefits_id'];
                    unset($PostData['plan_benefits_id']);
                    $Update->ExeUpdate(DB_PLANS_BENEFITS, $PostData, "WHERE plan_benefits_id = :id", "id={$BenefitsId}");

                    //RealTime
                    $jSON['divcontent']['#plans-benefits'] = null;
    
                    $Read->ExeRead(DB_PLANS_BENEFITS, "ORDER BY plan_benefits_datecreate DESC");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $BENEFITS):
                            extract($BENEFITS);
                            
                            $jSON['divcontent']['#plans-benefits'] .= "<div class='single_user_addr js-rel-to' id='{$plan_benefits_id}'> <h1 class='icon-list2'>{$plan_benefits_title}</h1> <p class='icon-coin-dollar'>" . number_format($plan_benefits_price, 2, ',', '.') . "</p> <div class='single_user_addr_actions'> <span title='Editar Benefício' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_benefits_modal' callback='Plans' callback_action='edit' id='{$plan_benefits_id}'></span> <span title='Excluir Benefício' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Plans' callback_action='delete_benefits' id='{$plan_benefits_id}'></span></div></div>";
    
                        endforeach;
                    endif;
                    $jSON['divremove'] = ".js-benefits";
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Benefício do Plano Foi Atualizado Com Sucesso!"];
                endif;
            endif;
            break;
        
		//EDITA BENEFÍCIOS		
        case 'edit_benefits':
            $BenefitsId = $PostData['edit_id'];
            $Read->ExeRead(DB_PLANS_BENEFITS, "WHERE plan_benefits_id = :id", "id={$BenefitsId}");
            if ($Read->getResult()):
                $jSON['data'] = $Read->getResult()[0];
                $jSON['data']['plan_benefits_price'] = number_format($jSON['data']['plan_benefits_price'], 2, ',', '.');

            else:
                $jSON['alert'] = ["red", "wondering2", "ERRO", "Você Tentou Editar Um Benefício Que Não Existe Ou Foi Removido!"];
            endif;
            break;

		//DELETA BENEFÍCIOS
        case 'delete_plan_benefits':
            $BenefitsDel = $PostData['del_id'];
            $Delete->ExeDelete(DB_PLANS_BENEFITS, "WHERE plan_benefits_id = :id", "id={$BenefitsDel}");
            $jSON['success'] = true;
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Benefício do Plano Foi Excluído Com Sucesso!"];
            break;	
    endswitch;

    //RETORNA O CALLBACK
    if ($jSON):
        echo json_encode($jSON);
    else:
        $jSON['alert'] = ["red", "wondering2", "Desculpe {$_SESSION['userLogin']['user_name']}", "Uma Ação Do Sistema Não Respondeu Corretamente. Ao Persistir, Contate o Desenvolvedor!"];
        echo json_encode($jSON);
    endif;
else:
    //ACESSO DIRETO
    die('<br><br><br><center><h1>Acesso Restrito!</h1></center>');
endif;
