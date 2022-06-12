<!-- Page_Banner Start -->
<section class="breadcrumb_sec" style="background-image: url(<?= INCLUDE_PATH; ?>/assets/images/blogbg.jpg);">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title_box_page">
                    <div class="page_banner_img"><img class="img-responsive wow fadeInLeft animated img_animate"
                                                      src="<?= INCLUDE_PATH; ?>/assets/images/title-bg.png" alt="">
                    </div>
                    <div class="page_banner_title">
                        <h2 class="wow fadeInUp animated title_animate">Contato</h2>
                        <p class="wow fadeInUp animated titlep_animate"><?= mb_strtoupper("Centro de Treinamento de Atletas"); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Page_Banner End -->

<!-- /Contact Start-->
<div class="contact_detail">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <div class="location_box">
                    <div class="location_icon">
                        <img class="img-responsive hoverin" src="<?= INCLUDE_PATH; ?>/assets/images/location.png" alt="">
                        <img class="img-responsive hoverout" src="<?= INCLUDE_PATH; ?>/assets/images/location_hover.png" alt="">
                    </div>
                    <div class="location_address">
                        <p>
                            <?= SITE_ADDR_ADDR; ?><br>
                            <?= SITE_ADDR_CITY; ?> | <?= SITE_ADDR_UF; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="location_box">
                    <div class="location_icon">
                        <img class="img-responsive hoverin" src="<?= INCLUDE_PATH; ?>/assets/images/phone.png" alt="">
                        <img class="img-responsive hoverout" src="<?= INCLUDE_PATH; ?>/assets/images/phone_hover.png" alt="">
                    </div>
                    <div class="location_address">
                        <p>
                            <a href="tel:<?= SITE_ADDR_PHONE_A; ?>"><?= SITE_ADDR_PHONE_A; ?></a><br>
                            <a href="mailto:<?= SITE_ADDR_EMAIL; ?>"><?= SITE_ADDR_EMAIL; ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-4">
                <div class="location_box">
                    <div class="location_icon">
                        <img class="img-responsive hoverin" src="<?= INCLUDE_PATH; ?>/assets/images/time.png" alt="">
                        <img class="img-responsive hoverout" src="<?= INCLUDE_PATH; ?>/assets/images/time_hover.png" alt="">
                    </div>
                    <div class="location_address">
                        <p>
                            Seg - Sáb: 06:00 - 23:00<br>
                            Domingo: Fechado
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Contact End-->

<!-- /Contact_Form Start-->
<div class="contact_form">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="about_inner_page_con title_box">
                    <h2 class="title"><span>Contatoxx</span>Fale Conosco</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <form class="contato-form" name="contact_form" method="post"
                  enctype="multipart/form-data" action="">
                <input type="hidden" name="subject">
                <div class="col-md-4">
                    <input type="text" name="name" class="contact_form_detail" placeholder="Seu Nome" required>
                </div>
                <div class="col-md-4">
                    <input type="text" name="phone" class="contact_form_detail" placeholder="Seu Telefone" required>
                </div>
                <div class="col-md-4">
                    <input type="email" name="email" class="contact_form_detail" placeholder="Seu E-mail" required>
                </div>
                <div class="col-md-12">
                    <textarea name="message" class="contact_form_detail1" placeholder="Sua Mensagem" required></textarea>
                </div>
                <div class="col-md-12">
                    <div class="submit_btn_box">
                        <input type="submit"class="submit_btn hvr-shutter-out-horizontal" id='bt_enviar' value="Enviar" title="Enviar">
                    </div>
                </div>
            </form>
            <div style="display: none;" class="wc_contact_sended jwc_contact_sended">
                <p class="h2"><span>&#10003;</span> Solicitação Enviada Com Sucesso!</p>
                <p><b>Prezado(a) <span class="jwc_contact_sended_name">NOME</span>. Obrigado Pelo
                        Contato,</b></p>
                <p>Informamos que recebemos sua mensagem, e que vamos responder o mais breve
                    possível.</p>
                <p><em>Atenciosamente <?= SITE_NAME; ?>.</em></p>
                <span title="Fechar" class="btn btn_red jwc_contact_close" style="margin-top: 20px;">FECHAR</span>
            </div>
        </div>
    </div>
</div>
<!-- /Contact_Form Start-->
