<div class="item">
    <div class="trainer_box">
        <div class="img_trainer">
            <img src="<?= BASE; ?>/uploads/<?= $trainee_cover; ?>" title="<?= $trainee_name; ?>"
                 alt="<?= $trainee_name; ?>" class="img-responsive" >
        </div>
        <div class="footer-social1">
            <ul class="social_icon">
                <li>
                    <a title="<?= $trainee_name; ?> No Facebook" href="//www.facebook.com/<?= $trainee_facebook; ?>" target="_blank">
                        <img src="<?= INCLUDE_PATH; ?>/assets/images/facebook.png"
                             alt="Facebook Icon" class="img-responsive">
                    </a>
                </li>
                <li>
                    <a title="<?= $trainee_name; ?> No Instagram" href="//www.instagram.com/<?= $trainee_instagram; ?>" target="_blank">
                        <img src="<?= INCLUDE_PATH; ?>/assets/images/instagram.png"
                             alt="Instagram Icon" class="img-responsive">
                    </a>
                </li>
                <li>
                    <a title="<?= $trainee_name; ?> No Twitter" href="//www.twitter.com/<?= $trainee_twitter; ?>" target="_blank">
                        <img src="<?= INCLUDE_PATH; ?>/assets/images/twitter.png"
                             alt="Twitter Icon" class="img-responsive">
                    </a>
                </li>
            </ul>
        </div>
        <div class="trainer_con">
            <h3><?= $trainee_name; ?></h3>
            <p><?= getSpecialtiesTrainees($trainee_specialty); ?></p>
        </div>
    </div>
</div>