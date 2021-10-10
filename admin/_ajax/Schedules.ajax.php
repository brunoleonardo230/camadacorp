<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_SCHEDULES;

if (!APP_SCHEDULES || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['alert'] = ["red", "wondering2", "OPSSS", "Você Não Tem Permissão Para Essa Ação ou Não Está Logado Como Administrador!"];
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Schedules';
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

    // AUTO INSTANCE OBJECT E-MAIL
    if (empty($Email)):
        $Email = new Email;
    endif;

    //SELECIONA AÇÃO
    switch ($Case):
        //RESPONDER
        case 'response':
            $SchedulesId = $PostData['schedule_id'];
            unset($PostData['schedule_id']);

            $Read->ExeRead(DB_SCHEDULES, "WHERE schedule_id = :id", "id={$SchedulesId}");
            extract($Read->getResult()[0]);

            if ($schedule_status == 2):
                $jSON['alert'] = ["yellow", "warning", "OPSSS {$_SESSION['userLogin']['user_name']}", "Esta Solicitação Já Foi Respondida!"];
            else:
                $MailContent = '
            <table width="550" style="font-family: "Trebuchet MS", sans-serif;">
             <tr><td>
              <font face="Trebuchet MS" size="3">
               #mail_body#
              </font>
              <p style="font-size: 0.875em;">
              <img src="' . BASE . '/admin/_img/mail.jpg" alt="Atenciosamente ' . SITE_NAME . '" title="Atenciosamente ' . SITE_NAME . '" /><br><br>
               ' . SITE_ADDR_NAME . '<br>Telefone: ' . SITE_ADDR_PHONE_A . '<br>E-mail: ' . SITE_ADDR_EMAIL . '<br><br>
               <a title="' . SITE_NAME . '" href="' . BASE . '">' . SITE_ADDR_SITE . '</a><br>' . SITE_ADDR_ADDR . '<br>'
                        . SITE_ADDR_CITY . '/' . SITE_ADDR_UF . ' - ' . SITE_ADDR_ZIP . '<br>' . SITE_ADDR_COUNTRY . '
              </p>
              </td></tr>
            </table>
            <style>body, img{max-width: 550px !important; height: auto !important;} p{margin-botton: 15px 0 !important;}</style>';

                //ENVIA PARA O CLIENTE
                $ToCliente = "
                    {$PostData['schedule_response']}
                    <p><em>Atenciosamente " . SITE_NAME . ".</em></p>
            ";
                $MailMensage = str_replace("#mail_body#", $ToCliente, $MailContent);
                $Email->EnviarMontando("Re: Agendamento", $MailMensage, SITE_ADDR_NAME, SITE_ADDR_EMAIL, $schedule_name, $schedule_email);

                $PostData['schedule_status'] = 2;

                $Update->ExeUpdate(DB_SCHEDULES, $PostData, "WHERE schedule_id = :id", "id={$SchedulesId}");

                $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Solicitação Foi Respondida Com Sucesso!"];
            endif;
            break;

        //STATUS
        case 'status':
            $SchedulesId = $PostData['schedule_id'];
            unset($PostData['schedule_id']);

            $PostData['schedule_status'] = 2;
            $Update->ExeUpdate(DB_SCHEDULES, $PostData, "WHERE schedule_id = :id", "id={$SchedulesId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Solicitação Foi Marcada Como Respondida!"];
            break;

        //DELETE
        case 'delete':
            $Delete->ExeDelete(DB_SCHEDULES, "WHERE schedule_id = :id", "id={$PostData['del_id']}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Solicitação de Agendamento Foi Excluída Com Sucesso!"];
            break;
            
        //PAGINAÇÃO VIA AJAX CONTATOS HOME  
        case 'content':
            $jSON['content'] = null;

            if (isset($PostData['search'])):
                $search = $PostData['search'];
                $Read->FullRead(
                "SELECT "
                . "sc.schedule_id, "
                . "sc.schedule_name, "
                . "sc.schedule_email, "
                . "sc.schedule_telephone, "
                . "sc.schedule_service, "
                . "sc.date, "
                . "sc.time, "
                . "s.service_title "
                . "FROM " . DB_SCHEDULES . " sc "
                . "INNER JOIN " . DB_SERVICES . " s ON s.service_id = sc.schedule_service "
                . "WHERE (schedule_name LIKE '%' :search '%' OR schedule_email LIKE '%' :search '%') "
                . "ORDER BY date DESC, service_title ASC LIMIT :limit", "search={$search}&limit=10"
                );
            endif;

            if (isset($PostData['offset'])):
                $offset = $PostData['offset'];
                $Read->FullRead(
                "SELECT "
                . "sc.schedule_id, "
                . "sc.schedule_name, "
                . "sc.schedule_email, "
                . "sc.schedule_telephone, "
                . "sc.schedule_service, "
                . "sc.date, "
                . "sc.time, "
                . "s.service_title "
                . "FROM " . DB_SCHEDULES . " sc "
                . "INNER JOIN " . DB_SERVICES . " s ON s.service_id = sc.schedule_service "
                . "ORDER BY date DESC, service_title ASC LIMIT :limit OFFSET :offset", "limit=10&offset={$offset}"
                );
            endif;

            if ($Read->getResult()):
                foreach ($Read->getResult() as $SCHEDULES):
                    extract($SCHEDULES);
                    
                    $jSON['content'] .= "<article class='marketing__table js-marketing-table js-rel-to' id='{$schedule_id}'> <div class='marketing__data'> <p>" . Check::Chars($schedule_name, 25) . "</p> <p class='icon-envelop'>" . Check::Chars($schedule_email, 25) . "</p> <p class='icon-phone'>{$schedule_telephone}</p> <p>{$service_title}</p> <p> <a title='Responder' class='btn_header btn_darkgreen icon-pencil icon-notext' href='dashboard.php?wc=agendamentos/view&id={$schedule_id}'></a> <span title='Excluir' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Schedules' callback_action='delete' id='{$schedule_id}'></span> </p> </div> </article>";
                endforeach;
            endif;
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