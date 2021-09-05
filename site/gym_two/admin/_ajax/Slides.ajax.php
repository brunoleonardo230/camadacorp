<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_SLIDES;

if (!APP_SLIDE || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['alert'] = ["red", "wondering2", "OPSSS", "Você Não Tem Permissão Para Essa Ação ou Não Está Logado Como Administrador!"];
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Slides';
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
        //GERENCIA
        case 'manager':
            $SlideId = $PostData['slide_id'];
            $SlideEnd = (!empty($PostData['slide_end']) ? $PostData['slide_end'] : null);
            $imageMobile = (!empty($_FILES['slide_image_mobile']) ? $_FILES['slide_image_mobile'] : null);
            $imageTablet = (!empty($_FILES['slide_image_tablet']) ? $_FILES['slide_image_tablet'] : null);
            $imageDesktop = (!empty($_FILES['slide_image_desktop']) ? $_FILES['slide_image_desktop'] : null);

            unset($PostData['slide_id'], $PostData['slide_end'], $PostData['slide_image_mobile'], $PostData['slide_image_tablet'], $PostData['slide_image_desktop']);
            $Read->FullRead("SELECT slide_image_mobile, slide_image_tablet, slide_image_desktop FROM " . DB_SLIDES . " WHERE slide_id = :id", "id={$SlideId}");

            if (empty($imageDesktop) && (!$Read->getResult() || !$Read->getResult()[0]['slide_image_desktop'])):
                $jSON['alert'] = ["yellow", "image", "ERRO AO CADASTRAR", "Por Favor, Envie Uma Imagem de Destaque Para <b>DESKTOP</b> Nas Medidas de " . SLIDE_W . " x " . SLIDE_H . "px!"];
            elseif (in_array('', $PostData)):
                $jSON['alert'] = ["yellow", "warning", "ERRO AO CADASTRAR", "Para Atualizar o Destaque, Por Favor Preencha Todos os Campos!"];
                $jSON['error'] = true;
            else:
                $PostData['slide_date'] = date('Y-m-d H:i:s');
                $PostData['slide_start'] = Check::Data($PostData['slide_start']);
                $PostData['slide_end'] = (!empty($SlideEnd) ? Check::Data($SlideEnd) : null);
                $PostData['slide_status'] = (!empty($PostData['slide_status']) ? $PostData['slide_status'] : '0');

                if (!empty($imageMobile)):
                    if ($Read->getResult() && !empty($Read->getResult()[0]['slide_image_mobile']) && file_exists("../../uploads/{$Read->getResult()[0]['slide_image_mobile']}") && !is_dir("../../uploads/{$Read->getResult()[0]['slide_image_mobile']}")):
                        unlink("../../uploads/{$Read->getResult()[0]['slide_image_mobile']}");
                    endif;
                    $Upload = new Upload('../../uploads/');
                    $Upload->Image($imageMobile, Check::Name($PostData['slide_title']) . '-' . 'mobile', SLIDE_W, 'slides');
                    $PostData['slide_image_mobile'] = $Upload->getResult();
                endif;

                if (!empty($imageTablet)):
                    if ($Read->getResult() && !empty($Read->getResult()[0]['slide_image_tablet']) && file_exists("../../uploads/{$Read->getResult()[0]['slide_image_tablet']}") && !is_dir("../../uploads/{$Read->getResult()[0]['slide_image_tablet']}")):
                        unlink("../../uploads/{$Read->getResult()[0]['slide_image_tablet']}");
                    endif;
                    $Upload = new Upload('../../uploads/');
                    $Upload->Image($imageTablet, Check::Name($PostData['slide_title']) . '-' . 'tablet', SLIDE_W, 'slides');
                    $PostData['slide_image_tablet'] = $Upload->getResult();
                endif;

                if (!empty($imageDesktop)):
                    if ($Read->getResult() && !empty($Read->getResult()[0]['slide_image_desktop']) && file_exists("../../uploads/{$Read->getResult()[0]['slide_image_desktop']}") && !is_dir("../../uploads/{$Read->getResult()[0]['slide_image_desktop']}")):
                        unlink("../../uploads/{$Read->getResult()[0]['slide_image_desktop']}");
                    endif;
                    $Upload = new Upload('../../uploads/');
                    $Upload->Image($imageDesktop, Check::Name($PostData['slide_title']) . '-' . 'desktop', SLIDE_W, 'slides');
                    $PostData['slide_image_desktop'] = $Upload->getResult();
                endif;

                $Update->ExeUpdate(DB_SLIDES, $PostData, "WHERE slide_id = :id", "id={$SlideId}");
                $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Slide Foi Atualizado Com Sucesso. E Será Exibido Entre o Período Cadastrado!"];
            endif;
            break;

        //DELETA
        case 'delete':
            $SlideId = $PostData['del_id'];
            $Read->FullRead("SELECT slide_image_mobile, slide_image_tablet, slide_image_desktop FROM " . DB_SLIDES . " WHERE slide_id = :id", "id={$SlideId}");
            if ($Read->getResult()):
                $imageMobile = (!empty($Read->getResult()[0]['slide_image_mobile']) ? $Read->getResult()[0]['slide_image_mobile'] : null);
                if ($imageMobile && file_exists("../../uploads/{$imageMobile}") && !is_dir("../../uploads/{$imageMobile}")):
                    unlink("../../uploads/{$imageMobile}");
                endif;

                $imageTablet = (!empty($Read->getResult()[0]['slide_image_tablet']) ? $Read->getResult()[0]['slide_image_tablet'] : null);
                if ($imageTablet && file_exists("../../uploads/{$imageTablet}") && !is_dir("../../uploads/{$imageTablet}")):
                    unlink("../../uploads/{$imageTablet}");
                endif;

                $imageDesktop = (!empty($Read->getResult()[0]['slide_image_desktop']) ? $Read->getResult()[0]['slide_image_desktop'] : null);
                if ($imageDesktop && file_exists("../../uploads/{$imageDesktop}") && !is_dir("../../uploads/{$imageDesktop}")):
                    unlink("../../uploads/{$imageDesktop}");
                endif;
            endif;

            $Delete->ExeDelete(DB_SLIDES, "WHERE slide_id = :id", "id={$SlideId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A APP Foi Excluída Com Sucesso!"];
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
