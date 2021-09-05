<!-- Page_banner start -->
<section class="breadcrumb_sec">
    <div class="blog_txt">
        <h1 class="wow fadeInUp animated title_animate"> Contact Us </h1>
        <p class="wow fadeInUp animated titlep_animate"> Home <i class="fa fa-angle-right"></i> Contact Us</p>
    </div>
</section>
<!-- Page_banner end -->

<!-- Contact start -->
<section class="inner_contact">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="contace_title">
                    <h3>Contatos</h3>
                </div>
                <div class="trainers_box">
                    <div class="address-box">
                        <img class="img-responsive loc_icon" src="<?= INCLUDE_PATH; ?>/assets/ images/address.png" alt="">
                        <p class="icon icon-location">
                            <?= SITE_ADDR_ADDR; ?> -
                            <?= SITE_ADDR_CITY; ?> | <?= SITE_ADDR_UF; ?>
                        </p>
                    </div>
                    <div class="address-box">
                        <img class="img-responsive phone_icon" src="<?= INCLUDE_PATH; ?>/assets/ images/phone.png" alt="">
                        <p class="icon icon-phone">
                            Telefone:<br>
                            <a href="tel:<?= SITE_ADDR_PHONE_A; ?>"><?= SITE_ADDR_PHONE_A; ?></a><br>
                            <a href="tel:<?= SITE_ADDR_PHONE_B; ?>"><?= SITE_ADDR_PHONE_B; ?></a>
                        </p>
                    </div>
                    <div class="address-box">
                        <img class="img-responsive mes_icon" src="<?= INCLUDE_PATH; ?>/assets/ images/message.png" alt="">
                        <p class="icon icon-envelop">
                            E-mail:<br>
                            <a href="mailto:<?= SITE_ADDR_EMAIL; ?>"><?= SITE_ADDR_EMAIL; ?></a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="contace_title">
                    <h3>Funcionamento</h3>
                </div>
                <div class="time_box">
                    <div class="time_box_con">
                        <p>Segunda-Feira: 06:00 - 23:00</p>
                    </div>
                    <div class="time_box_con">
                        <p>Terça-Feira: 06:00 - 23:00</p>
                    </div>
                    <div class="time_box_con">
                        <p>Quarta-Feira: 06:00 - 23:00</p>
                    </div>
                    <div class="time_box_con">
                        <p>Quinta-Feira: 06:00 - 23:00</p>
                    </div>
                    <div class="time_box_con">
                        <p>Sexta-Feira: 06:00 - 23:00</p>
                    </div>
                    <div class="time_box_con">
                        <p>Sábado: 06:00 - 18:00</p>
                    </div>
                    <div class="time_box_con">
                        <p>Doming: Fechado</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact end -->

<!-- Contact_from start -->
<section class="contact_form_bg">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-md-8">
                <div class="contact_title">
                    <h2>Fale Conosco</h2>
                </div>
                <div>
                    <form class="contato-form" name="contact_form" method="post"
                          enctype="multipart/form-data" action="">
                        <div class="col-md-6">
                            <input type="text" name="name" class="contact_form_detail" placeholder="Seu Nome" required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" name="email" class="contact_form_detail" placeholder="Seu E-mail" required>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="phone" class="contact_form_detail" placeholder="Seu Telefone">
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="subject" class="contact_form_detail" placeholder="Assunto">
                        </div>
                        <div class="col-md-12">
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
<!-- Contact_from end -->

<!-- map start -->
<div class="map_box">
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d103199.78720030558!2d-94.23228200981069!3d36.06926628581833!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x87c96f7b2fb53e9d%3A0x4519f069fcb4c8cf!2sFayetteville%2C+AR%2C+USA!5e0!3m2!1sen!2sin!4v1536844112318"
                width="600" height="450" style="border:0" allowfullscreen></iframe>
        <strong></strong></div>
</div>
<!-- map end -->
