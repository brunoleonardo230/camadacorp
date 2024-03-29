<?php
if (empty($WcContactRequired)):
    $WcContactRequired = true;
    echo "<link rel='stylesheet' href='" . BASE . "/_cdn/widgets/contact/contact.wc.css'/>";
    echo "<script src='" . BASE . "/_cdn/widgets/contact/contact.wc.js'></script>";
endif;
?>

<div class="wc_contact_modal jwc_contact_modal">
    <article class="wc_contact_modal_content">
        <span class="wc_contact_close jwc_contact_close">X</span>
        <header>
            <h1><span>Fale Conosco:</span></h1>
        </header>
        <div class="wc_contact_error jwc_contact_error"></div>
        <form action="" class="jwc_contact_form" name="wc_send_contact" method="post" enctype="multipart/form-data">
            <div class="wc_contact_modal_form">
                <label>
                    <span class="wc_contact_modal_legend">Nome:</span>
                    <input type="text" name="nome" value="" placeholder="Informe Seu Nome:" required/>
                </label>

                <label>
                    <span class="wc_contact_modal_legend">E-mail:</span>
                    <input type="email" name="email" value="" placeholder="Informe Seu E-mail:" required/>
                </label>

                <label>
                    <span class="wc_contact_modal_legend">Telefone:</span>
                    <input type="text" class="formPhone" name="phone" value="" placeholder="Informe Seu Telefone:" required/>
                </label>

                <label>
                    <span class="wc_contact_modal_legend">Mensagem:</span>
                    <textarea name="message" rows="3" placeholder="Deixe Uma Mensagem:" required></textarea>
                </label>
            </div>
            <div class="wc_contact_modal_button">
                <button class="btn btn_green">Enviar Contato</button>
                <img src="<?= BASE; ?>/_cdn/widgets/contact/images/load.gif" alt="Aguarde, Enviando Contato!" title="Aguarde, Enviando Contato!"/>
            </div>
        </form>

        <div style="display: none;" class="wc_contant_sended jwc_contant_sended">
            <p class="h2"><span>&#10003;</span><br>Mensagem Enviada Com Sucesso!</p>
            <p><b>Prezado(a) <span class="jwc_contant_sended_name">NOME</span>. Obrigado Por Entrar em Contato,</b></p>
            <p>Informamos Que Recebemos Sua Mensagem, e Que Vamos Responder o Mais Breve Possível.</p>
            <p><em>Atenciosamente <?= SITE_NAME; ?>.</em></p>
            <span class="btn btn_red jwc_contact_close" style="margin-top: 20px;">FECHAR</span>
        </div>
    </article>
</div>