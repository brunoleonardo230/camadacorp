<?php

/*
 * BANCO DE DADOS
 */
if ($_SERVER['HTTP_HOST'] == 'camadacorp.test'):
    define('SIS_DB_HOST', 'localhost'); //Link do banco de dados no servidor
    define('SIS_DB_USER', 'root'); //Usu�rio do banco de dados no servidor
    define('SIS_DB_PASS', ''); //Senha  do banco de dados no servidor
    define('SIS_DB_DBSA', 'gym'); //Nome  do banco de dados no servidor    
else:
    define('SIS_DB_HOST', 'localhost'); //Link do banco de dados no localhost
    define('SIS_DB_USER', 'u837848876_gym'); //Usu�rio do banco de dados no localhost
    define('SIS_DB_PASS', 'f]XAiRK7'); //Senha  do banco de dados no localhost
    define('SIS_DB_DBSA', 'u837848876_gym'); //Nome  do banco de dados no localhost
endif;
/*
/*
 * CACHE E CONFIG
 */
define('SIS_CACHE_TIME', 10); //Tempo em Minutos de Sess�o
define('SIS_CONFIG_WC', 1); //Registrar Configura��es No Banco Para Gerenciar Pelo Painel!
/*
 * AUTO MANAGER
 */
define('DB_AUTO_TRASH', 0); //Remove Todos os Itens N�o Gerenciados Do Banco!
define('DB_AUTO_PING', 0); //Tenta Enviar 1x Por Dia o Sitemap e o Rss Para o Google/Bing

/*
 * TABELAS
 */
define('DB_CONF', 'ws_config'); //Tabela de Configura��es
define('DB_USERS', 'ws_users'); //Tabela de Usu�rios
define('DB_USERS_ADDR', 'ws_users_address'); //Tabela de Endere�o de Usu�rios
define('DB_USERS_NOTES', 'ws_users_notes'); //Tabela de Notas do Usu�rio
define('DB_POSTS', 'ws_posts'); //Tabela de Posts
define('DB_POSTS_IMAGE', 'ws_posts_images'); //Tabela de Imagens de Post
define('DB_CATEGORIES', 'ws_categories'); //Tabela de Categorias de Posts
define('DB_SEARCH', 'ws_search'); //Tabela de Pesquisas
define('DB_PAGES', 'ws_pages'); //Tabela de P�ginas
define('DB_PAGES_IMAGE', 'ws_pages_images'); //Tabela de Imagens da P�gina
define('DB_COMMENTS', 'ws_comments'); //Tabela de Coment�rios
define('DB_COMMENTS_LIKES', 'ws_comments_likes'); //Tabela GOSTEI dos Coment�rios
define('DB_PDT', 'ws_products'); //Tabela de Produtos
define('DB_PDT_STOCK', 'ws_products_stock'); //Tabela de Estoque Por Varia��o
define('DB_PDT_IMAGE', 'ws_products_images'); //Tabela de Imagem de Produtos
define('DB_PDT_GALLERY', 'ws_products_gallery'); //Tabela de Galeria de Produtos
define('DB_PDT_CATS', 'ws_products_categories'); //Tabela de Categorias de Produtos
define('DB_PDT_BRANDS', 'ws_products_brands'); //Tabela de Fabricantes / Marcas de Produtos
define('DB_PDT_COUPONS', 'ws_products_coupons'); //Tabela de Cupons de Desconto
define('DB_ORDERS', 'ws_orders'); //Tabela de Pedidos
define('DB_IMOBI', 'ws_properties'); //Tabela de Im�veis WS IMOBI
define('DB_IMOBI_GALLERY', 'ws_properties_gallery'); //Tabela de Galeria de Im�veis
define('DB_SLIDES', 'ws_slides'); //Tabela de Conte�do em Destaque
define('DB_ORDERS_ITEMS', 'ws_orders_items'); //Tabela de Itens do Pedido
define('DB_VIEWS_VIEWS', 'ws_siteviews_views'); //Controle de Acesso ao Site
define('DB_VIEWS_ONLINE', 'ws_siteviews_online'); //Controle de Usu�rios Online
define('DB_WC_API', 'workcontrol_api'); //Controle de API do WC
define('DB_WC_CODE', 'workcontrol_code'); //Controle de Code de WC

/*
 * TABELAS PERSONALIZADAS PADR�O
 */
define('DB_HELLO', 'ws_hellobar'); //Tabela da HelloBar
define('DB_GALLERY', 'ws_gallery'); //Tabela para informa��es da galeria.php
define('DB_GALLERY_IMAGES', 'ws_gallery_images'); //Tabela para as imagens da galeria.php
define('DB_GALLERY_VIDEOS', 'ws_gallery_videos'); //Tabela para galeria.php de v�deos
define('DB_CONTACTS', 'ws_contacts'); //Newsletter
define('DB_TESTIMONIALS', 'ws_testimonials'); //Tabela de Depoimentos
define('DB_FAQ', 'ws_faq'); //Tabela de FAQ
define('DB_TUTORIAIS', 'ws_tutoriais'); //Tabela de Tutoriais
define('DB_COMPANY', 'ws_company'); //Tabela de Empresas
define('DB_COMPANY_GALLERY', 'ws_company_gallery'); //Tabela de Galeria de Imagens das Empresas
define('DB_COMPANY_BLOCKS', 'ws_company_blocks'); //Tabela de Blocos Descri��o da Empresa
define('DB_COMPANY_DIFFERENTIALS', 'ws_company_differentials'); //Tabela de Diferenciais da Empresa
define('DB_COMPANY_FAQ', 'ws_company_faq'); //Tabela de FAQ da Empresa
define('DB_BRANDS', 'ws_brands'); //Tabela de Marcas Parceiras

/* SERVI�OS (EXIBIDOS NO SITE) */
define('DB_SERVICES', 'ws_services'); //Tabela dos Servi�os da Academia
define('DB_SERVICES_TYPES', 'ws_services_types'); //Tabela dos Tipos dos Servi�os da Academia

/* TRAINEES */
define('DB_TRAINEES', 'ws_trainees'); //Tabela de Informa��es dos Professores
define('DB_TRAINEES_GALLERY', 'ws_trainees_gallery'); //Tabela de Informa��es dos Professores

/* CLASSES (EXIBIDOS NO SITE) */
define('DB_CLASSES', 'ws_classes'); //Tabela das Classes
define('DB_CLASSES_GALLERY', 'ws_classes_gallery'); //Tabela de Galeria das Classes
define('DB_CLASSES_SCHEDULES', 'ws_classes_schedules'); //Tabela de Horários das Classes
define('DB_CLASSES_TRAINEES', 'ws_classes_trainees'); //Tabela de Treinadores das Classes
define('DB_CLASSES_TYPES', 'ws_classes_types'); //Tabela dos Tipos das Classes
define('DB_CLASSES_TYPES_GALLERY', 'ws_classes_types_gallery'); //Tabela de Galeria dos Tipos das Classes
define('DB_CLASSES_TYPES_SCHEDULES', 'ws_classes_types_schedules'); //Tabela de Horários dos Tipos das Classes
define('DB_CLASSES_TYPES_TRAINEES', 'ws_classes_types_trainees'); //Tabela de Treinadores dos Tipos das Classes

/* PLANOS (EXIBIDOS NO SITE) */
define('DB_PLANS', 'ws_plans'); //Tabela dos Planos 
define('DB_PLANS_BENEFITS', 'ws_plans_benefits'); //Tabela dos Benefícios dos Plnos 

/* PRODUTOS (EXIBIDOS NO SITE) */
define('DB_OFFERS', 'ws_offers'); //Tabela dos Produtos em Oferta 
define('DB_OFFERS_GALLERY', 'ws_offers_gallery'); //Tabela da Galeria dos Produtos em Oferta 

/* AGENDAMENTOS (PELO SITE) */
define('DB_SCHEDULES', 'ws_schedules'); //Tabela de Agendamentos Pelo Site

/*
 * EAD DBSA
 */
define('DB_EAD_COURSES', 'ws_ead_courses'); //Tabela de Cursos
define('DB_EAD_COURSES_BONUS', 'ws_ead_courses_bonus'); //Tabela de B�nus para Cursos
define('DB_EAD_COURSES_SEGMENTS', 'ws_ead_courses_segments'); //Tabela de segmentos de cursos
define('DB_EAD_MODULES', 'ws_ead_modules'); //Tabela de M�dulos
define('DB_EAD_CLASSES', 'ws_ead_classes'); //Tabela de Aulas
define('DB_EAD_ENROLLMENTS', 'ws_ead_enrollments'); //Tabela de Matr�culas
define('DB_EAD_ORDERS', 'ws_ead_orders'); //Tabela de Pedidos
define('DB_EAD_SUPPORT', 'ws_ead_support'); //Tabela de D�vidas
define('DB_EAD_SUPPORT_REPLY', 'ws_ead_support_reply'); //Tabela de Respostas
define('DB_EAD_STUDENT_CLASSES', 'ws_ead_student_classes'); //Tabela de Matr�culas
define('DB_EAD_STUDENT_CERTIFICATES', 'ws_ead_student_certificates'); //Tabela de Certificados
define('DB_EAD_STUDENT_DOWNLOADS', 'ws_ead_student_downloads'); //Tabela de Downloads do Curso


/*
  AUTO LOAD DE CLASSES
 */

function MyAutoLoad($Class)
{
    $cDir = ['Conn', 'Helpers', 'Models', 'WorkControl'];
    $iDir = null;

    foreach ($cDir as $dirName):
        if (!$iDir && file_exists(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php') && !is_dir(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php')):
            include_once(__DIR__ . '/' . $dirName . '/' . $Class . '.class.php');
            $iDir = true;
        endif;
    endforeach;
}

spl_autoload_register("MyAutoLoad");

/*
 * Define Todas as Constantes do Banco Dando Sua Devida Prefer�ncia!
 */
$WorkControlDefineConf = null;
if (SIS_CONFIG_WC):
    $Read = new Read;
    $Read->FullRead("SELECT conf_key, conf_value FROM " . DB_CONF);
    if ($Read->getResult()):
        foreach ($Read->getResult() as $WorkControlDefineConf):
            if ($WorkControlDefineConf['conf_key'] != 'THEME' || empty($_SESSION['WC_THEME'])):
                define("{$WorkControlDefineConf['conf_key']}", "{$WorkControlDefineConf['conf_value']}");
            endif;
        endforeach;
        $WorkControlDefineConf = true;
    endif;
endif;

require 'Config/Config.inc.php';
require 'Config/Agency.inc.php';
require 'Config/Client.inc.php';

/*
 * Exibe erros lan�ados
 */

function Erro($ErrMsg, $ErrNo = null)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? 'trigger_info' : ($ErrNo == E_USER_WARNING ? 'trigger_alert' : ($ErrNo == E_USER_ERROR ? 'trigger_error' : 'trigger_success')));
    echo "<div class='trigger {$CssClass} js-trigger'>{$ErrMsg}<span class='ajax_close'></span></div>";
}

/*
 * Exibe erros lan�ados por ajax
 */

function AjaxErro($ErrMsg, $ErrNo = null)
{
    $CssClass = ($ErrNo == E_USER_NOTICE ? 'trigger_info' : ($ErrNo == E_USER_WARNING ? 'trigger_alert' : ($ErrNo == E_USER_ERROR ? 'trigger_error' : 'trigger_success')));
    return "<div class='trigger trigger_ajax {$CssClass}'>{$ErrMsg}<span class='ajax_close'></span></div>";
}

/*
 * personaliza o gatilho do PHP
 */

function PHPErro($ErrNo, $ErrMsg, $ErrFile, $ErrLine)
{
    echo "<div class='trigger trigger_error'>";
    echo "<b>Erro na Linha: #{$ErrLine} ::</b> {$ErrMsg}<br>";
    echo "<small>{$ErrFile}</small>";
    echo "<span class='ajax_close'></span></div>";

    if ($ErrNo == E_USER_ERROR):
        die;
    endif;
}

set_error_handler('PHPErro');


/*
 * Descreve N�vel de Usu�rio
 */

function getWcLevel($Level = null)
{
    $UserLevel = [
        1 => 'Cliente (User)',
        2 => 'Assinante (User)',
        6 => 'Colaborador (Admin)',
        7 => 'Suporte Geral (Admin)',
        8 => 'Gerente Geral (Admin)',
        9 => 'Administrador (Admin)',
        10 => 'Super Admin (Admin)'
    ];

    if (!empty($Level)):
        return $UserLevel[$Level];
    else:
        return $UserLevel;
    endif;
}

/*
 * Descreve Status de Pedidos
 */

function getOrderStatus($Status = null)
{
    $OrderStatus = [
        1 => 'Conclu�do',
        2 => 'Cancelado',
        3 => 'Novo Pedido',
        4 => 'Agd. Pagamento', //OPERADORA
        5 => 'Agd. Pagamento', //CONFIRMA��O MANUAL (BOLETO, DEP�SITO)
        6 => 'Processando'
    ];

    if (!empty($Status)):
        return $OrderStatus[$Status];
    else:
        return $OrderStatus;
    endif;
}

/*
 * Descreve Tipos de Pagamentos
 */

function getOrderPayment($Payment = null)
{
    $Payments = [
        1 => 'Pendente',
        101 => 'Cart�o de Cr�dito', //PAGSEGURO
        102 => 'Boleto Banc�rio' //PAGSEGURO
    ];

    if (!empty($Payment)):
        return $Payments[$Payment];
    else:
        return $Payments;
    endif;
}

/*
 * Fator Multiplicador PagSeguro
 * https://pagseguro.uol.com.br/para_seu_negocio/parcelamento_com_acrescimo.jhtml#rmcl
 * @author: Whallysson Avelino <whallyssonallain@gmail.com>
 */

function getFactor($Factor = null)
{
    $FactorMult = [
        1 => 1.00000,
        2 => 0.52255,
        3 => 0.35347,
        4 => 0.26898,
        5 => 0.21830,
        6 => 0.18453,
        7 => 0.16044,
        8 => 0.14240,
        9 => 0.12838,
        10 => 0.11717,
        11 => 0.10802,
        12 => 0.10040,
        13 => 0.09397,
        14 => 0.08846,
        15 => 0.08371,
        16 => 0.07955,
        17 => 0.07589,
        18 => 0.07265
    ];
    if (!empty($Factor)):
        return $FactorMult[$Factor];
    else:
        return $FactorMult;
    endif;
}

/*
 * Recupera Meios de Entrega
 */

function getShipmentTag($Tag = null)
{
    $ArrShipment = [
        '10001' => 'Envio Padr�o', //C�digo para envio pela transportadora
        '10002' => 'Envio Gratis', //C�digo para envio sem custo
        '10003' => 'Envio Fixo', //C�digo para envio de frete fixo
        '10004' => 'Taxa de Entrega', //Taxa de Entrega
        '10005' => 'Retirar na Loja', //ID para o app de criar pedido
        '40010' => 'Sedex', //40010 SEDEX sem contrato.
        '40045' => 'Sedex a Cobrar', //40045 SEDEX a Cobrar, sem contrato.
        '40126' => 'Sedex a Cobrar', //40126 SEDEX a Cobrar, com contrato.
        '40215' => 'Sedex 10', //40215 SEDEX 10, sem contrato.
        '40290' => 'Sedex Hoje', //40290 SEDEX Hoje, sem contrato.
        '40096' => 'Sedex', //40096 SEDEX com contrato.
        '40436' => 'Sedex', //40436 SEDEX com contrato.
        '40444' => 'Sedex', //40444 SEDEX com contrato.
        '40568' => 'Sedex', //40568 SEDEX com contrato.
        '40606' => 'Sedex', //40606 SEDEX com contrato.
        '41106' => 'PAC', //41106 PAC sem contrato.
        '41068' => 'PAC', //41068 PAC com contrato.
        '81019' => 'e-Sedex', //81019 e-SEDEX, com contrato.
        '81027' => 'e-Sedex Priorit�rio', //81027 e-SEDEX Priorit�rio, com contrato.
        '81035' => 'e-Sedex Express', //81035 e-SEDEX Express, com contrato.
        '81868' => 'e-Sedex', //81868 (Grupo 1) e-SEDEX, com contrato.
        '81833' => 'e-Sedex', //81833 (Grupo 2) e-SEDEX, com contrato.
        '81850' => 'e-Sedex', //81850 (Grupo 3) e-SEDEX, com contrato.
        '4014' => 'Sedex', // Novo c�digo de servi�o dos correios 2017-05
        '4510' => 'PAC' // Novo c�digo de servi�o dos correios 2017-05
    ];

    if (!empty($Tag) && array_key_exists($Tag, $ArrShipment)):
        return $ArrShipment[$Tag];
    else:
        return $ArrShipment;
    endif;
}

/*
 * Recupera Tipos de im�veis
 */

function getWcRealtyType($Type = null)
{
    $RealtyTypes = [
        1 => 'Apartamento',
        2 => '�rea',
        3 => 'Casa',
        4 => 'Galp�o',
        5 => 'Pousada',
        6 => 'Pr�dio',
        7 => 'Sala',
        8 => 'Terreno'
    ];
    if (!empty($Type)):
        return $RealtyTypes[$Type];
    else:
        return $RealtyTypes;
    endif;
}

function getWcRealtyFinality($Finality = null)
{
    $RealtyFinality = [
        1 => 'Comercial',
        2 => 'Residencial'
    ];
    if (!empty($Finality)):
        return $RealtyFinality[$Finality];
    else:
        return $RealtyFinality;
    endif;
}

function getWcRealtyTransaction($Transaction = null)
{
    $RealtyTransaction = [
        1 => 'Alugar',
        2 => 'Comprar',
        3 => 'Temporada'
    ];
    if (!empty($Transaction)):
        return $RealtyTransaction[$Transaction];
    else:
        return $RealtyTransaction;
    endif;
}

function getWcRealtyNote($Note = null)
{
    $RealtyNotes = [
        1 => 'Destaque',
        2 => 'Lan�amento',
        3 => 'Reservado',
        4 => 'Locado',
        5 => 'Vendido',
        6 => 'Indispon�vel',
    ];
    if (!empty($Note)):
        return $RealtyNotes[$Note];
    else:
        return $RealtyNotes;
    endif;
}

function getWcHotmartStatus($Status = null)
{
    $HotmartStatus = [
        'started' => 'Iniciado',
        'billet_printed' => 'Boleto Impresso',
        'pending_analysis' => 'Pendente',
        'delayed' => 'Atrasado',
        'canceled' => 'Cancelado',
        'approved' => 'Aprovado',
        'completed' => 'Conclu�do',
        'chargeback' => 'Chargeback',
        'blocked' => 'Bloqueado',
        'refunded' => 'Devolvido',
        'admin_free' => 'Cadastrado'
    ];
    if (!empty($Status)):
        return $HotmartStatus[$Status];
    else:
        return $HotmartStatus;
    endif;
}

function getWcHotmartStatusClass($Status = null)
{
    $HotmartStatus = [
        'started' => 'blue icon-checkmark2',
        'billet_printed' => 'blue icon-barcode',
        'pending_analysis' => 'blue icon-history',
        'delayed' => 'yellow icon-alarm',
        'canceled' => 'red icon-cancel-circle',
        'approved' => 'green icon-checkmark',
        'completed' => 'green icon-checkbox-checked',
        'chargeback' => 'yellow icon-warning',
        'blocked' => 'red icon-lock',
        'refunded' => 'red icon-cross',
        'admin_free' => 'green icon-bell'
    ];
    if (!empty($Status)):
        return $HotmartStatus[$Status];
    else:
        return $HotmartStatus;
    endif;
}

require 'Config/Functions.inc.php';

