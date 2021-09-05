<?php

if (!$WorkControlDefineConf):
    /*
     * URL DO SISTEMA
     */
    if($_SERVER['HTTP_HOST'] == 'http://camadacorp.test'):
        define('BASE', 'http://camadacorp.test/site/gym_three'); //Url Raiz do Site no localhost
    else:
        define('BASE', 'http://camadacorp.com.br/site/gym_three'); //Url Raiz do Site no Servidor
    endif;
    define('THEME', 'gym_three'); //Template do Site
endif;

//DINAMYC THEME
if (!empty($_SESSION['WC_THEME'])):
    define('THEME', $_SESSION['WC_THEME']); //Template do Site
endif;

/*
 * PATCH CONFIG
 */
define('INCLUDE_PATH', BASE . '/themes/' . THEME); //Geral de Inclusão (Não Alterar)
define('REQUIRE_PATH', 'themes/' . THEME); //Geral de Inclusão (Não Alterar)

if (!$WorkControlDefineConf):
    /*
     * ADMIN CONFIG
     */
    define('ADMIN_NAME', 'Work Control');  //Nome do Painel de Controle (Work Control)
    define('ADMIN_DESC', 'O Work Control é um sistema de gestão de conteúdo profissional gerido pela turma de alunos Work Series da UpInside Treinamentos!'); //Descrição do Painel de Controle (WorkControl)
    define('ADMIN_MODE', 1); //1 = Website / 2 = E-commerce / 3 = Imobi / 4 = EAD
    define('ADMIN_WC_CUSTOM', 1); //Habilita Menu e Telas Customizadas
    define('ADMIN_MAINTENANCE', 0); //Manutenção
    define('ADMIN_VERSION', '3.1.4');

    /*
     * E-MAIL SERVER
     * Consulte Estes Dados Com o Serviço de Hospedagem
     */
    define('MAIL_HOST', ''); //Servidor de E-mail
    define('MAIL_PORT', ''); //Porta de Envio
    define('MAIL_USER', ''); //E-mail de Envio
    define('MAIL_SMTP', ''); //E-mail Autenticador do Envio (Geralmente Igual ao mail_user, Exceto Em Serviços Como Amazon, Sendgrid,...)
    define('MAIL_PASS', ''); //Senha do E-mail de Envio
    define('MAIL_SENDER', ''); //Nome do Remetente de E-mail
    define('MAIL_MODE', ''); //Encriptação Para Envio de E-mail [0 Não Parametrizar / tls / ssl] (Padrão = tls)
    define('MAIL_TESTER', ''); //E-mail de Testes (DEV)

    /*
     * MEDIA CONFIG
     */
    define('IMAGE_W', 1600); //Tamanho da Imagem (WIDTH)
    define('IMAGE_H', 800); //Tamanho da Imagem (HEIGHT)
    define('THUMB_W', 800); //Tamanho da Miniatura (WIDTH) PDTS
    define('THUMB_H', 1000); //Tamanho da Minuatura (HEIGHT) PDTS
    define('AVATAR_W', 500); //Tamanho da Miniatura (WIDTH) USERS
    define('AVATAR_H', 500); //Tamanho da Miniatura (HEIGHT) USERS
    define('SLIDE_W', 1920); //Tamanho da Miniatura (WIDTH) SLIDE
    define('SLIDE_H', 600); //Tamanho da Miniatura (HEIGHT) SLIDE

    /*
     * APP CONFIG
     * Habilitar ou Desabilitar Modos do Sistema
     */
    define('APP_POSTS', 1); //Posts
    define('APP_POSTS_AMP', 0); //AMP Para Posts
    define('APP_POSTS_INSTANT_ARTICLE', 0); //Instante Article FB
    define('APP_EAD', 0); //Plataforma EAD
    define('APP_SEARCH', 1); //Relatório de Pesquisas
    define('APP_PAGES', 1); //Páginas
    define('APP_COMMENTS', 1); //Comentários
    define('APP_PRODUCTS', 0); //Produtos
    define('APP_ORDERS', 0); //Pedidos
    define('APP_IMOBI', 0); //Imóveis
    define('APP_SLIDE', 1); //Slide Em Destaque
    define('APP_USERS', 1); //Usuários
    
    /*
     * CONFIGURAÇÕES APP FB REVIEWS
     */
    define('FBREVIEW_PAGE_ID', ''); //ID da Página no FB
    define('FBREVIEW_APP_ID', ''); //APP ID do Facebook
    define('FBREVIEW_APP_SECRET', ''); //APP Secret
    define('FBREVIEW_LIMIT', '25'); //Quantidade de Reviews a Ser Importado

    /*
     * APP CONFIG PERSONALIZADAS PADRÃO
     * Habilitar ou Desabilitar Modos do Sistema
     */
    define('APP_GALLERY', 1); //Galeria de Imagens
    define('APP_VIDEOS', 1); //Galeria de Imagens
    define('APP_CONTACTS', 1); //Contatos
    define('APP_FAQ', 1); //Faq
    define('APP_TESTIMONIALS', 1); //APP Depoimentos
    define('APP_FBREVIEW', 1); //Reviews FB
    define('APP_TUTORIAIS', 1); //Tutoriais
    define('APP_COMPANY', 1); //Empresa (Filiais)
    define('APP_BRANDS', 1); //Marcas Parceiras
    
    /*
    * APP CONFIG FITNESS
    * Habilitar ou Desabilitar Modos do Sistema
    */
    define('APP_TRAINEES', 1); //Treinadores
    define('APP_SERVICES', 1); //Serviços
    define('APP_CLASSES', 1); //Classes
    define('APP_SCHEDULES', 1); //Agendamentos
	define('APP_PLANS', 1); //Planos
	define('APP_OFFERS', 1); //Produtos Em Ofertas

    /*
     * LEVEL CONFIG
     * Configura Permissões do Painel de Controle!
     */
    define('LEVEL_WC_POSTS', 6); //Posts
    define('LEVEL_WC_COMMENTS', 6); //Comentários
    define('LEVEL_WC_PAGES', 6); //Páginas
    define('LEVEL_WC_SLIDES', 6); //Slides
    define('LEVEL_WC_IMOBI', 6); //Imobi
    define('LEVEL_WC_PRODUCTS', 6); //Produtos
    define('LEVEL_WC_PRODUCTS_ORDERS', 6); //Pedidos
    define('LEVEL_WC_EAD_COURSES', 6); //Cursos
    define('LEVEL_WC_EAD_STUDENTS', 6); //Estudantes
    define('LEVEL_WC_EAD_SUPPORT', 6); //Suporte EAD
    define('LEVEL_WC_EAD_ORDERS', 6); //Pedidos EAD
    define('LEVEL_WC_REPORTS', 6); //Relatórios
    define('LEVEL_WC_USERS', 6); //Usuários
    define('LEVEL_WC_CONFIG_MASTER', 10); //Configurações
    define('LEVEL_WC_CONFIG_API', 10); //API Configurações
    define('LEVEL_WC_CONFIG_CODES', 10); //Códigos Pixel
    
    /*
     * LEVEL CONFIG APP PERSONALIZADAS PADRÃO
     * Configura Permissões do Painel de Controle!
     */
    define('LEVEL_WC_HELLO', 6); //Hellobar
    define('LEVEL_WC_GALLERY', 6); //Galeria de Imagens
    define('LEVEL_WC_VIDEOS', 6); //Vídeos
    define('LEVEL_WC_CONTACTS', 6); //Lista de Contatos
    define('LEVEL_WC_FAQ', 6); //FAQ
    define('LEVEL_WC_TESTIMONIALS', 6); //Depoimentos
    define('LEVEL_WC_FBREVIEWS', 6); //FBReviews
    define('LEVEL_WC_TUTORIAIS', 6); //Tutoriais
    define('LEVEL_WC_COMPANY', 8); //A Empresa
    define('LEVEL_WC_BRANDS', 6); //Marcas Parceiras

    
    /*
     * LEVEL CONFIG APP FITNESS
     * Configura Permissões do Painel de Controle!
     */
    define('LEVEL_WC_TRAINEES', 6); //Treinadores
    define('LEVEL_WC_SERVICES', 6); //Serviços
    define('LEVEL_WC_CLASSES', 6); //Classes
    define('LEVEL_WC_SCHEDULES', 6); //Agendamentos
	define('LEVEL_WC_PLANS', 6); //Planos
	define('LEVEL_WC_OFFERS', 6); //Produtos Em Ofertas

    /*
     * FB SEGMENT
     * Configura Ultra Segmentação de Público No Facebook
     * !!!! IMPORTANTE :: Para Utilizar Ultra Segmentação de Produtos e Imóveis
     * é Precisso Antes Configurar os Catálogos de Produtos Respectivamente!
     */
    define('SEGMENT_FB_PIXEL_ID', ''); //Id do Pixel de Rastreamento
    define('SEGMENT_WC_USER', ''); //Enviar Dados do Login de Usuário?
    define('SEGMENT_WC_BLOG', ''); //Ultra Segmentar Páginas do BLOG?
    define('SEGMENT_WC_ECOMMERCE', ''); //Ultra Segmentar Páginas do E-COMMERCE?
    define('SEGMENT_WC_IMOBI', ''); //Ultra Segmentar Páginas do imobi?
    define('SEGMENT_WC_EAD', ''); //Ultra Segmentar Páginas do EAD?
    define('SEGMENT_GL_ANALYTICS_UA', ''); //ID do Google Analytics (UA-00000000-0)
    define('SEGMENT_FB_PAGE_ID', ''); //ID do Facebook Pages (Obrigatório Para POST - Instant Article)
    define('SEGMENT_GL_ADWORDS_ID', ''); //ID do Pixel do Adwords (Todo o Site)
    define('SEGMENT_GL_ADWORDS_LABEL', ''); //Label do Pixel do Adwords (Todo o Site)

    /*
     * APP LINKS
     * Habilitar ou Desabilitar Campos de Links Alternativos
     */
    define('APP_LINK_POSTS', 1); //Posts
    define('APP_LINK_PAGES', 1); //Páginas
    define('APP_LINK_PRODUCTS', 1); //Produtos
    define('APP_LINK_PROPERTIES', 1); //Imóveis

    /*
     * ACCOUNT CONFIG
     */
    define('ACC_MANAGER', 1); //Conta de Usuários (UI)
    define('ACC_TAG', 'Minha Conta!'); //null Para OLÁ {NAME} ou Texto (Minha Conta, Meu Cadastro, etc)

    /*
     * COMMENT CONFIG
     */
    define('COMMENT_MODERATE', 1); //Todos os NOVOS Comentários Ficam Ocultos até serem aprovados
    define('COMMENT_ON_POSTS', 1); //Aplica Comentários aos Posts
    define('COMMENT_ON_PAGES', 1); //Aplica Comentários as Páginas
    define('COMMENT_ON_PRODUCTS', 1); //Aplica Comentários aos Produtos
    define('COMMENT_SEND_EMAIL', 1); //Envia E-mails Transicionais Para Usuários Sobre Comentários
    define('COMMENT_ORDER', 'DESC'); //Ordem de Exibição dos Comentários (ASC ou DESC)
    define('COMMENT_RESPONSE_ORDER', 'ASC'); //Ordem de Exibição das Respostas (ASC ou DESC)

    /*
     * ECOMMERCE CONFIG
     * IMPORTANTE EM E_ORDER_PAYDATE: Um tempo muito grande para pagamento pode implicar
     * em extender descontos expirados. Uma oferta pode acabar e o usuário ainda consegue
     * pagar neste prazo de dias!
     */
    define('E_PDT_LIMIT', ''); //Limite de produtos cadastrados. NULL = sem limite
    define('E_PDT_SIZE', 'default'); //Tamanho padrão para produtos!
    define('E_ORDER_DAYS', ''); //Dias para cancelar pedidos não pagos (Novo Pedido)
    define('ECOMMERCE_TAG', 'Minhas Compras'); //Meu Carrinho, Minha Cesta, Minhas Compras, Etc;
    define('ECOMMERCE_STOCK', ''); //true para controlar o estoque e false para não! (Ainda será nessesário alimentar o estoque para o carrinho)
    define('ECOMMERCE_BUTTON_TAG', 'Comprar Agora'); //Meu Carrinho, Minha Cesta, Minhas Compras, Etc;
    /*
     * Parcelamento
     */
    define('ECOMMERCE_PAY_SPLIT', 1); //Aceita pagamento parcelado?
    define('ECOMMERCE_PAY_SPLIT_MIN', 5); //Qual valor mínimo da parcela? (consultar método de pagamento)
    define('ECOMMERCE_PAY_SPLIT_NUM', 12); //Qual o número máximo de parcelas? (consultar método de pagamento)
    define('ECOMMERCE_PAY_SPLIT_ACM', 2.99); //Juros aplicados ao mês! (consultar método de pagamento)
    define('ECOMMERCE_PAY_SPLIT_ACN', 1); //Parcelas sem Juros (consultar método de pagamento)

    /*
     * SHIPMENT CONFIG
     * 1. Frete gratuito a partir do valor X
     */
    define('ECOMMERCE_SHIPMENT_FREE', 0); //Opção de frete grátis a partir do valor X (Informe o valor ou false)
    define('ECOMMERCE_SHIPMENT_FREE_DAYS', 20); //Máximo de dias úteis para a entrega no frete gratuito!
    /*
     * Valor de frete fixo!
     */
    define('ECOMMERCE_SHIPMENT_FIXED', 0); //Oferecer frete com valor fixo?
    define('ECOMMERCE_SHIPMENT_FIXED_PRICE', 15.00); //Valor do frete fixo
    define('ECOMMERCE_SHIPMENT_FIXED_DAYS', 15); //Máximo de dias úteis para a entrega! 
    /*
     * Frete fixo por localidade!
     */
    define('ECOMMERCE_SHIPMENT_LOCAL', 0); //Entrega padrão para a Cidade (Ex: São Paulo, Florianópolis, false)
    define('ECOMMERCE_SHIPMENT_LOCAL_IN_PLACE', 1); //Permitir retirar na Loja?
    define('ECOMMERCE_SHIPMENT_LOCAL_PRICE', 5.00); //Taxa de entrega local! 
    define('ECOMMERCE_SHIPMENT_LOCAL_DAYS', 1); //Máximo de dias úteis para a entrega!
    /*
     * Frete por correios!
     */
    define('ECOMMERCE_SHIPMENT_CDEMPRESA', 0); //Usuário da empresa se tiver contrato com correios!
    define('ECOMMERCE_SHIPMENT_CDSENHA', 0); //Senha da empresa se tiver contrato com correios!
    define('ECOMMERCE_SHIPMENT_SERVICE', '04014,04510'); //Tipos de serviços a serem consultados! (Consultar em Config.inc.php Função getShipmentTag())
    define('ECOMMERCE_SHIPMENT_DELAY', 3); //Soma X dias ao prazo máximo de entrega dos correios!
    define('ECOMMERCE_SHIPMENT_FORMAT', 1); //1 Caixa/Pacote, 2 Rolo/Bobina ou 3 Envelope?
    define('ECOMMERCE_SHIPMENT_DECLARE', 1); //Declarar valor da compra para seguro?
    define('ECOMMERCE_SHIPMENT_OWN_HAND', 's'); //Postagem por mão própria? (s, n)
    define('ECOMMERCE_SHIPMENT_BY_WEIGHT', 1); //Cálculo deduzido apenas por peso?
    define('ECOMMERCE_SHIPMENT_ALERT', 0); //Aviso de recebimento?
    /*
     * Frete por transportadora
     */
    define('ECOMMERCE_SHIPMENT_COMPANY', 0); //Oferecer Transportadora?
    define('ECOMMERCE_SHIPMENT_COMPANY_VAL', 5); //Valor do frete por porcentagem do valor do pedido! (4% do valor do pedido)
    define('ECOMMERCE_SHIPMENT_COMPANY_PRICE', 30); //Valor mínimo para envio via transportadora. 100 = R$ 100
    define('ECOMMERCE_SHIPMENT_COMPANY_DAYS', 15); //Máximo de dias úteis para a entrega!
    define('ECOMMERCE_SHIPMENT_COMPANY_LINK', 'http://www.dhl.com.br/pt/express/rastreamento.html?AWB='); //Link para rastreamento (EX: http://www.dhl.com.br/pt/express/rastreamento.html?AWB=)

    /*
     * CONFIGURAÇÕES DE PAGAMENTO
     * É aconselhado criar um e-mail padrão para recebimento de pagamentos
     * como por exemplo pagamentos@site.com. E assim configurar todos os
     * meios de pagamentos nele. Para que o gestor da loja tenha acesso
     * as notificações de e-mail!
     * 
     * ATENÇÃO: Para utilizar o checkout transparente é preciso habilitar a
     * conta junto ao PagSeguro. Para isso:
     * 
     * Acesse: https://pagseguro.uol.com.br/receba-pagamentos.jhtml#checkout-transparent
     * Clique em Regras de uso - Uma modal abre!
     * Clique em entre em contato conosco. E informe os dados solicitados!
     * 
     * PAGSEGURO
     */
    define('PAGSEGURO_ENV', 'sandbox'); //sandbox para teste e production para vender!
    define('PAGSEGURO_EMAIL', ''); //E-mail do vendedor na pagseguro!
    define('PAGSEGURO_NOTIFICATION_EMAIL', ''); //E-mail para receber notificações e gerenciar pedidos!

    /*
     * SANDBOX (AMBIENTE DE TESTE)
     */
    define('PAGSEGURO_TOKEN_SANDBOX', ''); //Token Sandbox (https://sandbox.pagseguro.uol.com.br/vendedor/configuracoes.html)
    define('PAGSEGURO_APP_ID_SANDBOX', ''); //Id do APP Sandbox (https://sandbox.pagseguro.uol.com.br/aplicacao/configuracoes.html)
    define('PAGSEGURO_APP_KEY_SANDBOX', ''); //Chave do AP Sandbox

    /*
     * PRODUCTION (AMBIENTE REAL)
     */
    define('PAGSEGURO_TOKEN_PRODUCTION', ''); //Token de produção (https://pagseguro.uol.com.br/preferencias/integracoes.jhtml)
    define('PAGSEGURO_APP_ID_PRODUCTION', ''); //Id do APP de integração (https://pagseguro.uol.com.br/aplicacao/listagem.jhtml)
    define('PAGSEGURO_APP_KEY_PRODUCTION', ''); //Chave do APP de integração!

    /*
     * CONFIGURAÇÕES DO EAD
     */
    define('EAD_REGISTER', 0); //Permitir cadastro na plataforma?
    define('EAD_HOTMART_EMAIL', 0); //Email de produtor hotmart!
    define('EAD_HOTMART_TOKEN', 0); //Token da API do hotmart!
    define('EAD_HOTMART_NEGATIVATE', 0); //Id de produtos na hotmart que NÃO serão entregues!
    define('EAD_HOTMART_LOG', 0); //Gerar Log de vendas?
    define('EAD_TASK_SUPPORT_DEFAULT', 1); //Por padrão habilitar suporte em todas as aulas?
    define('EAD_TASK_SUPPORT_EMAIL', "suporte@seusite.com.br"); //Enviar alertas de novos tickets para?
    define('EAD_TASK_SUPPORT_MODERATE', 0); //Tickets devem ser aprovados por um admin?
    define('EAD_TASK_SUPPORT_STUDENT_RESPONSE', 0); //Alunos podem responder o suporte?
    define('EAD_TASK_SUPPORT_PENDING_REVIEW', 0); //Tickets Pendentes de Avaliação.
    define('EAD_TASK_SUPPORT_REPLY_PUBLISH', 0); //Tickets Pendentes de Avaliação.
    define('EAD_TASK_SUPPORT_LEVEL_DELETE', 10); //Level mínimo para poder deletar tickets
    define('EAD_STUDENT_CERTIFICATION', 1); //Você pretende emitir certificados?
    define('EAD_STUDENT_MULTIPLE_LOGIN', 1); //Permitir login multiplo?
    define('EAD_STUDENT_MULTIPLE_LOGIN_BLOCK', 0); //Minutos de bloqueio quando login multiplo!
    define('EAD_STUDENT_CLASS_PERCENT', 100); //Assitir EAD_CLASS_PERCENT% para concluir!
    define('EAD_STUDENT_CLASS_AUTO_CHECK', 0); //Marcar tarefas como concluídas automaticamente?
endif;