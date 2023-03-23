<!-- Footer Start-->
<footer itemscope itemtype="http://schema.org/WPFooter" id="" class="main-footer">
    <div class="footer">
        <div class="container">
            <div class="slide-top footer-logo">
                <a href="<?= BASE; ?>" title="<?= SITE_NAME; ?>">
                    <h2 class="logo_name">CAMADA <span class="white_text">CORP </span></h2>
                </a>
            </div>
            <div class="slide-bottom footer-menu">
                <!-- <ul class="nav-menu">
                    <li><a href="<?= BASE; ?>" title="<?= SITE_NAME; ?>">Home</a></li>
                    <li><a href="<?= BASE; ?>/sobre" title="Sobre">Sobre</a></li>
                    <li><a href="<?= BASE; ?>/aulas" title="Aulas">Aulas</a></li>
                    <li><a href="<?= BASE; ?>/horarios" title="Horários">Horários</a></li>
                    <li><a href="<?= BASE; ?>/artigos" title="Blog">Blog</a></li>
                    <li><a href="<?= BASE; ?>/contato" title="Contato">Contato</a></li>
                </ul> -->
            </div>
            <div class="slide-bottom footer-mail">
                <form class="newsletter-form"  name="newsletter" action=""
                      method="post" enctype="multipart/form-data">
                    <input type="email" name="contact_email" placeholder="Seu Melhor E-mail" required>
                    <input type="hidden" name="contact_name"/>
                    <input type="hidden" name="contact_telephone"/>
                    <input type="submit" name="submit" class="submit_icon" value="" title="Se Inscrever">
                </form>
            </div>
            <div class="slide-bottom social footer-social"><span>Redes Sociais</span>
                <ul>
                    <li class="faebook"><a title="<?= SITE_NAME; ?> No Facebook" href="//www.facebook.com/<?= SITE_SOCIAL_FB_PAGE; ?>" target="_blank"> <i class="fa fa-facebook"></i></a></li>
                    <li class="insta"><a title="<?= SITE_NAME; ?> No Instagram" href="//www.instagram.com/<?= SITE_SOCIAL_INSTAGRAM; ?>" target="_blank"> <i class="fa fa-instagram"></i></a></li>
                    <li class="insta"><a title="<?= SITE_NAME; ?> No Twitter" href="//www.twitter.com/<?= SITE_SOCIAL_TWITTER; ?>" target="_blank"> <i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                </ul>
            </div>

            <div class="slide-bottom copyright-text">
                <p>Copyright ® <?= date('Y'); ?> - Todos os Direitos Reservados - <a class="copyright-link" href="<?= BASE; ?>" title="<?= SITE_NAME; ?>"><?= SITE_NAME; ?></a><br>
                    Desenvolvido Com <i class="icon-heart copyright-heart"></i>Por <a class="copyright-link" href="https://www.gbtechweb.com.br" title="GbTechWeb" target="_blank">GbTechWeb</a></p>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End-->