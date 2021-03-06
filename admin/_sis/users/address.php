<?php
$AdminLevel = LEVEL_WC_USERS;
if (!APP_USERS || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
    die('<div style="text-align: center; margin: 5% 0; color: #C54550; font-size: 1.6em; font-weight: 400; background: #fff; float: left; width: 100%; padding: 30px 0;"><b>ACESSO NEGADO:</b> Você Não Está Logado<br>Ou Não Tem Permissão Para Acessar Essa Página!</div>');
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Read)):
    $Read = new Read;
endif;

// AUTO INSTANCE OBJECT READ
if (empty($Create)):
    $Create = new Create;
endif;

$AddrId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$UserId = filter_input(INPUT_GET, 'user', FILTER_VALIDATE_INT);
if ($AddrId):
    $Read->ExeRead(DB_USERS_ADDR, "WHERE addr_id = :id", "id={$AddrId}");
    if ($Read->getResult()):
        $FormData = array_map('htmlspecialchars', $Read->getResult()[0]);
        extract($FormData);

        $Read->ExeRead(DB_USERS, "WHERE user_id = :user", "user={$user_id}");
        if ($Read->getResult()):
            extract($Read->getResult()[0]);
        else:
            $_SESSION['trigger_controll'] = Erro("<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Um Endereço Que Não Existe ou Que Foi Removido Recentemente!", E_USER_NOTICE);
            header('Location: dashboard.php?wc=users/home');
            exit;
        endif;
    else:
        $_SESSION['trigger_controll'] = Erro("<b>OPPSS {$Admin['user_name']}</b>, Você Tentou Editar Um Endereço Que Não Existe ou Que Foi Removido Recentemente!", E_USER_NOTICE);
        header('Location: dashboard.php?wc=users/home');
        exit;
    endif;
elseif ($UserId):
    $NewAddres = ['user_id' => $UserId, 'addr_name' => 'Novo Endereço'];
    $Create->ExeCreate(DB_USERS_ADDR, $NewAddres);
    header('Location: dashboard.php?wc=users/address&id=' . $Create->getResult());
    exit;
else:
    $_SESSION['trigger_controll'] = Erro("<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Um Endereço Que Não Existe ou Que Foi Removido Recentemente!", E_USER_NOTICE);
    header('Location: dashboard.php?wc=users/home');
    exit;
endif;
?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-location">Endereço de <?= "{$user_name} {$user_lastname}"; ?></h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=home">Dashboard</a>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=users/home">Usuários</a>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=users/create&id=<?= $user_id; ?>"><?= "{$user_name} {$user_lastname}"; ?></a>
            <span class="crumb">/</span>
            <?= $addr_name; ?>
        </p>
    </div>

    <div class="dashboard_header_search" style="font-size: 0.875em; margin-top: 16px;">
        <a class="btn_header btn_darkgreen icon-undo2" title="Voltar" href="dashboard.php?wc=users/create&id=<?= $user_id; ?>">Conta de <?= $user_name; ?></a>
    </div>

</header>

<div class="dashboard_content">
    <div class="box box100">
        <div class="panel_header darkgreen">
            <h2 class="icon-location">Endereço de <?= "{$user_name} {$user_lastname}"; ?></h2>
        </div>
        <div class="panel">
            <form class="auto_save" name="user_add_address" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="callback" value="Users"/>
                <input type="hidden" name="callback_action" value="addr_add"/>
                <input type="hidden" name="addr_id" value="<?= $AddrId; ?>"/>

                <label class="label">
                    <span class="legend">Nome do Endereço:</span>
                    <input name="addr_name" style="font-size: 1.3em;" value="<?= $addr_name; ?>" placeholder="Informe o Endereço (Ex: Minha Casa)" required/>
                </label>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">CEP:</span>
                        <input name="addr_zipcode" value="<?= $addr_zipcode; ?>" class="formCep wc_getCep" placeholder="Informe o CEP" required/>
                    </label>

                    <label class="label">
                        <span class="legend">Rua:</span>
                        <input class="wc_logradouro" name="addr_street" value="<?= $addr_street; ?>" placeholder="Informe o Nome da Rua" required/>
                    </label>
                </div>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">Número:</span>
                        <input name="addr_number" value="<?= $addr_number; ?>" placeholder="Informe o Número" required/>
                    </label>

                    <label class="label">
                        <span class="legend">Complemento:</span>
                        <input class="wc_complemento" name="addr_complement" value="<?= $addr_complement; ?>" placeholder="Informe o Complemento (Ex: Casa, Apto, Etc)"/>
                    </label>
                </div>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">Bairro:</span>
                        <input class="wc_bairro" name="addr_district" value="<?= $addr_district; ?>" placeholder="Informe o Bairro" required/>
                    </label>

                    <label class="label">
                        <span class="legend">Cidade:</span>
                        <input class="wc_localidade" name="addr_city" value="<?= $addr_city; ?>" placeholder="Informe a Cidade" required/>
                    </label>
                </div>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">Estado (UF):</span>
                        <input class="wc_uf" name="addr_state" value="<?= $addr_state; ?>" maxlength="2" placeholder="Informe o Estado (Ex.: RJ)" required/>
                    </label>

                    <label class="label">
                        <span class="legend">País:</span>
                        <input name="addr_country" value="<?= ($addr_country ? $addr_country : 'Brasil'); ?>" required/>
                    </label>
                </div>

                <button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen fl_right icon-share" style="margin-left: 5px;">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
                <div class="clear"></div>
            </form>
        </div>
    </div>
</div>