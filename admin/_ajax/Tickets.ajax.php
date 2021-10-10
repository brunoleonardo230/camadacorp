<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_TICKETS;

if (!APP_TICKETS || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['alert'] = ["red", "wondering2", "OPSSS", "Você Não Tem Permissão Para Essa Ação ou Não Está Logado Como Administrador!"];
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Tickets';
$PostData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

//VALIDA AÇÃO
if ($PostData && $PostData['callback_action'] && $PostData['callback'] == $CallBack):
    //PREPARA OS DADOS
    $Case = $PostData['callback_action'];
    unset($PostData['callback'], $PostData['callback_action']);

    $Read = new Read;
    $Create = new Create;
    $Update = new Update;
    $Delete = new Delete;

    //SELECIONA AÇÃO
    switch ($Case):

        //TICKET :: ADD RESPONSE
        case 'ticket_responder':
            $TicketId = $PostData['ticket_id'];

            //GET RESPONSE
            if (empty($PostData['reply_content'])):
                $jSON['alert'] = ["yellow", "warning", "OPSSS", "Você Esqueceu de Escrever a Resposta {$_SESSION['userLogin']['user_name']}, Para Responder Você Deve Redigir Uma Resposta!"];
                break;
            endif;

            //SET RESPONSE
            $PostData['user_id_reply'] = $_SESSION['userLogin']['user_id'];
            $PostData['reply_date'] = date("Y-m-d H:i:s");
            $Create->ExeCreate(DB_TICKETS_REPLY, $PostData);
            
            //UPDATE SUPPORT STATUS
            $UpdateTicketStatus = ['ticket_status' => 2,'ticket_date_reply' => date("Y-m-d H:i:s")];
            $Update->ExeUpdate(DB_TICKETS, $UpdateTicketStatus, "WHERE ticket_id = :ticket", "ticket={$TicketId}");

            $jSON['divcontent'] = [".j_ead_support_status", "<span class='status bar_blue radius'>Respondido</span>"];
            $jSON['clear'] = true;

            // GET TICKET 
            $Read->ExeRead(DB_TICKETS, "WHERE ticket_id = :ticket", "ticket={$TicketId}");
            $TicketData = $Read->getResult()[0];

            //SEND NOTIFICATION
            $Read->ExeRead(DB_USERS, "WHERE user_id = (SELECT user_id FROM " . DB_TICKETS . " WHERE ticket_id = :ticket)", "ticket={$TicketId}");
            $UserResponderData = $Read->getResult()[0];

            require '../_tpl/Mail.email.php';
            $MailBody = "
                    <p style='font-size: 1.4em;'>Olá {$UserResponderData['user_name']},</p>
                    <p>{$_SESSION['userLogin']['user_name']} acabou de adicionar uma resposta de seu Ticket!</p>
                    <p>Para responder, efetue <a href='" . BASE . "/conta/login#acc'>login aqui</a> e acesse a Área do Cliente de nosso site<b></p>
                    <p>Já esta logado(a) na plataforma? Então acesse diretamente <a href='" . BASE . "/conta/tickets#acc'>clicando aqui!</a></p>
                    <p><b>IMPORTANTE:</b> Para encerrar o Ticket clique em 'Fechar Ticket' lá em nosso painel, ou adicione outra resposta para tirar mais dúvidas e continuar com a interação!</p>
                    <p>...</p>
                    <p>Se tiver qualquer problema, não deixe de responder este e-mail!</p>
                ";

            $MailContent = str_replace("#mail_body#", $MailBody, $MailContent);
            $Email = new Email;
            $Email->EnviarMontando("#" . str_pad($TicketId, 4, 0, 0) . " - Seu Ticket foi respondido!", $MailContent, MAIL_SENDER, MAIL_USER, "{$UserResponderData['user_name']} {$UserResponderData['user_lastname']}", $UserResponderData['user_email']);
            
            //RETURN RESPONSES
            $Read->ExeRead(DB_TICKETS_REPLY, "WHERE ticket_id = :tkt ORDER BY reply_date ASC", "tkt={$TicketId}");
            if ($Read->getResult()):
                $jSON['content'] = "";
                foreach ($Read->getResult() as $ResponseReply):
                    $Read->LinkResult(DB_USERS, "user_id", "{$ResponseReply['user_id_reply']}", 'user_id, user_name, user_lastname, user_email, user_thumb');
                    $user_reply = $Read->getResult()[0];

                    $UserThumb = "../../uploads/{$user_reply['user_thumb']}";
                    $user_reply['user_thumb'] = (file_exists($UserThumb) && !is_dir($UserThumb) ? "uploads/{$user_reply['user_thumb']}" : 'admin/_img/no_avatar.jpg');

                    $jSON['content'] .= "
                    <article class='ead_support_response ead_support_response_reply reply' id='{$ResponseReply['reply_id']}'>
                        <div class='ead_support_response_avatar'>
                            <img class='rounded' src='" . BASE . "/tim.php?src={$user_reply['user_thumb']}&w=" . round(AVATAR_W / 2) . "&h=" . round(AVATAR_H / 2) . "' alt='{$user_reply['user_name']}' title='{$user_reply['user_lastname']}'/>
                        </div><div class='ead_support_response_content'>
                            <header class='ead_support_response_content_header'><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
                                <h1>Respondido por: <a target='_blank' href='dashboard.php?wc=users/create&id={$user_reply['user_id']}' title='{$user_reply['user_name']} {$user_reply['user_lastname']}'>{$user_reply['user_name']} {$user_reply['user_lastname']}</a> dia " . date('d/m/Y H\hi', strtotime($ResponseReply['reply_date'])) . "</h1>
                            </header>
                            <div class='htmlchars response_chars'>{$ResponseReply['reply_content']}</div>

                            <div class='ead_support_response_actions'>
                                <span class='btn btn_red icon-cross j_tickets_action' data-action='ticket_delete' data-id='{$ResponseReply['reply_id']}'>Apagar</span>
                            </div>
                        </div>

                        <div class='ead_support_response_edit_modal remove'>
                            <form name='class_add' action='' method='post' enctype='multipart/form-data'>
                                <p class='title icon-warning'>Enviar notificação a {$user_reply['user_name']} {$user_reply['user_lastname']}: (Opcional)</p>
                                <span class='btn btn_red icon-cross icon-notext ead_support_response_edit_modal_close j_ead_support_action_close'></span>
                                <input type='hidden' name='callback' value='Tickets'/>
                                <input type='hidden' name='callback_action' value='ticket_message_delete_confirm'/>
                                <input type='hidden' name='delete_id' value='{$ResponseReply['reply_id']}'/>
                                <label class='label'>
                                    <textarea class='work_mce_basic' style='font-size: 1em;' name='obs_body' rows='3'></textarea>
                                </label>
                                <div class='wc_actions' style='margin-top: 15px;'>
                                    <button class='btn btn_red icon-cross'>CONFIRMAR EXCLUSÃO DA MENSAGEM</button>
                                    <img class='form_load none' style='margin-left: 10px;' alt='Enviando Requisição!' title='Enviando Requisição!' src='_img/load.gif'/>
                                </div>
                            </form>
                        </div>
                    </article>";
                endforeach;
            endif;

            //RESPONSE NULL
            $jSON['success'] = true;
            break;

        case 'ticket_reply_edit_confirm':
            $TicketId = $PostData['response_id'];
            unset($PostData['response_id']);
            $Update->ExeUpdate(DB_TICKETS_REPLY, $PostData, "WHERE reply_id = :tkt", "tkt={$TicketId}");

            $jSON['divcontent'] = ["#{$TicketId} .response_chars" => $PostData['reply_content']];
            $jSON['forceclick'] = "#{$TicketId} .j_ead_support_action_close";
            break;
            
        // EXCLUIR APENAS UMA MENSAGEM
        case 'ticket_message_delete_confirm':
            $TicketId = $PostData['delete_id'];
            unset($PostData['delete_id']);

            //SEND NOTIFICATION FOR
            $Read->ExeRead(DB_USERS, "WHERE user_id = (SELECT user_id_reply FROM " . DB_TICKETS_REPLY . " WHERE reply_id = :ticket)", "ticket={$TicketId}");
            $UserResponderData = $Read->getResult()[0];

            //TICKET IDENTIFICATION
            $Read->ExeRead(DB_TICKETS, "WHERE ticket_id = (SELECT ticket_id FROM " . DB_TICKETS_REPLY . " WHERE reply_id = :ticket)", "ticket={$TicketId}");
            $TicketData = $Read->getResult()[0];
            
            if ($PostData['obs_body']):
                require '../_tpl/Mail.email.php';                
                $MailBody = "
                        <p style='font-size: 1.1em;'>Olá {$UserResponderData['user_name']},</p>
                        <p>Este e-mail é para informar que nossa equipe teve que deletar uma das suas mensagens do ticket de número <b>#" . str_pad($TicketData['ticket_id'], 4, 0, 0) . "</b> com o assunto <b>{$TicketData['ticket_assunto']}</b>...</p>
                        " . ($PostData['obs_body'] ? "<p style='font-size:.75em'>... Observação do Suporte</p><p>{$PostData['obs_body']}</p><p><i>Atenciosamente {$_SESSION['userLogin']['user_name']} {$_SESSION['userLogin']['user_lastname']}!<br>Equipe de Suporte " . SITE_NAME . ".</i></p><p>...</p>" : '') . "
                        <p>Isso geralmente ocorre quando identificamos uma ou mais das seguintes situações:</p>
                        <p>
                         <ul>
                          <li>A mensagem não corresponde ao assunto do Ticket,</li>
                          <li>A mensagem é demasiadamente curta,</li>
                          <li>O texto da mensagem não foi compreendido,</li>
                          <li>A mensagem não apresenta uma pergunta ou dúvida,</li>
                          <li>Existem ofensas ou textos proibidos.</li>
                         </ul>
                        </p>
                        <p><b>Caso a sua dúvida permaneça, não deixe de enviar outra mensagem ao nosso suporte!</b></p> 
                        <p>...</p>
                        <p>Obrigado pela compreensão {$UserResponderData['user_name']}.</p>
                    ";

                $MailContent = str_replace("#mail_body#", $MailBody, $MailContent);
                $Email = new Email;
                $Email->EnviarMontando("Sua mensagem foi recusada (Ticket #" . str_pad($TicketData['ticket_id'], 4, 0, 0) . ")", $MailContent, MAIL_SENDER, MAIL_USER, "{$UserResponderData['user_name']} {$UserResponderData['user_lastname']}", $UserResponderData['user_email']);
            endif;

            //MESSAGE DELETE
            $Delete->ExeDelete(DB_TICKETS_REPLY, "WHERE reply_id = :ticket", "ticket={$TicketId}");
            $jSON['forceclick'] = "#{$TicketId} .j_ead_support_action_close";
            $jSON['divremove'] = ".ead_support_response_reply#{$TicketId}";
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "Mensagem Removida Com Sucesso!"];
            break;

        // EXCLUIR TICKET COMPLETO
        case 'ticket_delete':
            $TicketId = $PostData['del_id'];
            unset($PostData['del_id']);

            //SEND NOTIFICATION FOR
            $Read->ExeRead(DB_USERS, "WHERE user_id = (SELECT user_id FROM " . DB_TICKETS . " WHERE ticket_id = :ticket)", "ticket={$TicketId}");
            $UserResponderData = $Read->getResult()[0];

            //TICKET IDENTIFICATION
            $Read->ExeRead(DB_TICKETS, "WHERE ticket_id = :ticket", "ticket={$TicketId}");
            $TicketData = $Read->getResult()[0];
            
            require '../_tpl/Mail.email.php';
            $MailBody = "
                    <p style='font-size: 1.1em;'>Oppsss {$UserResponderData['user_name']},</p>
                    <p>Este e-mail é para informar que nossa equipe teve que deletar seu ticket de número <b>#" . str_pad($TicketData['ticket_id'], 4, 0, 0) . "</b> com o assunto <b>{$TicketData['ticket_assunto']}</b>...</p>
                    " . ($PostData['obs_body'] ? "<p style='font-size:.75em'>... Observação do Suporte</p><p>{$PostData['obs_body']}</p><p><i>Atenciosamente {$_SESSION['userLogin']['user_name']} {$_SESSION['userLogin']['user_lastname']}!<br>Equipe de Suporte " . SITE_NAME . ".</i></p><p>...</p>" : '') . "
                    <p>Isso geralmente ocorre quando identificamos uma ou mais das seguintes situações:</p>
                    <p>
                     <ul>
                      <li>O Ticket teve um assunto que não condiz com Suporte,</li>
                      <li>A mensagem do Ticket é demasiadamente curta,</li>
                      <li>O texto da mensagem não foi compreendido,</li>
                      <li>A mensagem não apresenta uma pergunta ou dúvida,</li>
                      <li>Existem ofensas ou textos proibidos.</li>
                     </ul>
                    </p>
                    <p><b>Caso sua dúvida ou problema persista, não deixe de criar outro Ticket pelo mesmo canal de suporte!</b></p>
                    <p>...</p>
                    <p>Obrigado pela compreensão {$UserResponderData['user_name']}.</p>
                ";
            $MailContent = str_replace("#mail_body#", $MailBody, $MailContent);
            $Email = new Email;
            $Email->EnviarMontando("Seu Ticket Foi EXCLUÍDO!! #" . str_pad($TicketData['ticket_id'], 4, 0, 0), $MailContent, MAIL_SENDER, MAIL_USER, "{$UserResponderData['user_name']} {$UserResponderData['user_lastname']}", $UserResponderData['user_email']);
        
            //TICKET RESPONSE'S && FILE DELETE
            $Delete->ExeDelete(DB_TICKETS_REPLY, "WHERE ticket_id = :ticket", "ticket={$TicketId}");
            if (file_exists("../../uploads/{$TicketData['ticket_arquivo']}") && !is_dir("../../uploads/{$TicketData['ticket_arquivo']}")):
                unlink("../../uploads/{$TicketData['ticket_arquivo']}");
            endif;

            $Delete->ExeDelete(DB_TICKETS, "WHERE ticket_id = :ticket", "ticket={$TicketId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "Ticket Excluído</b>! Recarregando Suporte..."];
            $jSON['redirect'] = "dashboard.php?wc=tickets/home";
            break;

        // MARCAR TICKET COMO RESOLVIDO
        case 'ticket_complete':
            $TicketId = $PostData['id'];
            unset($PostData);

            $PostData['ticket_status'] = 3;
            $Update->ExeUpdate(DB_TICKETS, $PostData, "WHERE ticket_id = :tkt", "tkt={$TicketId}");
            
            //SEND NOTIFICATION FOR
            $Read->ExeRead(DB_USERS, "WHERE user_id = (SELECT user_id FROM " . DB_TICKETS . " WHERE ticket_id = :ticket)", "ticket={$TicketId}");
            $UserResponderData = $Read->getResult()[0];
            
            //TICKET IDENTIFICATION
            $Read->ExeRead(DB_TICKETS, "WHERE ticket_id = :ticket", "ticket={$TicketId}");
            $TicketData = $Read->getResult()[0];

            // ENVIAR EMAIL AO CLIENTE DIZENDO QUE FOI FECHADO
            require '../_tpl/Mail.email.php';            
            $MailBody = "
                    <p style='font-size: 1.1em;'>Olá {$UserResponderData['user_name']},</p>
                    <p>Este e-mail é para informar que nossa equipe marcou como <b>RESOLVIDO</b> ticket de número <b>#" . str_pad($TicketData['ticket_id'], 4, 0, 0) . "</b> com o assunto <b>{$TicketData['ticket_assunto']}</b>...</p>
                    <p>Isso geralmente ocorre quando identificamos uma ou mais das seguintes situações:</p>
                    <p>
                     <ul>
                      <li>O Ticket teve um assunto que não condiz com Suporte e/ou APP Relacionada,</li>
                      <li>A mensagem do Ticket é demasiadamente curta,</li>
                      <li>O texto do Ticket não foi compreendido,</li>
                      <li>A mensagem não apresenta uma pergunta ou dúvida coesa,</li>
                      <li>Existem ofensas ou textos proibidos.</li>
                      <li>Falta de interação com a Equipe de Suporte.</li>
                     </ul>
                    </p>
                    <p><b>Caso a sua dúvida permaneça, não deixe de enviar um outro Ticket ao nosso suporte!</b></p> 
                    <p>...</p>
                    <p>Obrigado pela compreensão {$UserResponderData['user_name']}.</p>
                ";
            $MailContent = str_replace("#mail_body#", $MailBody, $MailContent);
            $Email = new Email;
            $Email->EnviarMontando("Ticket alterado para RESOLVIDO!! #" . str_pad($TicketData['ticket_id'], 4, 0, 0), $MailContent, MAIL_SENDER, MAIL_USER, "{$UserResponderData['user_name']} {$UserResponderData['user_lastname']}", $UserResponderData['user_email']);
            
            $jSON['redirect'] = "dashboard.php?wc=tickets/home";
            break;

        case 'ticket_reopen':
            $TicketId = $PostData['id'];
            unset($PostData);

            $PostData['ticket_status'] = 1;
            $Update->ExeUpdate(DB_TICKETS, $PostData, "WHERE ticket_id = :tkt", "tkt={$TicketId}");

            //SEND NOTIFICATION FOR
            $Read->ExeRead(DB_USERS, "WHERE user_id = (SELECT user_id FROM " . DB_TICKETS . " WHERE ticket_id = :ticket)", "ticket={$TicketId}");
            $UserResponderData = $Read->getResult()[0];
            
            //TICKET IDENTIFICATION
            $Read->ExeRead(DB_TICKETS, "WHERE ticket_id = :ticket", "ticket={$TicketId}");
            $TicketData = $Read->getResult()[0];

            // ENVIAR EMAIL AO CLIENTE DIZENDO QUE FOI re-aberto
            require '../_tpl/Mail.email.php';            
            $MailBody = "
                    <p style='font-size: 1.1em;'>Olá {$UserResponderData['user_name']},</p>
                    <p>Este e-mail é para informar que nossa equipe marcou como <b>EM ABERTO</b> ticket de número <b>#" . str_pad($TicketData['ticket_id'], 4, 0, 0) . "</b> com o assunto <b>{$TicketData['ticket_assunto']}</b>...</p>
                    <p>Isso pode ocorrer caso a dúvida ou problema sobre o Ticket ainda permaneça!</p>
                    <p>Para acessar o Ticket re-ativado, <a href='" . BASE . "/conta/tickets/" . base64_encode($TicketId) . "#acc'>CLIQUE NESTE LINK</a>.</p>
                    <p>Obrigado pela compreensão {$UserResponderData['user_name']}.</p>
                ";
            $MailContent = str_replace("#mail_body#", $MailBody, $MailContent);
            $Email = new Email;
            $Email->EnviarMontando("Ticket Alterado Para EM ABERTO!! #" . str_pad($TicketData['ticket_id'], 4, 0, 0), $MailContent, MAIL_SENDER, MAIL_USER, "{$UserResponderData['user_name']} {$UserResponderData['user_lastname']}", $UserResponderData['user_email']);
            
            $jSON['redirect'] = "dashboard.php?wc=tickets/home";
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