<?php

$AccountAction = trim(strip_tags($URL[1]));
$AccountBaseUI = BASE . '/conta';

echo "<link rel='stylesheet' href='" . BASE . "/_cdn/widgets/account/account.css'/>";
echo '<script src="' . BASE . '/_cdn/jquery.form.js"></script>';
echo '<script src="' . BASE . '/_cdn/widgets/account/account.js"></script>';

//LOGIN
if (empty($AccountAction) || $AccountAction == 'login'):
    //REDIRECT IF LOGIN
    if (!empty($_SESSION['userLogin'])):
        header("Location: {$AccountBaseUI}/home");
        exit;
    else:
        echo "<article class='login_box'>";
        echo "<header>";
        echo "<h1>" . SITE_NAME . "!</h1>";
        echo "<p>Informe Seu E-mail e Senha Para Logar-se!</p>";
        echo "</header>";
        require 'login.form.php';
        echo "</article>";
    endif;
endif;

//RECOVER
if ($AccountAction == 'recuperar'):
    //REDIRECT IF LOGIN
    if (!empty($_SESSION['userLogin'])):
        header("Location: {$AccountBaseUI}/home");
        exit;
    else:
        echo "<article class='login_box'>";
        echo "<header>";
        echo "<h1>Recuperar Senha!</h1>";
        echo "<p>Informe Seu E-mail Abaixo Para Recuperar Sua Senha!</p>";
        echo "</header>";
        require 'recover.form.php';
        echo "</article>";
    endif;
endif;

//CADASTRO
if ($AccountAction == 'cadastro'):
    echo "<article class='login_box recover_pass'>";
    echo "<header>";
    echo "<h1>Cadastre-se!</h1>";
    echo "<p>Informe Seus Dados Para Criar Sua Conta!</p>";
    echo "</header>";
    require 'create.form.php';
    echo "</article>";
endif;

//NEWPASS
if ($AccountAction == 'nova-senha'):
    //REDIRECT IF LOGIN
    if (!empty($_SESSION['userLogin'])):
        header("Location: {$AccountBaseUI}/home");
        exit;
    else:
        echo "<article class='login_box recover_pass'>";
        echo "<header>";
        echo "<h1>Criar Nova Senha!</h1>";
        echo "<p>Informe e Repita Uma Nova Senha Abaixo Para Continuar!</p>";
        echo "</header>";

        $wcRecoverPassword = filter_input(INPUT_COOKIE, 'wc_recover_passtowd');

        if (empty($URL[2]) || !$wcRecoverPassword):
            $AccountRecoverError = AjaxErro('Não Foi Possível Obter Sua Conta. Favor Tente Novamente!', E_USER_WARNING);
            require 'recover.form.php';
        else:
            $AccountRecoverUser = explode('pass', $URL[2]);
            $AccountRecoverUserMail = (!empty($AccountRecoverUser[0]) ? base64_decode($AccountRecoverUser[0]) : null);
            $AccountRecoverUserPass = (!empty($AccountRecoverUser[1]) ? $AccountRecoverUser[1] : null);
            if (empty($AccountRecoverUserMail) || empty($AccountRecoverUserPass)):
                $AccountRecoverError = AjaxErro('Não Foi Possível Obter Sua Conta. Favor Tente Novamente!', E_USER_WARNING);
                require 'recover.form.php';
            else:
                if (empty($Read)):
                    $Read = new Read;
                endif;
                $Read->FullRead("SELECT user_id FROM " . DB_USERS . " WHERE user_email = :email AND user_password = :pass", "email={$AccountRecoverUserMail}&pass={$AccountRecoverUserPass}");
                if (!$Read->getResult()):
                    $AccountRecoverError = AjaxErro('Não Foi Possível Obter Sua Conta. Favor Tente Novamente!', E_USER_WARNING);
                    require 'recover.form.php';
                else:
                    $_SESSION['userRecoverId'] = $Read->getResult()[0]['user_id'];
                    require 'newpass.form.php';
                endif;
            endif;
        endif;
        echo "</article>";
    endif;
endif;

//DASHBOARD
$AccViews = ['home', 'dados', 'pedidos', 'pedido', 'enderecos', 'contato'];
if (in_array($AccountAction, $AccViews)):
    //REDIRECT IF LOGIN
    if (empty($_SESSION['userLogin'])):
        header("Location: {$AccountBaseUI}/restrito");
        exit;
    else:
        extract($_SESSION['userLogin']);
        require 'account.sidebar.php';
        echo "<article class='account_box'>";
        require "views/{$AccountAction}.wc.php";
        echo "</article>";
    endif;
endif;

//LOGOFF
if ($AccountAction == 'sair'):
    echo "<article class='login_box'>";
    echo "<header>";
    echo "<h1>Volte Logo :)</h1>";
    echo "<p>Sua Conta Foi Desconectada Com Sucesso!</p>";
    echo "</header>";
    require 'login.form.php';
    echo "</article>";
    unset($_SESSION['userLogin']);
endif;

//RESTRICT
if ($AccountAction == 'restrito'):
    echo "<article class='login_box'>";
    echo "<header>";
    echo "<h1>Acesso Restrito!</h1>";
    echo "<p>Antes é Preciso Logar Para Acessar Sua Conta!</p>";
    echo "</header>";
    require 'login.form.php';
    echo "</article>";
    unset($_SESSION['userLogin']);
endif;