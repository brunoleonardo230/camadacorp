<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_CLASSES;

if (!APP_CLASSES || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['alert'] = ["red", "wondering2", "OPSSS", "Você Não Tem Permissão Para Essa Ação ou Não Está Logado Como Administrador!"];
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Classes';
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
        //GERENCIA CLASSES
        case 'manager':
            $ClassId = $PostData['class_id'];
            unset($PostData['class_id']);

            $Read->ExeRead(DB_CLASSES, "WHERE class_id = :id", "id={$ClassId}");
            $ThisClass = $Read->getResult()[0];

            $ClassName = (!empty($PostData['class_name']) ? $PostData['class_name'] : $PostData['class_title']);
            $PostData['class_name'] = Check::Name($ClassName);
            $Read->FullRead("SELECT class_name FROM " . DB_CLASSES . " WHERE class_name = :nm AND class_id != :id", "nm={$PostData['class_name']}&id={$ClassId}");
            if ($Read->getResult()):
                $PostData['class_name'] = "{$PostData['class_name']}-{$ClassId}";
            endif;
            $jSON['name'] = $PostData['class_name'];

            if (!empty($_FILES['class_image'])):
                $File = $_FILES['class_image'];

                if ($ThisClass['class_image'] && file_exists("../../uploads/{$ThisClass['class_image']}") && !is_dir("../../uploads/{$ThisClass['class_image']}")):
                    unlink("../../uploads/{$ThisClass['class_image']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_name']. '-image', IMAGE_W, 'classes');
                if ($Upload->getResult()):
                    $PostData['class_image'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG Ou PNG Para Enviar Como Capa!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_image']);
            endif;

            if (!empty($_FILES['class_icon'])):
                $File = $_FILES['class_icon'];

                if ($ThisClass['class_icon'] && file_exists("../../uploads/{$ThisClass['class_icon']}") && !is_dir("../../uploads/{$ThisClass['class_icon']}")):
                    unlink("../../uploads/{$ThisClass['class_icon']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_name']. '-icon', IMAGE_W, 'classes');
                if ($Upload->getResult()):
                    $PostData['class_icon'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "warning", "ERRO AO ENVIAR O ÍCONE", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG ou PNG Para Enviar Como Ícone!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_icon']);
            endif;

            $PostData['class_status'] = (!empty($PostData['class_status']) ? '1' : '0');
            $PostData['class_datecreate'] = (!empty($PostData['class_datecreate']) ? Check::Data($PostData['class_datecreate']) : date('Y-m-d H:i:s'));

            $Update->ExeUpdate(DB_CLASSES, $PostData, "WHERE class_id = :id", "id={$ClassId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Classe <b>{$PostData['class_title']}</b> Foi Atualizada Com Sucesso!"];
            break;

        //CADASTRA IMAGENS EXTRAS CLASSES
        case 'create_class_images':
            $ClassId = $PostData['class_id'];
            unset($PostData['class_id']);

            $Read->ExeRead(DB_CLASSES, "WHERE class_id = :id", "id={$ClassId}");
            $ThisClass = $Read->getResult()[0];

            $ClassName = (!empty($PostData['class_name']) ? $PostData['class_name'] : $ThisClass['class_title']);
            $PostData['class_name'] = Check::Name($ClassName);
            $Read->FullRead("SELECT class_name FROM " . DB_CLASSES . " WHERE class_name = :nm AND class_id != :id", "nm={$PostData['class_name']}&id={$ClassId}");
            if ($Read->getResult()):
                $PostData['class_name'] = "{$PostData['class_name']}-{$ClassId}";
            endif;
            $jSON['name'] = $PostData['class_name'];
            if (!empty($_FILES['class_image_one'])):
                $File = $_FILES['class_image_one'];

                if ($ThisClass['class_image_one'] && file_exists("../../uploads/{$ThisClass['class_image_one']}") && !is_dir("../../uploads/{$ThisClass['class_image_one']}")):
                    unlink("../../uploads/{$ThisClass['class_image_one']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_name'] . '-one', IMAGE_W, 'classes');
                if ($Upload->getResult()):
                    $PostData['class_image_one'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR A IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG ou PNG Para Enviar Como Imagem!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_image_one']);
            endif;
            if (!empty($_FILES['class_image_two'])):
                $File = $_FILES['class_image_two'];

                if ($ThisClass['class_image_two'] && file_exists("../../uploads/{$ThisClass['class_image_two']}") && !is_dir("../../uploads/{$ThisClass['class_image_two']}")):
                    unlink("../../uploads/{$ThisClass['class_image_two']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_name'] . '-two', IMAGE_W, 'classes');
                if ($Upload->getResult()):
                    $PostData['class_image_two'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "warning", "ERRO AO ENVIAR A IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG ou PNG Para Enviar Como Imagem!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_image_two']);
            endif;

            $Update->ExeUpdate(DB_CLASSES, $PostData, "WHERE class_id = :id", "id={$ClassId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "As Imagens da Classe Foram Atualizadas Com Sucesso!"];
            break;

        //DELETA CLASSES
        case 'delete':
            $PostData['class_id'] = $PostData['del_id'];
            $Read->FullRead("SELECT class_image FROM " . DB_CLASSES . " WHERE class_id = :ps", "ps={$PostData['class_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['class_image']}") && !is_dir("../../uploads/{$Read->getResult()[0]['class_image']}")):
                unlink("../../uploads/{$Read->getResult()[0]['class_image']}");
            endif;

            $Read->FullRead("SELECT class_icon FROM " . DB_CLASSES . " WHERE class_id = :ps", "ps={$PostData['class_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['class_icon']}") && !is_dir("../../uploads/{$Read->getResult()[0]['class_icon']}")):
                unlink("../../uploads/{$Read->getResult()[0]['class_icon']}");
            endif;

            $Read->FullRead("SELECT class_image_one FROM " . DB_CLASSES . " WHERE class_id = :ps", "ps={$PostData['class_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['class_image_one']}") && !is_dir("../../uploads/{$Read->getResult()[0]['class_image_one']}")):
                unlink("../../uploads/{$Read->getResult()[0]['class_image_one']}");
            endif;

            $Read->FullRead("SELECT class_image_two FROM " . DB_CLASSES . " WHERE class_id = :ps", "ps={$PostData['class_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['class_image_two']}") && !is_dir("../../uploads/{$Read->getResult()[0]['class_image_two']}")):
                unlink("../../uploads/{$Read->getResult()[0]['class_image_two']}");
            endif;

            $Delete->ExeDelete(DB_CLASSES, "WHERE class_id = :id", "id={$PostData['class_id']}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Classe Foi Excluída Com Sucesso!"];
            break;

        //DELETA TIPOS DE CLASSES
        case 'delete_types':
            $PostData['class_type_id'] = $PostData['del_id'];
            $Read->FullRead("SELECT class_type_image FROM " . DB_CLASSES_TYPES . " WHERE class_type_id = :ps", "ps={$PostData['class_type_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['class_type_image']}") && !is_dir("../../uploads/{$Read->getResult()[0]['class_type_image']}")):
                unlink("../../uploads/{$Read->getResult()[0]['class_type_image']}");
            endif;

            $Read->FullRead("SELECT class_type_icon FROM " . DB_CLASSES_TYPES . " WHERE class_type_id = :ps", "ps={$PostData['class_type_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['class_type_icon']}") && !is_dir("../../uploads/{$Read->getResult()[0]['class_type_icon']}")):
                unlink("../../uploads/{$Read->getResult()[0]['class_type_icon']}");
            endif;

            $Delete->ExeDelete(DB_CLASSES_TYPES, "WHERE class_type_id = :id", "id={$PostData['class_type_id']}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Tipo da Classe Foi Excluído Com Sucesso!"];
            break;

        //CADASTRA TIPOS DE CLASSES
        case 'create_types':
            $Types = $PostData['class_type_id'];
            unset($PostData['class_type_id']);

            $Read->ExeRead(DB_CLASSES_TYPES, "WHERE class_type_id = :id", "id={$Types}");
            $ThisTypes = $Read->getResult()[0];

            if (!empty($_FILES['class_type_image'])):
                $File = $_FILES['class_type_image'];

                if ($ThisTypes['class_type_image'] && file_exists("../../uploads/{$ThisTypes['class_type_image']}") && !is_dir("../../uploads/{$ThisTypes['class_type_image']}")):
                    unlink("../../uploads/{$ThisTypes['class_type_image']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_type_title'] . '-image', IMAGE_W, 'types');
                if ($Upload->getResult()):
                    $PostData['class_type_image'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR A IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG ou PNG Para Enviar Como Imagem!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_type_image']);
            endif;

            if (!empty($_FILES['class_type_icon'])):
                $File = $_FILES['class_type_icon'];

                if ($ThisTypes['class_type_icon'] && file_exists("../../uploads/{$ThisTypes['class_type_icon']}") && !is_dir("../../uploads/{$ThisTypes['class_type_icon']}")):
                    unlink("../../uploads/{$ThisTypes['class_type_icon']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_type_title'] . '-icon', IMAGE_W, 'classes-types');
                if ($Upload->getResult()):
                    $PostData['class_type_icon'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "warning", "ERRO AO ENVIAR O ÍCONE", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG ou PNG Para Enviar Como Ícone!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_type_icon']);
            endif;

            $PostData['class_type_datecreate'] = (!empty($PostData['class_type_datecreate']) ? Check::Data($PostData['class_type_datecreate']) : date('Y-m-d H:i:s'));

            $Update->ExeUpdate(DB_CLASSES_TYPES, $PostData, "WHERE class_type_id = :id", "id={$Types}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Tipo <b>{$PostData['class_type_title']}</b> Foi Atualizado Com Sucesso!"];
            break;

        //CADASTRA IMAGENS EXTRAS DOS TIPOS DAS CLASSES
        case 'create_class_types_images':
            $ClassId = $PostData['class_id'];
            $ClassTypesId = $PostData['class_type_id'];
            unset($PostData['class_id']);

            $Read->ExeRead(DB_CLASSES_TYPES, "WHERE class_type_id = :id", "id={$ClassTypesId}");
            $ThisClassTypes = $Read->getResult()[0];

            $ClassTypesName = (!empty($PostData['class_type_name']) ? $PostData['class_type_name'] : $ThisClassTypes['class_type_title']);
            $PostData['class_type_name'] = Check::Name($ClassTypesName);
            $Read->FullRead("SELECT class_type_name FROM " . DB_CLASSES_TYPES . " WHERE class_type_name = :nm AND class_type_id != :id", "nm={$PostData['class_type_name']}&id={$ClassTypesId}");
            if ($Read->getResult()):
                $PostData['class_type_name'] = "{$PostData['class_type_name']}-{$ClassTypesId}";
            endif;
            $jSON['name'] = $PostData['class_type_name'];
            if (!empty($_FILES['class_type_image_one'])):
                $File = $_FILES['class_type_image_one'];

                if ($ThisClassTypes['class_type_image_one'] && file_exists("../../uploads/{$ThisClassTypes['class_type_image_one']}") && !is_dir("../../uploads/{$ThisClassTypes['class_type_image_one']}")):
                    unlink("../../uploads/{$ThisClassTypes['class_type_image_one']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_type_name'] . '-one', IMAGE_W, 'classes-types');
                if ($Upload->getResult()):
                    $PostData['class_type_image_one'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR A IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG ou PNG Para Enviar Como Imagem!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_type_image_one']);
            endif;
            if (!empty($_FILES['class_type_image_two'])):
                $File = $_FILES['class_type_image_two'];

                if ($ThisClassTypes['class_type_image_two'] && file_exists("../../uploads/{$ThisClassTypes['class_type_image_two']}") && !is_dir("../../uploads/{$ThisClassTypes['class_type_image_two']}")):
                    unlink("../../uploads/{$ThisClassTypes['class_type_image_two']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, $PostData['class_type_name'] . '-two', IMAGE_W, 'classes');
                if ($Upload->getResult()):
                    $PostData['class_type_image_two'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "warning", "ERRO AO ENVIAR A IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG ou PNG Para Enviar Como Imagem!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['class_type_image_two']);
            endif;

            $Update->ExeUpdate(DB_CLASSES_TYPES, $PostData, "WHERE class_type_id = :id", "id={$ClassTypesId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "As Imagens do Tipo da Classe Foram Atualizadas Com Sucesso!"];
            break;

        //IMAGENS DA GALERIA
        case 'class_gallery_image':
            $ClassId = $PostData['class_id'];//ID DO OFERTA QUE SERÁ ATUALIZADO
            unset($PostData['class_id']);
            $GalleryImages = $_FILES['class_gallery_images'];//ARRAY COM AS IMAGENS

            //VERIFICA SE O OFERTA EXISTE
            $Read->FullRead("SELECT class_title FROM " . DB_CLASSES . " WHERE class_id = :id", "id={$ClassId}");
            if (!$Read->getResult()):
                $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Desculpe {$_SESSION['userLogin']['user_name']}, Mas Não Foi Possível Identificar a Galeria Vinculada!"];
            else:
                $ClassTitle = $Read->getResult()[0]['class_title'];
                //SE EXISTIR, ADICIONA AS FOTOS
                //PREPARA ARRAY COM TODOS OS ARQUIVOS
                $gbFiles = array();
                $gbCount = count($GalleryImages['tmp_name']);
                $gbKeys = array_keys($GalleryImages);

                for ($gb = 0; $gb < $gbCount; $gb++):
                    foreach ($gbKeys as $Keys):
                        $gbFiles[$gb][$Keys] = $GalleryImages[$Keys][$gb];
                    endforeach;
                endfor;

                //UPLOAD DE TODOS OS ARQUIVOS
                $Upload = new Upload('../../uploads/');
                $i = 0; //LAÇO DE REPETIÇÃO UPLOAD
                $u = 0; //LAÇO DE REPETIÇÃO BANCO

                foreach ($gbFiles as $gbUpload):
                    $i++;
                    $Upload->Image($gbUpload, Check::Name($ClassTitle) . '-' . $i . time() , IMAGE_W, 'class-gallery');

                    if ($Upload->getResult()):
                        $PostData['class_id'] = $ClassId;
                        $PostData['class_gallery_file'] = $Upload->getResult();
                        $PostData['class_gallery_legend'] = $ClassTitle;
                        $Create->ExeCreate(DB_CLASSES_GALLERY, $PostData);
                        $u++;
                    endif;
                endforeach;

                if ($u >= 1):
                    $jSON['divremove'] = ".js-trigger";
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "Fotos Enviadas Com Sucesso!"];
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Desculpe {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG Ou PNG Para Inserir Na Galeria!"];
                endif;
            endif;

            //RECARREGA A GALERIA
            $Read->ExeRead(DB_CLASSES_GALLERY, "WHERE class_id = :id ORDER BY class_gallery_order ASC", "id={$ClassId}");
            if (!$Read->getResult()):
                Erro('Ainda Não Existe Nenhuma Foto Nessa Galeria!', E_USER_NOTICE);
            else:
                $GalleryHtml = '';
                foreach ($Read->getResult() as $gallery):
                    extract($gallery);
                    $GalleryHtml = $GalleryHtml . "<div class='panel_gallery_image wc_draganddrop js-rel-to' callback='Classes' callback_action='class_gallery_order' id='{$class_gallery_id}' data-id='{$class_gallery_id}' >" .
                        "<img src='../tim.php?src=uploads/{$class_gallery_file}&w=200&h=200'>" .
                        "<div class='panel_gallery_action'><ul class='buttons'>" .
                        "<li><span title='Excluir Imagem' rel='panel_gallery_image' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='class_gallery_delete' id='{$class_gallery_id}'></span></li>" .
                        "</ul></div>" .
                        "</div>" .
                        "<script src=" . BASE ."/admin/_siswc/classes/classes.js></script>";
                endforeach;
            endif;
            $jSON['gallery'] = $GalleryHtml;
            break;

        case 'class_gallery_order':
            if (is_array($PostData['Data'])):
                foreach ($PostData['Data'] as $RE):
                    $UpdateCourse = ['class_gallery_order' => $RE[1]];
                    $Update->ExeUpdate(DB_CLASSES_GALLERY, $UpdateCourse, "WHERE class_gallery_id = :gallery", "gallery={$RE[0]}");
                endforeach;

                $jSON['sucess'] = true;
            endif;
            break;

        case 'class_gallery_delete':
            $Read->FullRead("SELECT class_gallery_file FROM " . DB_CLASSES_GALLERY . " WHERE class_gallery_id = :ps", "ps={$PostData['del_id']}");
            if ($Read->getResult()):
                $ImageRemove = "../../uploads/{$Read->getResult()[0]['class_gallery_file']}";
                if (file_exists($ImageRemove) && !is_dir($ImageRemove)):
                    unlink($ImageRemove);
                endif;
            endif;

            $Delete->ExeDelete(DB_CLASSES_GALLERY, "WHERE class_gallery_id = :id", "id={$PostData['del_id']}");

            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Imagem Foi Excluída Com Sucesso!"];
            break;

        //IMAGENS DA GALERIA
        case 'class_types_gallery_image':
            $ClassTypesId = $PostData['class_type_id'];//ID DO TIPO DA CLASSE QUE SERÁ ATUALIZADO
            unset($PostData['class_type_id']);
            $GalleryImages = $_FILES['class_type_gallery_images'];//ARRAY COM AS IMAGENS

            //VERIFICA SE O OFERTA EXISTE
            $Read->FullRead("SELECT class_type_title FROM " . DB_CLASSES_TYPES . " WHERE class_type_id = :id", "id={$ClassTypesId}");
            if (!$Read->getResult()):
                $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Desculpe {$_SESSION['userLogin']['user_name']}, Mas Não Foi Possível Identificar a Galeria Vinculada!"];
            else:
                $ClassTypesTitle = $Read->getResult()[0]['class_type_title'];
                //SE EXISTIR, ADICIONA AS FOTOS
                //PREPARA ARRAY COM TODOS OS ARQUIVOS
                $gbFiles = array();
                $gbCount = count($GalleryImages['tmp_name']);
                $gbKeys = array_keys($GalleryImages);

                for ($gb = 0; $gb < $gbCount; $gb++):
                    foreach ($gbKeys as $Keys):
                        $gbFiles[$gb][$Keys] = $GalleryImages[$Keys][$gb];
                    endforeach;
                endfor;

                //UPLOAD DE TODOS OS ARQUIVOS
                $Upload = new Upload('../../uploads/');
                $i = 0; //LAÇO DE REPETIÇÃO UPLOAD
                $u = 0; //LAÇO DE REPETIÇÃO BANCO

                foreach ($gbFiles as $gbUpload):
                    $i++;
                    $Upload->Image($gbUpload, Check::Name($ClassTypesTitle) . '-' . $i . time() , IMAGE_W, 'class-types-gallery');

                    if ($Upload->getResult()):
                        $PostData['class_type_id'] = $ClassTypesId;
                        $PostData['class_type_gallery_file'] = $Upload->getResult();
                        $PostData['class_type_gallery_legend'] = $ClassTypesTitle;
                        $Create->ExeCreate(DB_CLASSES_TYPES_GALLERY, $PostData);
                        $u++;
                    endif;
                endforeach;

                if ($u >= 1):
                    $jSON['divremove'] = ".js-trigger";
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "Fotos Enviadas Com Sucesso!"];
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Desculpe {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG Ou PNG Para Inserir Na Galeria!"];
                endif;
            endif;

            //RECARREGA A GALERIA
            $Read->ExeRead(DB_CLASSES_TYPES_GALLERY, "WHERE class_type_id = :id ORDER BY class_type_gallery_order ASC", "id={$ClassTypesId}");
            if (!$Read->getResult()):
                Erro('Ainda Não Existe Nenhuma Foto Nessa Galeria!', E_USER_NOTICE);
            else:
                $GalleryHtml = '';
                foreach ($Read->getResult() as $gallery):
                    extract($gallery);
                    $GalleryHtml = $GalleryHtml . "<div class='panel_gallery_image wc_draganddrop js-rel-to' callback='Classes' callback_action='class_gallery_order' id='{$class_type_gallery_id}' data-id='{$class_type_gallery_id}' >" .
                        "<img src='../tim.php?src=uploads/{$class_type_gallery_file}&w=200&h=200'>" .
                        "<div class='panel_gallery_action'><ul class='buttons'>" .
                        "<li><span title='Excluir Imagem' rel='panel_gallery_image' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='class_type_gallery_delete' id='{$class_type_gallery_id}'></span></li>" .
                        "</ul></div>" .
                        "</div>" .
                        "<script src=" . BASE ."/admin/_siswc/classes/classes.js></script>";
                endforeach;
            endif;
            $jSON['gallery'] = $GalleryHtml;
            break;

        case 'class_type_gallery_order':
            if (is_array($PostData['Data'])):
                foreach ($PostData['Data'] as $RE):
                    $UpdateCourse = ['class_type_gallery_order' => $RE[1]];
                    $Update->ExeUpdate(DB_CLASSES_TYPES_GALLERY, $UpdateCourse, "WHERE class_type_gallery_id = :gallery", "gallery={$RE[0]}");
                endforeach;

                $jSON['sucess'] = true;
            endif;
            break;

        case 'class_type_gallery_delete':
            $Read->FullRead("SELECT class_type_gallery_file FROM " . DB_CLASSES_TYPES_GALLERY . " WHERE class_type_gallery_id = :ps", "ps={$PostData['del_id']}");
            if ($Read->getResult()):
                $ImageRemove = "../../uploads/{$Read->getResult()[0]['class_type_gallery_file']}";
                if (file_exists($ImageRemove) && !is_dir($ImageRemove)):
                    unlink($ImageRemove);
                endif;
            endif;

            $Delete->ExeDelete(DB_CLASSES_TYPES_GALLERY, "WHERE class_type_gallery_id = :id", "id={$PostData['del_id']}");

            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Imagem Foi Excluída Com Sucesso!"];
            break;
        	
        //CADASTRA HORÁRIO DAS CLASSES
        case 'create_class_schedule':
            $ClassId = $PostData['class_id'];
            unset($PostData['class_id']);
            
            if (empty($PostData['class_schedule_day']) || empty($PostData['class_schedule_start']) || empty($PostData['class_schedule_end'])):
                $jSON['alert'] = ["red", "wondering2", "OPSSS {$_SESSION['userLogin']['user_name']}", "Para Cadastrar Um Horário, é Preciso Informar o Dia, o Horário de Início e o Horário de Término. Por Favor, Tente Novamente!"];
            else:
                if (empty($PostData['class_schedule_id'])):
                    //Realiza Cadastro
                    $PostData['class_id'] = $ClassId;
                    $Create->ExeCreate(DB_CLASSES_SCHEDULES, $PostData);

                    //Realtime
                    $jSON['add_content'] = null;

                    $Read->ExeRead(DB_CLASSES_SCHEDULES, "WHERE class_schedule_id = :id", "id={$Create->getResult()}");
                    if ($Read->getResult()):
                        extract($Read->getResult()[0]);
                        
                        $jSON['add_content'] = ['#classes-schedules' => "<div class='single_user_addr js-rel-to' id='{$class_schedule_id}'> <h1 class='icon-clock'>" . getWeekDays($class_schedule_day) . " | " . getHours($class_schedule_start) . " - " . getHours($class_schedule_end) . "</h1> <div class='single_user_addr_actions'> <span title='Editar Horário' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_class_schedule_modal' callback='Classes' callback_action='edit_class_schedule' id='{$class_schedule_id}'></span> <span title='Excluir Horário' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_schedule' id='{$class_schedule_id}'></span> </div> </div>"];
                    endif;

                    $divremove = [".js-trigger", ".js-class-schedules"];
                    $jSON['divremove'] = $divremove;
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Horário da Classe Foi Cadastrado Com Sucesso!"];
                else:
                    $ClassScheduleId = $PostData['class_schedule_id'];
                    unset($PostData['class_schedule_id']);
                    $Update->ExeUpdate(DB_CLASSES_SCHEDULES, $PostData, "WHERE class_schedule_id = :id", "id={$ClassScheduleId}");

                    //RealTime
                    $jSON['divcontent']['#classes-schedules'] = null;
    
                    $Read->ExeRead(DB_CLASSES_SCHEDULES, "ORDER BY class_schedule_id ASC");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $SCHEDULE):
                            extract($SCHEDULE);
                            
                            $jSON['divcontent']['#classes-schedules'] .= "<div class='single_user_addr js-rel-to' id='{$class_schedule_id}'> <h1 class='icon-clock'>" . getWeekDays($class_schedule_day) . " | " . getHours($class_schedule_start) . " - " . getHours($class_schedule_end) . "</h1> <div class='single_user_addr_actions'> <span title='Editar Horário' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_class_schedule_modal' callback='Classes' callback_action='edit_class_schedule' id='{$class_schedule_id}'></span> <span title='Excluir Horário' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_schedule' id='{$class_schedule_id}'></span> </div> </div>";
    
                        endforeach;
                    endif;
                    $jSON['divremove'] = ".js-class-schedules";
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Horário da Classe Foi Atualizado Com Sucesso!"];
                endif;
            endif;
            break;
            
         //EDITA MODAL HORÁRIO DAS CLASSES
         case 'edit_class_schedule':
            $ClassSchedulesId = $PostData['edit_id'];
            $Read->ExeRead(DB_CLASSES_SCHEDULES, "WHERE class_schedule_id = :id", "id={$ClassSchedulesId}");
            if ($Read->getResult()):
                $jSON['data'] = $Read->getResult()[0];
            else:
                $jSON['alert'] = ["red", "wondering2", "ERRO", "Você Tentou Editar Um Procedimento Que Não Existe Ou Foi Removido!"];
            endif;
            break;

        //DELETA HORÁRIO DAS CLASSES
        case 'delete_class_schedule':
            $ClassSchedulesDel = $PostData['del_id'];
            $Delete->ExeDelete(DB_CLASSES_SCHEDULES, "WHERE class_schedule_id = :id", "id={$ClassSchedulesDel}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Horário da Classe Foi Excluído Com Sucesso!"];
            break;

        //CADASTRA HORÁRIO DOS TIPOS  DAS CLASSES
        case 'create_class_type_schedule':
            $ClassTypesId = $PostData['class_type_id'];
            unset($PostData['class_type_id']);

            if (empty($PostData['class_type_schedule_day']) || empty($PostData['class_type_schedule_start']) || empty($PostData['class_type_schedule_end'])):
                $jSON['alert'] = ["red", "wondering2", "OPSSS {$_SESSION['userLogin']['user_name']}", "Para Cadastrar Um Horário, é Preciso Informar o Dia, o Horário de Início e o Horário de Término. Por Favor, Tente Novamente!"];
            else:
                if (empty($PostData['class_type_schedule_id'])):
                    //Realiza Cadastro
                    $PostData['class_type_id'] = $ClassTypesId;
                    $Create->ExeCreate(DB_CLASSES_TYPES_SCHEDULES, $PostData);

                    //Realtime
                    $jSON['add_content'] = null;

                    $Read->ExeRead(DB_CLASSES_TYPES_SCHEDULES, "WHERE class_type_schedule_id = :id", "id={$Create->getResult()}");
                    if ($Read->getResult()):
                        extract($Read->getResult()[0]);

                        $jSON['add_content'] = ['#classes-types-schedules' => "<div class='single_user_addr js-rel-to' id='{$class_type_schedule_id}'> <h1 class='icon-clock'>" . getWeekDays($class_type_schedule_day) . " | " . getHours($class_type_schedule_start) . " - " . getHours($class_type_schedule_end) . "</h1> <div class='single_user_addr_actions'> <span title='Editar Horário' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_class_type_schedule_modal' callback='Classes' callback_action='edit_class_type_schedule' id='{$class_type_schedule_id}'></span> <span title='Excluir Horário' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_type_schedule' id='{$class_type_schedule_id}'></span> </div> </div>"];
                    endif;

                    $divremove = [".js-trigger", ".js-class-types-schedules"];
                    $jSON['divremove'] = $divremove;
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Horário do Tipo da Classe Foi Cadastrado Com Sucesso!"];
                else:
                    $ClassTypesScheduleId = $PostData['class_type_schedule_id'];
                    unset($PostData['class_type_schedule_id']);
                    $Update->ExeUpdate(DB_CLASSES_TYPES_SCHEDULES, $PostData, "WHERE class_type_schedule_id = :id", "id={$ClassTypesScheduleId}");

                    //RealTime
                    $jSON['divcontent']['#classes-types-schedules'] = null;

                    $Read->ExeRead(DB_CLASSES_TYPES_SCHEDULES, "ORDER BY class_type_schedule_id ASC");
                    if ($Read->getResult()):
                        foreach ($Read->getResult() as $SCHEDULE):
                            extract($SCHEDULE);

                            $jSON['divcontent']['#classes-types-schedules'] .= "<div class='single_user_addr js-rel-to' id='{$class_type_schedule_id}'> <h1 class='icon-clock'>" . getWeekDays($class_type_schedule_day) . " | " . getHours($class_type_schedule_start) . " - " . getHours($class_type_schedule_end) . "</h1> <div class='single_user_addr_actions'> <span title='Editar Horário' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_class_type_schedule_modal' callback='Classes' callback_action='edit_class_type_schedule' id='{$class_type_schedule_id}'></span> <span title='Excluir Horário' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_type_schedule' id='{$class_type_schedule_id}'></span> </div> </div>";

                        endforeach;
                    endif;
                    $jSON['divremove'] = ".js-class-types-schedules";
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Horário do Tipo da Classe Foi Atualizado Com Sucesso!"];
                endif;
            endif;
            break;

        //EDITA MODAL HORÁRIO DOS TIPOS DAS CLASSES
        case 'edit_class_type_schedule':
            $ClassTypesSchedulesId = $PostData['edit_id'];
            $Read->ExeRead(DB_CLASSES_TYPES_SCHEDULES, "WHERE class_type_schedule_id = :id", "id={$ClassTypesSchedulesId}");
            if ($Read->getResult()):
                $jSON['data'] = $Read->getResult()[0];
            else:
                $jSON['alert'] = ["red", "wondering2", "ERRO", "Você Tentou Editar Um Procedimento Que Não Existe Ou Foi Removido!"];
            endif;
            break;

        //DELETA HORÁRIO DOS TIPOS  DAS CLASSES
        case 'delete_class_type_schedule':
            $ClassTypesSchedulesDel = $PostData['del_id'];
            $Delete->ExeDelete(DB_CLASSES_TYPES_SCHEDULES, "WHERE class_type_schedule_id = :id", "id={$ClassTypesSchedulesDel}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Horário do Tipo da Classe Foi Excluído Com Sucesso!"];
            break;

	    //CADASTRA TREINADOR DA CLASSE
        case 'create_class_trainee':
            $ClassId = $PostData['class_id'];
            unset($PostData['class_id']);
            
            if (empty($PostData['trainee_id'])):
                $jSON['alert'] = ["yellow", "warning", "OPSSS {$_SESSION['userLogin']['user_name']}", "Para Realizar o Cadastro, é Preciso Escolher Um Treinador. Por Favor, Tente Novamente!"];
            else:
                if (empty($PostData['class_trainee_id'])):
                    //Realiza Cadastro
                    $PostData['class_id'] = $ClassId;
                    $PostData['class_trainee_datecreate'] = date("Y-m-d H:i:s");
                    $Create->ExeCreate(DB_CLASSES_TRAINEES, $PostData);

                    //Realtime
                    $jSON['add_content'] = null;

                    $Read->FullRead(
                    "SELECT "
                    . "c.class_id, "
                    . "c.trainee_id, "
                    . "c.class_trainee_id, "
                    . "c.class_trainee_datecreate, "
                    . "t.trainee_name, "
                    . "t.trainee_email, "
                    . "t.trainee_cover, "
                    . "t.trainee_specialty "
                    . "FROM " . DB_CLASSES_TRAINEES . " c "
                    . "INNER JOIN " . DB_TRAINEES . " t ON t.trainee_id = c.trainee_id "
                    . "WHERE c.class_id = :class "
                    . "AND c.class_trainee_id = :id "
                    . "ORDER BY class_trainee_datecreate DESC", "class={$ClassId}&id={$Create->getResult()}"
                    );

                    if ($Read->getResult()):
                        extract($Read->getResult()[0]);

                        $TraineeCover = "../uploads/{$trainee_cover}";
                        $trainee_cover = (file_exists($TraineeCover) && !is_dir($TraineeCover) ? "uploads/{$trainee_cover}" : 'admin/_img/no_avatar.jpg');
                        $jSON['add_content'] = ['#class-trainees' => "<article class='single_user box box33 al_center js-rel-to' id='{$class_trainee_id}' > <div class='box_content wc_normalize_height'> <img alt='Este é {$trainee_name}' title='Este é {$trainee_name}' src='../tim.php?src={$trainee_cover}&w=400&h=400'/> <h1>{$trainee_name}</h1> <div class='m_top'></div> <p class='info icon-profile'>" . getSpecialtiesTrainees($trainee_specialty) . "</p> <p class='info icon-envelop'>" . $trainee_email . "</p> <p class='info icon-phone'>" . $trainee_telephone . "</p></div> <div class='single_user_actions'> <a title='Editar Treinador' class='btn_header btn_darkgreen icon-pencil icon-notext' href='dashboard.php?wc=treinadores/create&id={$trainee_id}'></a> <span title='Excluir Treinador' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_trainee' id='{$class_trainee_id}'></span> </div> </article>"];
                    endif;

                    $divremove = [".js-trigger", ".js-class-trainees"];
                    $jSON['divremove'] = $divremove;
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Treinador da Classe Foi Cadastrado Com Sucesso!"];
               endif;
            endif;
            break;
		
		//DELETA TREINADOR DA CLASSE
        case 'delete_class_trainee':
            $ClassTraineesDel = $PostData['del_id'];
            $Delete->ExeDelete(DB_CLASSES_TRAINEES, "WHERE class_trainee_id = :id", "id={$ClassTraineesDel}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Treinador da Classe Foi Excluído Com Sucesso!"];
            break;

        //CADASTRA TREINADOR DO TIPO DA CLASSE
        case 'create_class_type_trainee':
            $ClassTypesId = $PostData['class_type_id'];
            unset($PostData['class_type_id']);

            if (empty($PostData['trainee_id'])):
                $jSON['alert'] = ["yellow", "warning", "OPSSS {$_SESSION['userLogin']['user_name']}", "Para Realizar o Cadastro, é Preciso Escolher Um Treinador. Por Favor, Tente Novamente!"];
            else:
                if (empty($PostData['class_type_trainee_id'])):
                    //Realiza Cadastro
                    $PostData['class_type_id'] = $ClassTypesId;
                    $PostData['class_type_trainee_datecreate'] = date("Y-m-d H:i:s");
                    $Create->ExeCreate(DB_CLASSES_TYPES_TRAINEES, $PostData);

                    //Realtime
                    $jSON['add_content'] = null;

                    $Read->FullRead(
                        "SELECT "
                        . "c.trainee_id, "
                        . "c.class_type_id, "
                        . "c.class_type_trainee_id, "
                        . "c.class_type_trainee_datecreate, "
                        . "t.trainee_name, "
                        . "t.trainee_email, "
                        . "t.trainee_telephone, "
                        . "t.trainee_cover, "
                        . "t.trainee_specialty "
                        . "FROM " . DB_CLASSES_TYPES_TRAINEES . " c "
                        . "INNER JOIN " . DB_TRAINEES . " t ON t.trainee_id = c.trainee_id "
                        . "WHERE c.class_type_id = :class "
                        . "AND c.class_type_trainee_id = :id "
                        . "ORDER BY class_type_trainee_datecreate DESC", "class={$ClassTypesId}&id={$Create->getResult()}"
                    );

                    if ($Read->getResult()):
                        extract($Read->getResult()[0]);

                        $TraineeCover = "../uploads/{$trainee_cover}";
                        $trainee_cover = (file_exists($TraineeCover) && !is_dir($TraineeCover) ? "uploads/{$trainee_cover}" : 'admin/_img/no_avatar.jpg');
                        $jSON['add_content'] = ['#class-types-trainees' => "<article class='single_user box box33 al_center js-rel-to' id='{$class_type_trainee_id}' > <div class='box_content wc_normalize_height'> <img alt='Este é {$trainee_name}' title='Este é {$trainee_name}' src='../tim.php?src={$trainee_cover}&w=400&h=400'/> <h1>{$trainee_name}</h1> <div class='m_top'></div> <p class='info icon-profile'>" . getSpecialtiesTrainees($trainee_specialty) . "</p> <p class='info icon-envelop'>" . $trainee_email . "</p> <p class='info icon-phone'>" . $trainee_telephone . "</p></div> <div class='single_user_actions'> <a title='Editar Treinador' class='btn_header btn_darkgreen icon-pencil icon-notext' href='dashboard.php?wc=treinadores/create&id={$trainee_id}'></a> <span title='Excluir Treinador' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_type_trainee' id='{$class_type_trainee_id}'></span> </div> </article>"];
                    endif;

                    $divremove = [".js-trigger", ".js-class-types-trainees"];
                    $jSON['divremove'] = $divremove;
                    $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Treinador do Tipo da Classe Foi Cadastrado Com Sucesso!"];
                endif;
            endif;
            break;

        //DELETA TREINADOR DO TIPO DA CLASSE
        case 'delete_class_type_trainee':
            $ClassTypesTraineesDel = $PostData['del_id'];
            $Delete->ExeDelete(DB_CLASSES_TYPES_TRAINEES, "WHERE class_type_trainee_id = :id", "id={$ClassTypesTraineesDel}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "O Treinador do Tipo da Classe Foi Excluído Com Sucesso!"];
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
