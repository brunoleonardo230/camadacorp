<!-- Page_Banner Start -->
<section class="breadcrumb_sec">
    <div class="container">
        <div class="row">
            <div class="blog_txt">
                <h1 class="wow fadeInUp animated title_animate"> Contato</h1>
                <h3 class="wow fadeInUp animated titlep_animate"> Centro de Treinamento de Atletas</h3>
            </div>
        </div>
    </div>
    <p class="breadcrumb1"><span> Home / Contato </span></p>
</section>
<!-- Page_Banner End -->

<!-- Contact Start-->
<section class="contact_detail">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-10">
                <div class="contact_detail_box">
                    <h2>Fale Conosco</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin elementum blandit sapien in
                        placerat.</p>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 inner_col">
                        <div class="address_box">
                            <h2>Endereço</h2>
                            <div class="address-box"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <p>
                                    <?= SITE_ADDR_ADDR; ?><br>
                                    <?= SITE_ADDR_CITY; ?> | <?= SITE_ADDR_UF; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 inner_col">
                        <div class="address_box">
                            <h2>Telefone</h2>
                            <div class="address-box"><i class="fa fa-phone" aria-hidden="true"></i>
                                <p><a href="tel:<?= SITE_ADDR_PHONE_A; ?>"><?= SITE_ADDR_PHONE_A; ?></a><br>
                                    <a href="tel:<?= SITE_ADDR_PHONE_A; ?>"><?= SITE_ADDR_PHONE_A; ?></a></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 inner_col">
                        <div class="address_box">
                            <h2>Fax</h2>
                            <div class="address-box"><i class="fa fa-fax" aria-hidden="true"></i>
                                <p>
                                    <a href="tel:<?= SITE_ADDR_PHONE_B; ?>"><?= SITE_ADDR_PHONE_B; ?></a><br>
                                    <a href="tel:<?= SITE_ADDR_PHONE_B; ?>"><?= SITE_ADDR_PHONE_B; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 inner_col">
                        <div class="address_box">
                            <h2>E-mail</h2>
                            <div class="address-box"><i class="fa fa-envelope" aria-hidden="true"></i>
                                <p>
                                    <a href="mailto:<?= SITE_ADDR_EMAIL; ?>"><?= SITE_ADDR_EMAIL; ?></a><br>
                                    <a href="mailto:<?= SITE_ADDR_EMAIL; ?>"><?= SITE_ADDR_EMAIL; ?></a>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 inner_col">
                        <div class="address_box">
                            <h2>Funcionamento</h2>
                            <div class="address-box"><i class="fa fa-clock-o" aria-hidden="true"></i>
                                <p><a href="#">Seg - Sex: 06:00 - 23:00</a><br>
                                    <a href="#">Domingo: Fechado</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-12">
                <div class="contact_form">
                    <form class="contato-form" name="contact_form" method="post"
                          enctype="multipart/form-data" action="">
                        <input type="hidden" name="subject">
                        <div class="col-lg-12 col-md-4 col-sm-4">
                            <input type="text" name="name" class="contact_form_detail" placeholder="Seu Nome" required>
                        </div>
                        <div class="col-lg-12 col-md-4 col-sm-4">
                            <input type="text" name="phone" class="contact_form_detail" placeholder="Seu Telefone" required>
                        </div>
                        <div class="col-lg-12 col-md-4 col-sm-4">
                            <input type="email" name="email" class="contact_form_detail" placeholder="Seu E-mail" required>
                        </div>
                        <div class="col-lg-12 col-md-12">
                            <textarea name="message" class="contact_form_detail1" placeholder="Sua Mensagem" required></textarea>
                        </div>
                        <div class="col-md-12">
                            <div class="submit_btn_box">
                                <input type="submit" class="submit_btn" value="Enviar" title="Enviar">
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
    </div>
</section>
<!-- Contact End-->
