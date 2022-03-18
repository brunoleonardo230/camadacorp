<?php

$getPost = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($getPost) || empty($getPost['action'])):
    die('Acesso Negado!');
endif;

$strPost = array_map('strip_tags', $getPost);
$POST = array_map('trim', $strPost);

$Action = $POST['action'];
unset($POST['action']);

$jSON = null;

usleep(2000);

require '../../../_app/Config.inc.php';
$Read = new Read;
$Create = new Create;
$Update = new Update;
$Delete = new Delete;
$Email = new Email;
$Trigger = new Trigger;


switch ($Action):
    //FORMULÁRIO DE CONTATO
    case 'contact_form':
        if (empty($POST['name']) || empty($POST['email'])):
            $jSON['wc_contact_error'] = "<p class='wc_contact_error'>&#10008; Por Favor, Preencha o Nome e E-mail Para Enviar a Mensagem!</p>";
        elseif (!Check::Email($POST['email']) || !filter_var($POST['email'], FILTER_VALIDATE_EMAIL)):
            $jSON['wc_contact_error'] = "<p class='wc_contact_error'>&#10008; O E-mail Informado Não Parece Válido. Por Favor, Informe o Seu E-mail!</p>";
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
                    <p style='font-size: 1.2em;'>Prezado(a) {$POST['name']},</p>
                    <p><b>Obrigado por entrar em contato conosco.</b></p>
                    <p>Este e-mail é para informar que recebemos sua solicitação de contato, e que estaremos respondendo o mais breve possível.</p>
                    <p><em>Atenciosamente " . SITE_NAME . ".</em></p>
            ";
            $MailMensage = str_replace("#mail_body#", $ToCliente, $MailContent);
            $Email->EnviarMontando("Recebemos Sua Solicitação", $MailMensage, SITE_ADDR_NAME, SITE_ADDR_EMAIL, $POST['name'], $POST['email']);


            $Phone = $POST['phone'] ? "<p><b>Telefone:</b> {$POST['phone']}</p>" : null;
            $Subject = $POST['subject'] ? "<p><b>Assunto:</b> {$POST['subject']}</p>" : null;
            $Mensagem = $POST['message'] ? "<p><b>Mensagem: </b>" . nl2br($POST['message']) . "</p>" : null;
            //ENVIA PARA O ADMIN
            $ToAdmin = "
                    <p><b>Nome:</b> {$POST['name']}</p>
                    <p><b>E-mail:</b> {$POST['email']}</p>
                    $Phone
                    $Mensagem
                    <p style='font-size: 0.9em;'>
                        Enviada por: {$POST['name']}<br>
                        E-mail: {$POST['email']}<br>
                        Dia: " . date('d/m/Y H\hi') . "
                    </p>
            ";
            $CopyMensage = str_replace("#mail_body#", $ToAdmin, $MailContent);
            $Email->EnviarMontando("Solicitação de Contato", $CopyMensage, $POST['name'], $POST['email'], SITE_ADDR_NAME, SITE_ADDR_EMAIL);

            $jSON['wc_send_mail'] = $POST['name'];

            $CreateSchedule = [
                "schedule_name" => $POST['name'],
                "schedule_email" => $POST['email'],
                "schedule_telephone" => $POST['phone'],               
                "schedule_message" => $POST['message'],
                "schedule_status" => 1
            ];
            
            $Create->ExeCreate(DB_SCHEDULES, $CreateSchedule);

        endif;
        break;

    //AGENDAMENTO
    case 'schedule_form':
        if (empty($POST['schedule_name']) || empty($POST['schedule_email'])):
            $jSON['wc_schedule_error'] = "<p class='wc_schedule_error'>&#10008; Por Favor, Preencha o Nome, E-mail, Data e Hora Para Agendar Um Horário!</p>";
        elseif (!Check::Email($POST['schedule_email']) || !filter_var($POST['schedule_email'], FILTER_VALIDATE_EMAIL)):
            $jSON['wc_schedule_error'] = "<p class='wc_schedule_error'>&#10008; O E-mail Informado Não Parece Válido. Por Favor, Informe Seu E-mail!</p>";
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
                    <p style='font-size: 1.2em;'>Prezado(a) {$POST['schedule_name']},</p>
                    <p><b>Obrigado pelo interesse em nossos serviços.</b></p>
                    <p>Este e-mail é para informar que recebemos sua solicitação de orçamento, e que estaremos respondendo o mais breve possível.</p>
                    <p><em>Atenciosamente " . SITE_NAME . ".</em></p>
            ";
            $MailMensagem = str_replace("#mail_body#", $ToCliente, $MailContent);
            $Email->EnviarMontando("Recebemos Sua Solicitação", $MailMensagem, SITE_ADDR_NAME, SITE_ADDR_EMAIL, $POST['schedule_name'], $POST['schedule_email']);

            $Telephone = (!empty($POST['schedule_telephone']) ? "<p><b>Telefone:</b> {$POST['schedule_telephone']}</p>" : null);
            $Date = (!empty($POST['date']) ? "<p><b>Data: </b>" .  date('d/m/Y', strtotime($POST['date'])) . "</p>" : null);
            $Hour = (!empty($POST['time']) ? "<p><b>Hora: </b>" .  date('H:i', strtotime($POST['time'])) . "</p>" : null);
            $Person = (!empty($POST['schedule_person']) ? "<p><b>N° de Pessoas:</b> {$POST['schedule_person']}</p>" : null);
            $Mensagem = (!empty($POST['schedule_message']) ? "<p><b>Mensagem: </b>" . nl2br($POST['schedule_message']) . "</p>" : null);
            
            //ENVIA PARA O ADMIN
            $ToAdmin = "
                    <p><b>Nome:</b> {$POST['schedule_name']}</p>
                    <p><b>E-mail:</b> {$POST['schedule_email']}</p>
                    $Telephone
                    $Date . " - " $Hour
                    $Person
                    $Mensagem
                    <p style='font-size: 0.9em;'>
                        Enviada por: {$POST['schedule_name']}<br>
                        E-mail: {$POST['schedule_email']}<br>
                        Dia: " . date('d/m/Y H\hi') . "
                    </p>
            ";
                        
            $CopyMensage = str_replace("#mail_body#", $ToAdmin, $MailContent);
            $Email->EnviarMontando("Agendamento de Horário", $CopyMensage, $POST['schedule_name'], $POST['schedule_email'], SITE_ADDR_NAME, SITE_ADDR_EMAIL);
            
            $CreateSchedule = [
                "schedule_name" => $POST['schedule_name'],
                "schedule_email" => $POST['schedule_email'],
                "schedule_telephone" => $POST['schedule_telephone'],
                "schedule_person" => $POST['schedule_person'],
                "date" => date('Y-m-d', strtotime($POST['date'])),
                "time" => date('H:i', strtotime($POST['time'])),
                "schedule_message" => $POST['schedule_message'],
                "schedule_status" => 1
            ];
            
            $Create->ExeCreate(DB_SCHEDULES, $CreateSchedule);

            $jSON['wc_send_mail'] = $POST['schedule_name'];
        endif;
        break;
        
        //NEWSLETTER
    case 'newsletter':
        $EmailAdd = $POST['contact_email'];
        $Name = $POST['contact_name'];
        $Phone = $POST['contact_telephone'];

        if (!Check::Email($EmailAdd)):
            $jSON['notify'][] = $Trigger->notify('OPSSS!, Digite Um E-mail Válido!', 'red', 'icon-wondering2', 5000);
            $jSON['success'] = false;
        else:
            $Read->ExeRead(DB_CONTACTS, "WHERE contact_email = :email", "email={$EmailAdd}");
            if ($Read->getResult()):
                $UpdateContact = [
                    'contact_name' => $Name,
                    'contact_email' => $EmailAdd,
                    'contact_telephone' => $Phone
                ];

                $Update->ExeUpdate(DB_CONTACTS, $UpdateContact, "WHERE contact_id = :cid", "cid={$Read->getResult()[0]['contact_id']}");
                $jSON['notify'][] = $Trigger->notify('Atualizamos Seu Cadastro Em Nossa Lista de Contatos! ' . $Name . ' =)', 'blue', 'icon-checkmark', 3000);
                $jSON['success'] = true;
            else:
                $CreateContact = [
                    'contact_name' => $Name,
                    'contact_email' => $EmailAdd,
                    'contact_telephone' => $Phone
                ];

                $Create->ExeCreate(DB_CONTACTS, $CreateContact);
                $jSON['notify'][] = $Trigger->notify('TUDO CERTO! Você Se Inscreveu Na Lista de Contatos Com Sucesso! =)', 'blue', 'icon-checkmark', 3000);
                $jSON['success'] = true;
            endif;
        endif;
        break;
endswitch;

echo json_encode($jSON);
