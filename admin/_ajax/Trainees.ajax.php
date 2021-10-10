<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_TRAINEES;

if (!APP_TRAINEES || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['alert'] = ["red", "wondering2", "OPSSS", "Você Não Tem Permissão Para Essa Ação ou Não Está Logado Como Administrador!"];
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Trainees';
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

    // AUTO INSTANCE OBJECT EMAIL
    if (empty($Email)):
        $Email = new Email;
    endif;

    //SELECIONA AÇÃO
    switch ($Case):
        //GERENCIA TREINADORES
        case 'manager':
            $TraineeId = $PostData['trainee_id'];
            unset($PostData['trainee_id']);

            $Read->ExeRead(DB_TRAINEES, "WHERE trainee_id = :id", "id={$TraineeId}");
            $ThisTrainee = $Read->getResult()[0];

            if (!empty($_FILES['trainee_cover'])):
                $File = $_FILES['trainee_cover'];

                if ($ThisTrainee['trainee_cover'] && file_exists("../../uploads/{$ThisTrainee['trainee_cover']}") && !is_dir("../../uploads/{$ThisTrainee['trainee_cover']}")):
                    unlink("../../uploads/{$ThisTrainee['trainee_cover']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, Check::Name($PostData['trainee_name']) . '-' . time(), IMAGE_W, 'treinadores');
                if ($Upload->getResult()):
                    $PostData['trainee_cover'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR FOTO", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG Ou PNG Para Enviar Como Foto!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['trainee_cover']);
            endif;

            $PostData['trainee_url'] = (!empty($PostData['trainee_url']) ? Check::Name($PostData['trainee_url']) : Check::Name($PostData['trainee_name']));
            $PostData['trainee_status'] = (!empty($PostData['trainee_status']) ? '1' : '0');
            $PostData['trainee_datebirth'] = (!empty($PostData['trainee_datebirth']) ? Check::Nascimento($PostData['trainee_datebirth']) : '');
            $PostData['trainee_datecreate'] = (!empty($PostData['trainee_datecreate']) ? Check::Data($PostData['trainee_datecreate']) : date('Y-m-d H:i:s'));

            $Update->ExeUpdate(DB_TRAINEES, $PostData, "WHERE trainee_id = :id", "id={$TraineeId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Treinador <b>{$PostData['trainee_name']}</b> Foi Atualizado Com Sucesso!"];
            break;

        //DELETE TREINADORES
        case 'delete':
            $PostData['trainee_id'] = $PostData['del_id'];
            $Read->FullRead("SELECT trainee_cover FROM " . DB_TRAINEES . " WHERE trainee_id = :ps", "ps={$PostData['trainee_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['trainee_cover']}") && !is_dir("../../uploads/{$Read->getResult()[0]['trainee_cover']}")):
                unlink("../../uploads/{$Read->getResult()[0]['trainee_cover']}");
            endif;

            $Delete->ExeDelete(DB_TRAINEES, "WHERE trainee_id = :id", "id={$PostData['trainee_id']}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Treinador Foi Excluído Com Sucesso!"];
            break;

        //PAGINAÇÃO VIA AJAX TREINADORES HOME
        case 'content':
            $jSON['content'] = null;

            if (isset($PostData['search'])):
                $search = $PostData['search'];
                $Read->ExeRead(DB_TRAINEES, "WHERE (trainee_name LIKE '%' :search '%' OR trainee_email LIKE '%' :search '%') LIMIT :limit", "search={$search}&limit=10");
            endif;

            if (isset($PostData['offset'])):
                $offset = $PostData['offset'];
                $Read->ExeRead(DB_TRAINEES, "LIMIT :limit OFFSET :offset", "limit=10&offset={$offset}");
            endif;

            if ($Read->getResult()):
                foreach ($Read->getResult() as $Trainees):
                    extract($Trainees);

                    if (empty($trainee_cover) && $trainee_genre == 1):
                        $TraineeImage = "../tim.php?src=admin/_img/avatarm.png&w=40&h=40";
                    elseif (empty($trainee_cover) && $trainee_genre == 2):
                        $TraineeImage = "../tim.php?src=admin/_img/avatarf.png&w=40&h=40";
                    else:
                        $TraineeImage = BASE . "/tim.php?src=uploads/{$trainee_cover}&w=40&h=40";
                    endif;

                    $TraineeLink = "dashboard.php?wc=treinadores/create&id={$trainee_id}";

                    $jSON['content'] .= "<article class='marketing__table js-marketing-table js-rel-to' id='{$trainee_id}'> <div class='marketing__data'> <p class='payment'> <span class='img'> <img src='{$TraineeImage}'/> </span> </p> <p>" . Check::Chars($trainee_name, 25) . "</p> <p class='icon-envelop'>" . Check::Chars($trainee_email, 25) . "</p> <p class='icon-phone'>{$trainee_cell}</p> <p> <a title='Editar Treinador' class='btn_header btn_darkgreen icon-pencil icon-notext' href='{$TraineeLink}'></a> <span title='Excluir Treinador' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Trainees' callback_action='delete' id='{$trainee_id}'></span> </p> </div> </article>";
                endforeach;
            endif;
            break;

        //BUSCA DINÂMICA TREINADORES MODAL
        case 'search':
            $search = $PostData['search'];
            $jSON['content'] = null;

            $Read->ExeRead(DB_TRAINEES, "WHERE trainee_name LIKE '%' :search '%'", "search={$search}");
            if ($Read->getResult()):
                foreach ($Read->getResult() as $TRAINEES):
                    extract($TRAINEES);

                    $jSON['content'] .= "<li class='modal__item'>";
                    $jSON['content'] .= "<span class='modal__link js-user-toggle' data-name='{$trainee_name}' data-id='{$trainee_id}'>";
                    $jSON['content'] .= "{$trainee_name} <i class='icon-checkmark icon-notext modal__check'></i>";
                    $jSON['content'] .= "</span>";
                    $jSON['content'] .= "</li>";

                endforeach;
            endif;
            break;

        //ENVIA E-MAIL PARA OS TREINADORES
        case 'send':
            require '../_tpl/Client.email.php';
            extract($PostData);

            if (empty($trainees)):
                $jSON['alert'] = ["yellow", "warning", "OPSSS {$_SESSION['userLogin']['user_name']}", "Selecione os Treinadores!"];
                break;
            endif;

            if (empty($subject)):
                $jSON['alert'] = ["yellow", "warning", "OPSSS {$_SESSION['userLogin']['user_name']}", "Defina o Assunto!"];
                break;
            endif;

            if (empty($body)):
                $jSON['alert'] = ["yellow", "warning", "OPSSS {$_SESSION['userLogin']['user_name']}", "Defina a Mensagem!"];
                break;
            endif;

            $arrSearch = [
                '{trainee_name}',
                '{trainee_email}',
                '{trainee_cell}'
            ];

            if ($trainees == 'all'):
                $Read->ExeRead(DB_TRAINEES);
                foreach ($Read->getResult() as $Trainee):
                    extract($Trainee);

                    $arrReplace = [
                        $trainee_name,
                        $trainee_email,
                        $trainee_cell
                    ];

                    $replaces = str_replace($arrSearch, $arrReplace, $body);
                    $mensagem = str_replace('#mail_body#', $replaces, $MailContent);
                    $Email->EnviarMontando($subject, $mensagem, ADMIN_NAME, MAIL_USER, $trainee_name, $trainee_email);
                endforeach;
            else:
                foreach (explode(',', $Trainees) as $Trainee):
                    $Read->ExeRead(DB_TRAINEES, "WHERE trainee_id = :id", "id={$Trainee}");
                    extract($Read->getResult()[0]);

                    $arrReplace = [
                        $trainee_name,
                        $trainee_email,
                        $trainee_cell
                    ];

                    $replaces = str_replace($arrSearch, $arrReplace, $body);
                    $mensagem = str_replace('#mail_body#', $replaces, $MailContent);
                    $Email->EnviarMontando($subject, $mensagem, ADMIN_NAME, MAIL_USER, $trainee_name, $trainee_email);
                endforeach;
            endif;

            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O E-mail Foi Enviado Com Sucesso!"];
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
