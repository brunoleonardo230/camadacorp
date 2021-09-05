<?php

session_start();
require '../../_app/Config.inc.php';
$NivelAcess = LEVEL_WC_OFFERS;

if (!APP_OFFERS || empty($_SESSION['userLogin']) || empty($_SESSION['userLogin']['user_level']) || $_SESSION['userLogin']['user_level'] < $NivelAcess):
    $jSON['alert'] = ["red", "wondering2", "OPSSS", "Você Não Tem Permissão Para Essa Ação ou Não Está Logado Como Administrador!"];
    echo json_encode($jSON);
    die;
endif;

usleep(50000);

//DEFINE O CALLBACK E RECUPERA O POST
$jSON = null;
$CallBack = 'Offers';
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
        //GERENCIA OFERTA
        case 'manager':
            $OfferId = $PostData['offer_id'];
            unset($PostData['offer_id']);

            $Read->ExeRead(DB_OFFERS, "WHERE offer_id = :id", "id={$OfferId}");
            $ThisOffer = $Read->getResult()[0];

            if (!empty($_FILES['offer_image'])):
                $File = $_FILES['offer_image'];

                if ($ThisOffer['offer_image'] && file_exists("../../uploads/{$ThisOffer['offer_image']}") && !is_dir("../../uploads/{$ThisOffer['offer_image']}")):
                    unlink("../../uploads/{$ThisOffer['offer_image']}");
                endif;

                $Upload = new Upload('../../uploads/');
                $Upload->Image($File, Check::Name($PostData['offer_title']) . '-' . time(), IMAGE_W, 'ofertas');
                if ($Upload->getResult()):
                    $PostData['offer_image'] = $Upload->getResult();
                else:
                    $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Olá {$_SESSION['userLogin']['user_name']}, Selecione Uma Imagem JPG Ou PNG Para Enviar Como Capa!"];
                    echo json_encode($jSON);
                    return;
                endif;
            else:
                unset($PostData['offer_image']);
            endif;

            $PostData['offer_price'] = (floatval($PostData['offer_price']));
            $PostData['offer_price_new'] = (floatval($PostData['offer_price_new']));

            $PostData['offer_percent'] = (!empty($PostData['offer_price']) && !empty($PostData['offer_price_new']) ? ((($PostData['offer_price']) - ($PostData['offer_price_new'])) / ($PostData['offer_price']) * 100) : 0.00);
            $PostData['offer_name'] = (!empty($PostData['offer_name']) ? Check::Name($PostData['offer_name']) : Check::Name($PostData['offer_title']));
            $PostData['offer_status'] = (!empty($PostData['offer_status']) ? '1' : '0');
            $PostData['offer_datecreate'] = (!empty($PostData['offer_datecreate']) ? Check::Data($PostData['offer_datecreate']) : date('Y-m-d H:i:s'));

            $Update->ExeUpdate(DB_OFFERS, $PostData, "WHERE offer_id = :id", "id={$OfferId}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Oferta <b>{$PostData['offer_title']}</b> Foi Atualizada Com Sucesso!"];
            break;

        //DELETE OFERTA
        case 'delete':
            $PostData['offer_id'] = $PostData['del_id'];
            $Read->FullRead("SELECT offer_image FROM " . DB_OFFERS . " WHERE offer_id = :ps", "ps={$PostData['offer_id']}");
            if ($Read->getResult() && file_exists("../../uploads/{$Read->getResult()[0]['offer_image']}") && !is_dir("../../uploads/{$Read->getResult()[0]['offer_image']}")):
                unlink("../../uploads/{$Read->getResult()[0]['offer_image']}");
            endif;

            $Delete->ExeDelete(DB_OFFERS, "WHERE offer_id = :id", "id={$PostData['offer_id']}");
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Oferta Foi Excluída Com Sucesso!"];
            break;

        //IMAGENS DA GALERIA 
        case 'gallery_image':
            $OfferId = $PostData['offer_id'];//ID DO OFERTA QUE SERÁ ATUALIZADO
            unset($PostData['offer_id']);
            $GalleryImages = $_FILES['offer_gallery_images'];//ARRAY COM AS IMAGENS

            //VERIFICA SE O OFERTA EXISTE
            $Read->FullRead("SELECT offer_title FROM " . DB_OFFERS . " WHERE offer_id = :id", "id={$OfferId}");
            if (!$Read->getResult()):
                $jSON['alert'] = ["yellow", "image", "ERRO AO ENVIAR IMAGEM", "Desculpe {$_SESSION['userLogin']['user_name']}, Mas Não Foi Possível Identificar a Galeria Vinculada!"];
            else:
                $OfferTitle = $Read->getResult()[0]['offer_title'];
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
                    $Upload->Image($gbUpload, Check::Name($OfferTitle) . '-' . $i . time() , IMAGE_W, 'offers-gallery');

                    if ($Upload->getResult()):
                        $PostData['offer_id'] = $OfferId;
                        $PostData['offer_gallery_file'] = $Upload->getResult();
                        $PostData['offer_gallery_legend'] = $OfferTitle;
                        $Create->ExeCreate(DB_OFFERS_GALLERY, $PostData);
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
            $Read->ExeRead(DB_OFFERS_GALLERY, "WHERE offer_id = :id ORDER BY offer_gallery_order ASC", "id={$OfferId}");
            if (!$Read->getResult()):
                Erro('Ainda Não Existe Nenhuma Foto Nessa Galeria!', E_USER_NOTICE);
            else:
                $GalleryHtml = '';
                foreach ($Read->getResult() as $gallery):
                    extract($gallery);
                    $GalleryHtml = $GalleryHtml . "<div class='panel_gallery_image wc_draganddrop' callback='Offers' callback_action='gallery_image_order' id='{$offer_gallery_id}' data-id='{$offer_gallery_id}' >" .
                        "<img src='../tim.php?src=uploads/{$offer_gallery_file}&w=200&h=200'>" .
                        "<div class='panel_gallery_action'><ul class='buttons'>" .
                        "<li><span title='Excluir Imagem' rel='panel_gallery_image' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Offers' callback_action='gallery_image_delete' id='{$offer_gallery_id}'></span></li>" .
                        "</ul></div>" .
                        "</div>" .
                        "<script src=" . BASE ."/admin/_siswc/ofertas/ofertas.js></script>";
                endforeach;
            endif;
            $jSON['gallery'] = $GalleryHtml;
            break;

        //ORDENA IMAGEM DA GALERIA    
        case 'gallery_image_order':
            if (is_array($PostData['Data'])):
                foreach ($PostData['Data'] as $RE):
                    $UpdateCourse = ['offer_gallery_order' => $RE[1]];
                    $Update->ExeUpdate(DB_OFFERS_GALLERY, $UpdateCourse, "WHERE offer_gallery_id = :gallery", "gallery={$RE[0]}");
                endforeach;

                $jSON['sucess'] = true;
            endif;
            break;

        //DELETA IMAGEM DA GALERIA    
        case 'gallery_image_delete':
            $Read->FullRead("SELECT offer_gallery_file FROM " . DB_OFFERS_GALLERY . " WHERE offer_gallery_id = :ps", "ps={$PostData['del_id']}");
            if ($Read->getResult()):
                $ImageRemove = "../../uploads/{$Read->getResult()[0]['offer_gallery_file']}";
                if (file_exists($ImageRemove) && !is_dir($ImageRemove)):
                    unlink($ImageRemove);
                endif;
            endif;

            $Delete->ExeDelete(DB_OFFERS_GALLERY, "WHERE offer_gallery_id = :id", "id={$PostData['del_id']}");

            $jSON['success'] = true;
            $jSON['alert'] = ["green", "checkmark", "TUDO CERTO {$_SESSION['userLogin']['user_name']}", "A Imagem Foi Excluída Com Sucesso!"];
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
