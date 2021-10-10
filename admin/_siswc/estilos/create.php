<?php
$AdminLevel = LEVEL_WC_STYLES;
if (!APP_STYLES || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
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

$StyleId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($StyleId):
    $Read->ExeRead(DB_STYLES, "WHERE style_id = :id", "id={$StyleId}");
    if ($Read->getResult()):
        $FormData = array_map('htmlspecialchars', $Read->getResult()[0]);
        extract($FormData);
    else:
        $_SESSION['trigger_controll'] = "<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Um Estilo Que Não Existe ou Que Foi Removido Recentemente!";
        header('Location: dashboard.php?wc=estilos/home');
    endif;
else:
    $StyleCreate = ['style_datecreate' => date('Y-m-d H:i:s'), 'style_status' => 0];
    $Create->ExeCreate(DB_STYLES, $StyleCreate);
    header('Location: dashboard.php?wc=estilos/create&id=' . $Create->getResult());
endif;
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-magic-wand">Estilos</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=estilos/home">Estilos</a>
        </p>
    </div>
    
    <div class="dashboard_header_search" style="font-size: 0.875em; margin-top: 16px;">
        <a class="btn_header btn_purple icon-undo2" title="Voltar" href="dashboard.php?wc=estilos/home">Voltar</a>
    </div>
</header>

<div class="dashboard_content">
    <div class="box box70">
		<article class="wc_tab_target wc_active" id="info">
			<form class="auto_save" name="create_style" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="callback" value="Styles"/>
				<input type="hidden" name="callback_action" value="manager"/>
				<input type="hidden" name="style_id" value="<?= $StyleId; ?>"/>

				<div class="panel_header purple_dark">
					<h2 class="icon-magic-wand">Dados Sobre o Estilo</h2>
				</div>
				<div class="panel">
					<label class="label">
						<span class="legend">Foto: (JPG <?= AVATAR_W; ?>x<?= AVATAR_H; ?>px)</span>
						<input type="file" class="wc_loadimage" name="style_cover"/>
					</label>

					<label class="label">
						<span class="legend">Título do Estilo:</span>
						<input name="style_title" style="font-size: 1em;" value="<?= $style_title; ?>" placeholder="Informe o Título do Estilo" required/>
					</label>
					
					<label class="label">
						<span class="legend">Nome do Cliente:</span>
						<input name="style_name" value="<?= $style_name; ?>" placeholder="Informe o Nome do Cliente" required/>
					</label>
					
					<label class="label">
						<span class="legend">Coiffeur Responsável:</span>
						<select name="coiffeur_id" required>
							<option value="" disabled="disabled" selected="selected">Selecione Um Coiffeur:</option>
								<?php
								$Read->FullRead("SELECT coiffeur_id, coiffeur_name FROM " . DB_COIFFEURS);
								if (!$Read->getResult()):
									echo '<option value="" disabled="disabled">Não Existem Coiffeurs Cadastrados!</option>';
								else:
									foreach ($Read->getResult() as $Coiffeur):
										if ($Coiffeur['barber_id'] == $coiffeur_id):
										echo "<option";
											echo " selected='selected'";
										endif;
										echo " value='{$Coiffeur['coiffeur_id']}'>" . Check::Chars($Coiffeur['coiffeur_name'], 35) . "</option>";
									endforeach;
								endif;
								?>
						</select>
					</label>

					<label class="label">
						<span class="legend">Data de Estilo:</span>
						<input value="<?= (!empty($style_date) ? date('d/m/Y', strtotime($style_date)) : ''); ?>" class="formDate" type="text" name="style_date" placeholder="Informe a Data do Estilo" />
					</label>

					<label class="label">
						<span class="legend">Descrição do Estilo:</span>
						<textarea class="work_mce" rows="30" name="style_content"><?= $style_content; ?></textarea>
					</label>
					
					<div class="label_50">
						<label class="label">
							<span class="legend">Facebook:</span>
							<input value="<?= $style_facebook; ?>" type="text" name="style_facebook" placeholder="Informe o Facebook" />
						</label>

						<label class="label">
							<span class="legend">Instagram:</span>
							<input value="<?= $style_instagram; ?>" type="text" name="style_instagram" placeholder="Informe o Instagram" />
						</label>
					</div>

					<div class="label_33">
						<label class="label">
							<span class="legend">Linkedin:</span>
							<input value="<?= $style_linkedin; ?>" type="text" name="style_linkedin" placeholder="Informe o Linkedin" />
						</label>

						<label class="label">
							<span class="legend">Twitter:</span>
							<input value="<?= $style_twitter; ?>" type="text" name="style_twitter" placeholder="Informe o Twitter" />
						</label>

						<label class="label">
							<span class="legend">Youtube:</span>
							<input value="<?= $style_youtube; ?>" type="text" name="style_youtube" placeholder="Informe o Youtube" />
						</label>
					</div>

					<div class="m_top">&nbsp;</div>
					<div class="wc_actions" style="text-align: center">
						<button title="ATUALIZAR" name="public" value="1" class="btn_big btn_purple icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>

						<div class="switch__container" style="margin-bottom: 10px;">
						  <input value='1' id="switch-shadow" class="switch switch--shadow" type="checkbox" name='style_status' <?= ($style_status == 1 ? 'checked' : ''); ?>>
						  <label for="switch-shadow"></label>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</form>
		</article>
			
		<article class="wc_tab_target ds_none" id="images">
			<div class="panel_header purple_dark">
				<h2 class="icon-images" style="display:inline-block">Imagens da Galeria</h2>
				<span class="btn_header btn_purple_light icon-spinner9 wc_drag_active" title="Ordenar" style="display:inline-block; margin-bottom: 10px;">Ordenar</span>
			</div>
			
			<div class="panel">
				<form class="j_formsubmit" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="callback" value="Styles"/>
					<input type="hidden" name="callback_action" value="gallery_image"/>
					<input type="hidden" name="style_id" value="<?= $StyleId; ?>"/>
					
					<div class="upload_progress none" style="padding: 5px; background: #218FE5; color: #fff; width: 0%; text-align: center; max-width: 100%;">0%</div>
								 
					<input type="file" name="style_gallery_images[]" multiple required/>                
					<div class="wc_actions" style="text-align: center; margin-top: 15px;">
						<button title="ATUALIZAR" name="public" value="1" class="btn_big btn_purple icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
					</div>
					<div class="clear"></div>
	
					<div class='gallery panel_gallery' id="lightgallery">
						<?php
						$Read->ExeRead(DB_STYLES_GALLERY, "WHERE style_id = :id ORDER BY style_gallery_order ASC", "id={$StyleId}");
						if (!$Read->getResult()):
							Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Fotos Cadastradas Nessa Galeria!</span>", E_USER_NOTICE);
						else:
							foreach ($Read->getResult() as $IMAGES):
								extract($IMAGES);
								?>
                                <div class='panel_gallery_image wc_draganddrop js-rel-to' callback='Styles' callback_action='gallery_image_order' id='<?= $style_gallery_id; ?>' data-id='<?= $style_gallery_id; ?>' >
                                    <img src='../tim.php?src=uploads/<?= $style_gallery_file; ?>&w=200&h=200'>
                                    <div class='panel_gallery_action'>
                                        <ul class='buttons'>
                                            <li><span title='Excluir Imagem' rel='panel_gallery_image' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Styles' callback_action='gallery_image_delete' id='<?= $style_gallery_id; ?>'></span></li>
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
            <script src="<?= BASE; ?>/admin/_siswc/estilos/estilos.js"></script>
		</article>
	</div>
    
	<div class="box box30">
		<div class="panel_header purple">
			<h2 class="icon-image">Capa do Estilo</h2>
		</div>
		<div class="post_create_cover">
            <div class="upload_progress none">0%</div>
			<?php
			$Image = (file_exists("../uploads/{$style_cover}") && !is_dir("../uploads/{$style_cover}") ? "uploads/{$style_cover}" : 'admin/_img/no_image.jpg');
			?>
			<img class="post_thumb style_cover" alt="<?= $style_cover; ?>" title="<?= $style_title; ?>" src="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>" default="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>"/>
        </div>
        
        <div class="box_conf_menu" style="margin-top: 0">
            <div class="panel">
                <a class='conf_menu wc_tab wc_active' href='#info'><span>Informações</span></a>
                <a class='conf_menu wc_tab' href='#images'><span>Galeria de Imagens</span></a>
            </div>    
        </div>
		<div class="clear"></div>
    </div>
</div>