<?php
$AdminLevel = LEVEL_WC_TRAINEES;
if (!APP_TRAINEES || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
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

$TraineeId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($TraineeId):
    $Read->ExeRead(DB_TRAINEES, "WHERE trainee_id = :id", "id={$TraineeId}");
    if ($Read->getResult()):
        $FormData = array_map('htmlspecialchars', $Read->getResult()[0]);
        extract($FormData);
    else:
        $_SESSION['trigger_controll'] = "<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Um Treinador Que Não Existe ou Que Foi Removido Recentemente!";
        header('Location: dashboard.php?wc=treinadores/home');
    endif;
else:
    $TraineeCreate = ['trainee_datecreate' => date('Y-m-d H:i:s'), 'trainee_status' => 0];
    $Create->ExeCreate(DB_TRAINEES, $TraineeCreate);
    header('Location: dashboard.php?wc=treinadores/create&id=' . $Create->getResult());
endif;
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-user">Treinadores</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=treinadores/home">Treinadores</a>
        </p>
    </div>
    
    <div class="dashboard_header_search" style="font-size: 0.875em; margin-top: 16px;">
        <a class="btn_header btn_darkgreen icon-undo2" title="Voltar" href="dashboard.php?wc=treinadores/home">Voltar</a>
    </div>
</header>

<div class="dashboard_content">
    <div class="box box70">
         <form class="auto_save" name="create_trainee" action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="callback" value="Trainees"/>
            <input type="hidden" name="callback_action" value="manager"/>
            <input type="hidden" name="trainee_id" value="<?= $TraineeId; ?>"/>

            <div class="panel_header darkgreen">
                <h2 class="icon-user">Dados Sobre o Treinador</h2>
            </div>
            <div class="panel">
                <label class="label">
                    <span class="legend">Foto: (JPG <?= AVATAR_W; ?>x<?= AVATAR_H; ?>px)</span>
                    <input type="file" class="wc_loadimage" name="trainee_cover"/>
                </label>

                <label class="label">
                    <span class="legend">Nome do Treinador:</span>
                    <input name="trainee_name" style="font-size: 1em;" value="<?= $trainee_name; ?>" placeholder="Informe o Nome do Treinador" required/>
                </label>

                <label class="label">
                    <span class="legend">Especialidade do Treiandor</span>
                    <select name="trainee_specialty" required="">
                        <option value="">Selecione a Especialidade</option>
                        <?php
                        foreach (getSpecialtiesTrainees() as $SpecialtieId => $SpecialtieValue):
                            echo "<option " . ($trainee_specialty == $SpecialtieId ? "selected='selected'" : null) . " value='{$SpecialtieId}'>{$SpecialtieValue}</option>";
                        endforeach;
                        ?>
                    </select>
                </label>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">Data de Nascimento:</span>
                        <input value="<?= (!empty($trainee_datebirth) ? date('d/m/Y', strtotime($trainee_datebirth)) : ''); ?>" class="formDate" type="text" name="trainee_datebirth" placeholder="Informe a Data de Nascimento" />
                    </label>

                    <label class="label">
                        <span class="legend">Gênero do Treinador:</span>
                        <select name="trainee_genre" required>
                            <option selected disabled value="">Selecione o Gênero do Usuário:</option>
                            <option value="1" <?= ($trainee_genre == 1 ? 'selected="selected"' : ''); ?>>Masculino</option>
                            <option value="2" <?= ($trainee_genre == 2 ? 'selected="selected"' : ''); ?>>Feminino</option>
                        </select>
                    </label>
                </div>

                <label class="label">
                    <span class="legend">Biografia do Treinador:</span>
                    <textarea class="work_mce" rows="30" name="trainee_content"><?= $trainee_content; ?></textarea>
                </label>

                <label class="label">
                    <span class="legend">Curriculum do Treinador:</span>
                    <textarea class="work_mce" rows="30" name="trainee_curriculum"><?= $trainee_curriculum; ?></textarea>
                </label>

                <div class="clear"></div>
                <h3 class="form_subtitle icon-profile m_botton">Documentos:</h3>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">CPF:</span>
                        <input value="<?= $trainee_cpf; ?>" class="formCpf" type="text" name="trainee_cpf" placeholder="Informe o CPF do Treinador" />
                    </label>

                    <label class="label">
                        <span class="legend">RG:</span>
                        <input value="<?= $trainee_rg; ?>" type="text" name="trainee_rg" placeholder="Informe o RG do Treinador" />
                    </label>
                </div>

                <div class="clear"></div>
                <h3 class="form_subtitle icon-phone m_botton">Contatos:</h3>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">Telefone:</span>
                        <input value="<?= $trainee_telephone; ?>" class="formPhone" type="text" name="trainee_telephone" placeholder="Informe o Telefone do Treinador" />
                    </label>

                    <label class="label">
                        <span class="legend">Celular:</span>
                        <input value="<?= $trainee_cell; ?>" class="formPhone" type="text" name="trainee_cell" placeholder="Informe o Celular do Treinador" />
                    </label>
                </div>

                <label class="label">
                    <span class="legend">E-mail:</span>
                    <input value="<?= $trainee_email; ?>" type="email" name="trainee_email" placeholder="Informe o E-mail do Treinador" />
                </label>

                <div class="clear"></div>
                <h3 class="form_subtitle icon-share2 m_botton">Redes Sociais:</h3>

                <div class="label_50">
                    <label class="label">
                        <span class="legend">Facebook:</span>
                        <input value="<?= $trainee_facebook; ?>" type="text" name="trainee_facebook" placeholder="Informe o Facebook" />
                    </label>

                    <label class="label">
                        <span class="legend">Instagram:</span>
                        <input value="<?= $trainee_instagram; ?>" type="text" name="trainee_instagram" placeholder="Informe o Instagram" />
                    </label>
                </div>

                <div class="label_33">
                    <label class="label">
                        <span class="legend">Linkedin:</span>
                        <input value="<?= $trainee_linkedin; ?>" type="text" name="trainee_linkedin" placeholder="Informe o Linkedin" />
                    </label>

                    <label class="label">
                        <span class="legend">Twitter:</span>
                        <input value="<?= $trainee_twitter; ?>" type="text" name="trainee_twitter" placeholder="Informe o Twitter" />
                    </label>

                    <label class="label">
                        <span class="legend">Youtube:</span>
                        <input value="<?= $trainee_youtube; ?>" type="text" name="trainee_youtube" placeholder="Informe o Youtube" />
                    </label>
                </div>

                <div class="clear"></div>
                <h3 class="form_subtitle icon-location m_botton">Endereço:</h3>

                <div class="label_50">
                <label class="label">
                    <span class="legend">CEP:</span>
                    <input name="trainee_zipcode" value="<?= $trainee_zipcode; ?>" class="formCep wc_getCep" placeholder="Informe o CEP" required/>
                </label>

                <label class="label">
                    <span class="legend">Rua:</span>
                    <input class="wc_logradouro" name="trainee_street" value="<?= $trainee_street; ?>" placeholder="Informe o Nome da Rua" required/>
                </label>
            </div>

            <div class="label_50">
                <label class="label">
                    <span class="legend">Número:</span>
                    <input name="trainee_number" value="<?= $trainee_number; ?>" placeholder="Informe o Número" required/>
                </label>

                <label class="label">
                    <span class="legend">Complemento:</span>
                    <input class="wc_complemento" name="trainee_complement" value="<?= $trainee_complement; ?>" placeholder="Informe o Complemento (Ex: Casa, Apto, Etc)"/>
                </label>
            </div>

            <div class="label_50">
                <label class="label">
                    <span class="legend">Bairro:</span>
                    <input class="wc_bairro" name="trainee_district" value="<?= $trainee_district; ?>" placeholder="Informe o Bairro" required/>
                </label>

                <label class="label">
                    <span class="legend">Cidade:</span>
                    <input class="wc_localidade" name="trainee_city" value="<?= $trainee_city; ?>" placeholder="Informe a Cidade" required/>
                </label>
            </div>

            <div class="label_50">
                <label class="label">
                    <span class="legend">Estado (UF):</span>
                    <input class="wc_uf" name="trainee_state" value="<?= $trainee_state; ?>" maxlength="2" placeholder="Informe o Estado (Ex.: RJ)" required/>
                </label>

                <label class="label">
                    <span class="legend">País:</span>
                    <input name="trainee_country" value="<?= ($trainee_country ? $trainee_country : 'Brasil'); ?>" required/>
                </label>
            </div>

            <div class="m_top">&nbsp;</div>
            <div class="wc_actions" style="text-align: center">
                <button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>

                <div class="switch__container" style="margin-bottom: 10px;">
                  <input value='1' id="switch-shadow" class="switch switch--shadow" type="checkbox" name='trainee_status' <?= ($trainee_status == 1 ? 'checked' : ''); ?>>
                  <label for="switch-shadow"></label>
                </div>
            </div>
            <div class="clear"></div>
            </div>
        </form>
    </div>
    
    <div class="box box30">
        <div class="panel_header green">
            <h2 class="icon-image">Foto do Treinador</h2>
        </div>
        <?php
        $Image = (file_exists("../uploads/{$trainee_cover}") && !is_dir("../uploads/{$trainee_cover}") ? "uploads/{$trainee_cover}" : 'admin/_img/no_avatar.jpg');
        ?>
        <div class="box_image">
            <div class="box_image_img">
                <img class="trainee_cover" style="width: 100%;" src="../tim.php?src=<?= $Image; ?>&w=<?= AVATAR_W; ?>&h=<?= AVATAR_H; ?>" alt="<?= $trainee_name; ?>" title="<?= $trainee_name; ?>"/>
            </div>  
            
            <div class="box_image_info">
                <?= (!empty($trainee_name) ? "<h1 class='icon-user'>" . Check::Chars($trainee_name, 20) . "</h1>" : ""); ?>
                <?= (!empty($trainee_email) ? "<p class='icon-envelop'>" . $trainee_email . "</p>" : ""); ?>
                <?= (!empty($trainee_cell) ? "<p class='icon-phone'>" . $trainee_cell . "</p>" : ""); ?>
            </div>
        </div>
    </div>
</div>