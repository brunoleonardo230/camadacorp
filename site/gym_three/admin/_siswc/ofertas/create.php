<?php
$AdminLevel = LEVEL_WC_OFFERS;
if (!APP_OFFERS || empty($DashboardLogin) || empty($Admin) || $Admin['user_level'] < $AdminLevel):
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

$OfferId = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if ($OfferId):
    $Read->ExeRead(DB_OFFERS, "WHERE offer_id = :id", "id={$OfferId}");
    if ($Read->getResult()):
        $FormData = array_map('htmlspecialchars', $Read->getResult()[0]);
        extract($FormData);
    else:
        $_SESSION['trigger_controll'] = "<b>OPSSS {$Admin['user_name']}</b>, Você Tentou Editar Uma Oferta Que Não Existe ou Que Foi Removida Recentemente!";
        header('Location: dashboard.php?wc=ofertas/home');
    endif;
else:
    $OfferCreate = ['offer_datecreate' => date('Y-m-d H:i:s'), 'offer_status' => 0];
    $Create->ExeCreate(DB_OFFERS, $OfferCreate);
    header('Location: dashboard.php?wc=ofertas/create&id=' . $Create->getResult());
endif;
?>

<header class="dashboard_header"><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <div class="dashboard_header_title">
        <h1 class="icon-cart">Ofertas</h1>
        <p class="dashboard_header_breadcrumbs">
            &raquo; <?= ADMIN_NAME; ?>
            <span class="crumb">/</span>
            <a title="<?= ADMIN_NAME; ?>" href="dashboard.php?wc=ofertas/home">Ofertas</a>
        </p>
    </div>
    
    <div class="dashboard_header_search" style="font-size: 0.875em; margin-top: 16px;">
        <a class="btn_header btn_darkgreen icon-undo2" title="Voltar" href="dashboard.php?wc=ofertas/home">Voltar</a>
    </div>
</header>

<div class="dashboard_content">
    <div class="box box70">
		<article class="wc_tab_target wc_active" id="info">
			<form class="auto_save" name="create_offer" action="" method="post" enctype="multipart/form-data">
				<input type="hidden" name="callback" value="Offers"/>
				<input type="hidden" name="callback_action" value="manager"/>
				<input type="hidden" name="offer_id" value="<?= $OfferId; ?>"/>

				<div class="panel_header darkgreen">
					<h2 class="icon-cart">Dados Sobre a Oferta</h2>
				</div>
				<div class="panel">
					<label class="label">
						<span class="legend">Imagem: (JPG <?= AVATAR_W; ?>x<?= AVATAR_H; ?>px)</span>
						<input type="file" class="wc_loadimage" name="offer_image"/>
					</label>

					<label class="label">
						<span class="legend">Título da Oferta:</span>
						<input name="offer_title" style="font-size: 1em;" value="<?= $offer_title; ?>" placeholder="Informe o Título da Oferta" required/>
					</label>
					
					<label class="label">
						<span class="legend">Link Externo da Oferta:</span>
						<input name="offer_url" value="<?= $offer_url; ?>" placeholder="Informe o Link da Oferta" required/>
					</label>

                    <div class="label_50">
                        <label class="label">
                            <span class="legend">Preço da Oferta:</span>
                            <input name="offer_price" class="mask-money" value="<?= (!empty($offer_price) ? number_format($offer_price, 2, ',', '.') : null); ?>" placeholder="Informe o Preço da Oferta" required/>
                        </label>

                        <label class="label">
                            <span class="legend">Preço Promocional da Oferta:</span>
                            <input name="offer_price_new" class="mask-money" value="<?= (!empty($offer_price_new) ? number_format($offer_price_new, 2, ',', '.') : null); ?>" placeholder="Informe o Preço Promocional" />
                        </label>
                    </div>

                    <label class="label">
                        <span class="legend">Categoria:</span>
                        <select name="offer_category" required>
                            <option value="" disabled="disabled" selected="selected">Selecione Uma Categoria:</option>
                            <?php
                            foreach (getOffersCategories() as $CategoryId => $CategoryValue):
                                echo "<option " . ($offer_category == $CategoryId ? "selected='selected'" : null) . " value='{$CategoryId}'>{$CategoryValue}</option>";
                            endforeach;
                            ?>
                        </select>
                    </label>

                    <label class="label">
                        <span class="legend">Recomendado?</span>
                        <select name="offer_recommended" required>
                            <option selected disabled value="">Plao é o Recomendado:</option>
                            <option value="1" <?= ($offer_recommended == 1 ? 'selected="selected"' : ''); ?>>Sim</option>
                            <option value="2" <?= ($offer_recommended == 2 ? 'selected="selected"' : ''); ?>>Não</option>
                        </select>
                    </label>

					<label class="label">
						<span class="legend">Descrição da Oferta:</span>
						<textarea class="work_mce" rows="30" name="offer_content"><?= $offer_content; ?></textarea>
					</label>

					<div class="m_top">&nbsp;</div>
					<div class="wc_actions" style="text-align: center">
						<button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>

						<div class="switch__container" style="margin-bottom: 10px;">
						  <input value='1' id="switch-shadow" class="switch switch--shadow" type="checkbox" name='offer_status' <?= ($offer_status == 1 ? 'checked' : ''); ?>>
						  <label for="switch-shadow"></label>
						</div>
					</div>
					<div class="clear"></div>
				</div>	
			</form>
		</article>
			
		<article class="wc_tab_target ds_none" id="images">
			<div class="panel_header darkgreen">
				<h2 class="icon-images" style="display:inline-block">Imagens da Galeria</h2>
				<span class="btn_header btn_green icon-spinner9 wc_drag_active" title="Ordenar" style="display:inline-block; margin-bottom: 10px;">Ordenar</span>
			</div>
			
			<div class="panel">
				<form class="j_formsubmit" action="" method="post" enctype="multipart/form-data">
					<input type="hidden" name="callback" value="Offers"/>
					<input type="hidden" name="callback_action" value="gallery_image"/>
					<input type="hidden" name="offer_id" value="<?= $OfferId; ?>"/>
					
					<div class="upload_progress none" style="padding: 5px; background: #218FE5; color: #fff; width: 0%; text-align: center; max-width: 100%;">0%</div>
								 
					<input type="file" name="offer_gallery_images[]" multiple required/>                
					<div class="wc_actions" style="text-align: center; margin-top: 15px;">
						<button title="ATUALIZAR" name="public" value="1" class="btn_big btn_darkgreen icon-share">ATUALIZAR <img class="form_load none" style="margin-left: 6px; margin-bottom: 9px;" alt="Enviando Requisição!" title="Enviando Requisição!" src="_img/load.svg"/></button>
					</div>
					<div class="clear"></div>
	
					<div class='gallery panel_gallery' id="lightgallery">
						<?php
						$Read->ExeRead(DB_OFFERS_GALLERY, "WHERE offer_id = :id ORDER BY offer_gallery_order ASC", "id={$OfferId}");
						if (!$Read->getResult()):
							Erro("<span class='al_center icon-notification'>Olá {$Admin['user_name']}, Ainda Não Existem Fotos Cadastradas Nessa Galeria!</span>", E_USER_NOTICE);
						else:
							foreach ($Read->getResult() as $IMAGES):
								extract($IMAGES);
								?>
                                <div class='panel_gallery_image wc_draganddrop js-rel-to' callback='Offers' callback_action='gallery_image_order' id='<?= $offer_gallery_id; ?>' data-id='<?= $offer_gallery_id; ?>' >
                                    <img src='../tim.php?src=uploads/<?= $offer_gallery_file; ?>&w=200&h=200'>
                                    <div class='panel_gallery_action'>
                                        <ul class='buttons'>
                                            <li><span title='Excluir Imagem' rel='panel_gallery_image' class='j_delete_action icon-bin icon-notext btn_header btn_red' callback='Offers' callback_action='gallery_image_delete' id='<?= $offer_gallery_id; ?>'></span></li>
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
            <script src="<?= BASE; ?>/admin/_siswc/ofertas/ofertas.js"></script>
		</article>
	</div>
    
	<div class="box box30">
		<div class="panel_header green">
			<h2 class="icon-image">Capa da Oferta</h2>
		</div>
		<div class="post_create_cover">
            <div class="upload_progress none">0%</div>
			<?php
			$Image = (file_exists("../uploads/{$offer_image}") && !is_dir("../uploads/{$offer_image}") ? "uploads/{$offer_image}" : 'admin/_img/no_image.jpg');
			?>
			<img class="post_thumb offer_image" alt="<?= $offer_image; ?>" title="<?= $offer_title; ?>" src="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>" default="../tim.php?src=<?= $Image; ?>&w=<?= IMAGE_W; ?>&h=<?= IMAGE_H; ?>"/>
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