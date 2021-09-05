<?php
$AdminLevel = LEVEL_WC_CLASSES;
if (!APP_CLASSES || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
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

$ClassTypesId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$ClassId = filter_input(INPUT_GET, 'classes', FILTER_VALIDATE_INT);
if ($ClassTypesId):
    $Read->ExeRead(DB_CLASSES_TYPES, "WHERE class_type_id = :id", "id={$ClassTypesId}");
    if ($Read->getResult()):
        $FormData = array_map('htmlspecialchars', $Read->getResult()[0]);
        extract($FormData);

        $Read->ExeRead(DB_CLASSES, "WHERE class_id = :class", "class={$class_id}");
        if ($Read->getResult()):
            extract($Read->getResult()[0]);
        else:
            $_SESSION['trigger_controll'] = Erro("<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Um Tipo Que Não Existe ou Que Foi Removido Recentemente!", E_USER_NOTICE);
            header('Location: dashboard.php?wc=classes/home');
            exit;
        endif;
    endif;
elseif ($ClassId):
    $NewTypes = ['class_id' => $ClassId];
    $Create->ExeCreate(DB_CLASSES_TYPES, $NewTypes);
    header('Location: dashboard.php?wc=classes/types&id=' . $Create->getResult());
    exit;
else:
    $_SESSION['trigger_controll'] = Erro("<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Um Tipo Que Não Existe ou Que Foi Removido Recentemente!", E_USER_NOTICE);
    header('Location: dashboard.php?wc=classes/home');
    exit;
endif;
?>

<header class="dashboard_header">
    <div class="dashboard_header_title">
        <h1 class="icon-list2"><?= $class_type_title ? $class_type_title : "Novo Tipo"; ?></h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=classes/home">Classes</a>
            <span class="crumb">/</span>
            Tipos de Classes
        </p>
    </div>

    <div class="dashboard_header_search" style="font-size: 0.875em; margin-top: 16px;">
        <a class="btn_header btn_green icon-undo2" title="Voltar"
           href="dashboard.php?wc=classes/create&id=<?= $class_id; ?>">Voltar</a>
        <a title="Novo Tipo" href="dashboard.php?wc=classes/types&classes=<?= $class_type_id; ?>"
           class="btn_header btn_darkgreen icon-plus">Novo Tipo</a>
    </div>
</header>

<div class="dashboard_content">
    <div class="box box70">
        <article class="wc_tab_target wc_active" id="info">
            <form class="auto_save" name="class_info" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="callback" value="Classes"/>
                <input type="hidden" name="callback_action" value="create_types"/>
                <input type="hidden" name="class_type_id" value="<?= $ClassTypesId; ?>"/>

                <div class="panel_header darkgreen">
                    <h2 class="icon-power">Dados Sobre o Tipo da Classe</h2>
                </div>
                <div class="panel">
                    <label class="label">
                        <span class="legend">Imagem do Tipo da Classe:</span>
                        <input type="file" class="wc_loadimage" name="class_type_image"/>
                    </label>

                    <label class="label">
                        <span class="legend">Título do Tipo da Classe:</span>
                        <input name="class_type_title" style="font-size: 1.3em;" value="<?= $class_type_title; ?>" placeholder="Título do Tipo da Classe" required/>
                    </label>

                    <label class="label">
                        <span class="legend">Preço do Tipo da Classe:</span>
                        <input name="class_type_price" class="mask-money" value="<?= (!empty($class_type_price) ? number_format($class_type_price, 2, ',', '.') : null); ?>" placeholder="Informe o Preço do Tipo da Classe"/>
                    </label>

                    <div class="box box30">
                        <label class="label">
                            <span class="legend">Tipo do Ícone:</span>
                            <select name="class_type_icon_type" class="j_types_icon">
                                <option selected disabled value="">Selecione o Tipo:</option>
                                <option value="1" <?= ($class_type_icon_type == 1 ? 'selected="selected"' : ''); ?>>Imagem</option>
                                <option value="2" <?= ($class_type_icon_type == 2 ? 'selected="selected"' : ''); ?>>Texto</option>
                            </select>
                        </label>

                        <div class="j_types_icon_image">
                            <?php
                            $Image = (file_exists("../uploads/{$class_type_icon}") && !is_dir("../uploads/{$class_type_icon}") ? "uploads/{$class_type_icon}" : 'admin/_img/no_avatar.jpg');
                            ?>
                            <label class="label" style="margin-bottom: 10px;">
                                <span class="legend">Ícone do Tipo da Classe:</span>
                            </label>

                            <img class="class_type_icon" style="width: 100%;" src="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>" alt="" title=""/>

                            <label class="label" style="margin-top: 10px;">
                                <input type="file" class="wc_loadimage" name="class_type_icon"/>
                            </label>
                        </div>

                        <div class="j_types_icon_text">
                            <label class='label'>
                                <span class='legend'>Ícone do Tipo da Classe:</span>
                                <input value='<?= $class_type_icon_text; ?>' type='text' name='class_type_icon_text' placeholder='Informe o Ícone' />
                            </label>
                        </div>
                    </div>

                    <div class="box box70">
                        <label class="label">
                            <span class="legend">Descrição do Tipo da Classe:</span>
                            <textarea class="work_mce" rows="50" name="class_type_content"><?= $class_type_content; ?></textarea>
                        </label>
                    </div>

                    <div class="wc_actions" style="text-align: center">
                        <button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>

                        <div class="switch__container">
                            <input value='1' id="switch-shadow" class="switch switch--shadow" type="checkbox" name='class_type_status' <?= ($class_type_status == 1 ? 'checked' : ''); ?>>
                            <label for="switch-shadow"></label>
                        </div>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </article>

        <article class="wc_tab_target ds_none" id="images">
            <form class="auto_save" name="classes_images" action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="callback" value="Classes"/>
                <input type="hidden" name="callback_action" value="create_class_types_images"/>
                <input type="hidden" name="class_id" value="<?= $ClassId; ?>"/>
                <input type="hidden" name="class_type_id" value="<?= $ClassTypesId; ?>"/>

                <div class="panel_header darkgreen">
                    <h2 class="icon-image">Imagens</h2>
                </div>
                <div class="panel">
                    <div class="box box50">
                        <?php
                        $Image = (file_exists("../uploads/{$class_type_image_one}") && !is_dir("../uploads/{$class_type_image_one}") ? "uploads/{$class_type_image_one}" : 'admin/_img/no_avatar.jpg');
                        ?>
                        <label class="label">
                            <span class="legend border_bottom_title">Imagem 1:</span>
                        </label>
                        <img class="class_type_image_one" style="width: 100%;" src="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>" alt="" title=""/>

                        <label class="label">
                            <input type="file" class="wc_loadimage" name="class_type_image_one"/>
                        </label>
                    </div>

                    <div class="box box50">
                        <?php
                        $Image = (file_exists("../uploads/{$class_type_image_two}") && !is_dir("../uploads/{$class_type_image_two}") ? "uploads/{$class_type_image_two}" : 'admin/_img/no_avatar.jpg');
                        ?>
                        <label class="label">
                            <span class="legend border_bottom_title">Imagem 2:</span>
                        </label>

                        <img class="class_type_image_two" style="width: 100%;" src="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>" alt="" title=""/>

                        <label class="label">
                            <input type="file" class="wc_loadimage" name="class_type_image_two"/>
                        </label>
                    </div>

                    <div class="wc_actions" style="text-align: center">
                        <button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
                    </div>
                    <div class="clear"></div>
                </div>
            </form>
        </article>

        <article class="wc_tab_target ds_none" id="gallery">
            <div class="panel_header darkgreen">
                <h2 class="icon-images">Galeria</h2>
                <span class="btn_header btn_green icon-spinner9 wc_drag_active" title="Ordenar" style="display:inline-block; margin-top: -20px;">Ordenar</span>
            </div>
            <div class="panel">
                <form class="j_formsubmit" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="callback" value="Classes"/>
                    <input type="hidden" name="callback_action" value="class_types_gallery_image"/>
                    <input type="hidden" name="class_type_id" value="<?= $ClassTypesId; ?>"/>
                    <input type="hidden" name="class_type_gallery_id" value=""/>

                    <div class="upload_progress none" style="padding: 5px; background: #218FE5; color: #fff; width: 0%; text-align: center; max-width: 100%;">0%</div>

                    <input type="file" name="class_type_gallery_images[]" multiple required/>
                    <div class="wc_actions" style="text-align: center; margin-top: 15px;">
                        <button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
                    </div>
                    <div class="clear"></div>

                    <div class='gallery panel_gallery'>
                        <?php
                        $Read->ExeRead(DB_CLASSES_TYPES_GALLERY, "WHERE class_type_id = :id ORDER BY class_type_gallery_order ASC", "id={$ClassTypesId}");
                        if (!$Read->getResult()):
                            Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Fotos Cadastradas Em Nossa Galeria!</span>", E_USER_NOTICE);
                        else:
                            foreach ($Read->getResult() as $image):
                                extract($image);
                                ?>
                                <div class='panel_gallery_image wc_draganddrop js-rel-to' callback='Classes' callback_action='class_type_gallery_order' id='<?= $class_type_gallery_id; ?>' data-id="<?= $class_type_gallery_id; ?>" >
                                    <img src='../tim.php?src=uploads/<?= $class_type_gallery_file; ?>&w=200&h=200'>
                                    <div class='panel_gallery_action'>
                                        <ul class="buttons">
                                            <li><span title="Excluir Imagem" rel='panel_gallery_image' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='class_type_gallery_delete' id="<?= $class_type_gallery_id; ?>"></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                        ?>
                    </div>
                    <div class="clear"></div>
                </form>
            </div>

            <script src="<?= BASE; ?>/admin/_siswc/classes/classes.js"></script>
        </article>

        <article class="wc_tab_target ds_none" id="schedules">
            <div class="panel_header darkgreen">
                <span>
                    <a href="#" title='Novo Horário' class="btn_header btn_green icon-plus icon-notext j_create_class_types_schedule_modal" data-modal=".js-class-types-schedules"></a>
                </span>
                <h2 class="icon-clock">Horários</h2>
            </div>
            <div class="panel" id="classes-types-schedules">
                <?php
                $Read->ExeRead(DB_CLASSES_TYPES_SCHEDULES, "WHERE class_type_id = :class ORDER BY class_type_schedule_start DESC", "class={$class_type_id}");
                if (!$Read->getResult()):
                    echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Horários dos Tipos das Classes Cadastrados. Comece Agora Mesmo Cadastrando o Primeiro Horário!</span>", E_USER_NOTICE);
                else:
                    foreach ($Read->getResult() as $SCHEDULES):
                        extract($SCHEDULES);
                        echo "<div class='single_user_addr js-rel-to' id='{$class_type_schedule_id}'>
                            <h1 class='icon-clock'>" . getWeekDays($class_type_schedule_day) . " | " . getHours($class_type_schedule_start) . " - " . getHours($class_type_schedule_end) . "</h1>
                            <div class='single_user_addr_actions'>
                                <span title='Editar Horário' class='btn_header btn_darkgreen icon-notext icon-pencil j_edit_class_type_schedule_modal' callback='Classes' callback_action='edit_class_type_schedule' id='{$class_type_schedule_id}'></span>
                                <span title='Excluir Horário' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_type_schedule' id='{$class_type_schedule_id}'></span>
                                </div>
                            </div>";
                    endforeach;
                endif;
                ?>
            </div>
            <div class="clear"></div>

            <!-- MODAL DE CADASTRO DE HORÁRIOS -->
            <div class="bs_ajax_modal js-class-types-schedules" style="display: none;">
                <div class="bs_ajax_modal_box">
                    <p class="bs_ajax_modal_title darkgreen"><span class="icon-clock">Cadastrar Horário</span></p>
                    <span title="Fechar" class="bs_ajax_modal_close icon-cross icon-notext j_close_modal" data-modal=".js-class-types-schedules"></span>
                    <div class="bs_ajax_modal_content scrollbar">
                        <form name="class_types_schedules_create_modal" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="callback" value="Classes"/>
                            <input type="hidden" name="callback_action" value="create_class_type_schedule"/>
                            <input type="hidden" name="class_type_id" value="<?= $ClassTypesId; ?>"/>
                            <input type="hidden" name="class_type_schedule_id" value=""/>

                            <div class="label_100">
                                <label class="label">
                                    <span class="legend">Dia da Semana:</span>
                                    <select name="class_type_schedule_day" required>
                                        <option value="" disabled="disabled" selected="selected">Selecione Um Dia da Semana:</option>
                                        <?php
                                        foreach (getWeekDays() as $DayId => $DayValue):
                                            echo "<option " . ($class_type_schedule_day	 == $DayId ? "selected='selected'" : null) . " value='{$DayId}'>{$DayValue}</option>";
                                        endforeach;
                                        ?>
                                    </select>
                                </label>
                            </div>

                            <div class="label_50">
                                <label class="label">
                                    <span class="legend">Início:</span>
                                    <select name="class_type_schedule_start" required>
                                        <option value="" disabled="disabled" selected="selected">Selecione o Horário de Início:</option>
                                        <?php
                                        foreach (getHours() as $DayId => $DayValue):
                                            echo "<option " . ($class_type_schedule_start == $DayId ? "selected='selected'" : null) . " value='{$DayId}'>{$DayValue}</option>";
                                        endforeach;
                                        ?>
                                    </select>
                                </label>

                                <label class="label">
                                    <span class="legend">Término:</span>
                                    <select name="class_type_schedule_end" required>
                                        <option value="" disabled="disabled" selected="selected">Selecione o Horário de Término:</option>
                                        <?php
                                        foreach (getHours() as $DayId => $DayValue):
                                            echo "<option " . ($class_type_schedule_end == $DayId ? "selected='selected'" : null) . " value='{$DayId}'>{$DayValue}</option>";
                                        endforeach;
                                        ?>
                                    </select>
                                </label>
                            </div>

                            <div class="wc_actions" style="text-align: right">
                                <button title="ENVIAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ENVIAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
                            </div>
                        </form>
                    </div>

                    <div class="bs_ajax_modal_footer">
                        <p>Cadastre o Horário do Tipo da Classe Para Que Possa Utilizar Em Seu Sistema!</p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- FECHA MODAL DE CADASTRO DE HORÁRIOS -->
        </article>

        <article class="wc_tab_target ds_none" id="trainee">
            <div class="panel_header darkgreen">
                <span>
                    <a href="#" title='Novo Treinador' class="btn_header btn_green icon-plus icon-notext j_create_class_types_trainee_modal" data-modal=".js-class-types-trainees"></a>
                </span>
                <h2 class="icon-user">Treinador</h2>
            </div>
            <div class="panel" id="class-types-trainees">
                <?php
                $Read->FullRead(
                    "SELECT "
                    . "c.class_type_id, "
                    . "c.trainee_id, "
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
                    . "ORDER BY class_type_trainee_datecreate DESC", "class={$class_type_id}"
                );
                if (!$Read->getResult()):
                    echo Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Treinadores Cadastrados Para o Tipo da Classe. Comece Agora Mesmo Cadastrando o Primeiro Treinador!</span>", E_USER_NOTICE);
                else:
                    foreach ($Read->getResult() as $Trainee):
                        extract($Trainee);
                        $TraineeCover = "../uploads/{$trainee_cover}";
                        $trainee_cover = (file_exists($TraineeCover) && !is_dir($TraineeCover) ? "uploads/{$trainee_cover}" : 'admin/_img/no_avatar.jpg');
                        echo "<article class='single_user box box33 al_center js-rel-to' id='{$class_type_trainee_id}' >
                            <div class='box_content wc_normalize_height'>
                                <img alt='Este é {$trainee_name}' title='Este é {$trainee_name}' src='../tim.php?src={$trainee_cover}&w=400&h=400'/>
                                <h1>{$trainee_name}</h1>
                                <div class='m_top'></div>  
                                <p class='info icon-profile'>" . getSpecialtiesTrainees($trainee_specialty) . "</p>
                                <p class='info icon-envelop'>" . $trainee_email . "</p>
                            </div>
                            <div class='single_user_actions'>
                                <a title='Editar Treinador' class='btn_header btn_darkgreen icon-pencil icon-notext' href='dashboard.php?wc=treinadores/create&id={$trainee_id}'></a>
                                <span title='Excluir Treinador' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Classes' callback_action='delete_class_type_trainee' id='{$class_type_trainee_id}'></span>
                            </div>
                        </article>";
                    endforeach;
                endif;
                ?>
            </div>
            <div class="clear"></div>

            <!-- MODAL DE TREINADORES DO TIPO DA CLASSE -->
            <div class="bs_ajax_modal js-class-types-trainees" style="display: none;">
                <div class="bs_ajax_modal_box">
                    <p class="bs_ajax_modal_title darkgreen"><span class="icon-power">Cadastrar Treinador</span></p>
                    <span title="Fechar" class="bs_ajax_modal_close icon-cross icon-notext j_close_modal" data-modal=".js-class-types-trainees"></span>
                    <div class="bs_ajax_modal_content scrollbar">
                        <form name="class_type_trainee_create_modal" action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="callback" value="Classes"/>
                            <input type="hidden" name="callback_action" value="create_class_type_trainee"/>
                            <input type="hidden" name="class_type_id" value="<?= $ClassTypesId; ?>"/>
                            <input type="hidden" name="class_type_trainee_id" value=""/>

                            <div class="label_100">
                                <label class="label">
                                    <span class="legend">Treinador:</span>
                                    <select name="trainee_id" required>
                                        <option value="" disabled="disabled" selected="selected">Selecione Um Treinador:</option>
                                        <?php
                                        $Read->FullRead("SELECT trainee_id, trainee_name FROM " . DB_TRAINEES);
                                        if (!$Read->getResult()):
                                            echo '<option value="" disabled="disabled">Não Existem Treinadores Cadastrados!</option>';
                                        else:
                                            foreach ($Read->getResult() as $Trainee):
                                                echo "<option";
                                                echo " value='{$Trainee['trainee_id']}'>{$Trainee['trainee_name']}</option>";
                                            endforeach;
                                        endif;
                                        ?>
                                    </select>
                                </label>
                            </div>

                            <div class="m_top"></div>
                            <div class="wc_actions" style="text-align: right">
                                <button title="ENVIAR" name="public" value="1" class="btn_big btn_green icon-share">ENVIAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
                            </div>
                        </form>
                    </div>

                    <div class="bs_ajax_modal_footer">
                        <p>Cadastre o Treinador do Tipo da Classe Para Que Apareça Em Seu Site!</p>
                    </div>
                    <div class="clear"></div>
                </div>
            </div>
            <!-- FECHA MODAL DE TREINADORES DO TIPO DA CLASSE -->
        </article>
    </div>

    <div class="box box30">
        <div class="panel_header green">
            <h2 class="icon-image">Imagem do Tipo da Classe</h2>
        </div>
        <?php
        $Image = (file_exists("../uploads/{$class_type_image}") && !is_dir("../uploads/{$class_type_image}") ? "uploads/{$class_type_image}" : 'admin/_img/no_avatar.jpg');
        ?>
        <img class="class_type_image" style="width: 100%;"
             src="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>" alt="" title=""/>

        <div class="box_conf_menu no_icon" style="margin-top: 0;">
            <div class="panel">
                <a class='conf_menu wc_tab wc_active' href='#info'><span class="icon-info">Informações Gerais</span></a>
                <a class='conf_menu wc_tab' href='#images'><span class="icon-image">Imagens</span></a>
                <a class='conf_menu wc_tab' href='#gallery'><span class="icon-images">Galeria</span></a>
                <a class='conf_menu wc_tab' href='#schedules'><span class="icon-clock">Horários</span></a>
                <a class='conf_menu wc_tab' href='#trainee'><span class="icon-user">Treinadores</span></a>
            </div>
        </div>
    </div>
</div>