<div class="col-md-12 col-sm-12 col-sx-10 item six circle1">
    <div class="circle2">
        <img src="<?= BASE; ?>/uploads/<?= $trainee_cover; ?>" title="<?= $trainee_name; ?>"
             alt="<?= $trainee_name; ?>" class="img-responsive topimg">
    </div>
    <div class="trainer_info">
        <div class="info">
            <h4> <?= $trainee_name; ?> </h4>
            <h5> <?= getSpecialtiesTrainees($trainee_specialty); ?> </h5>
            <div class="trainer_social">
                <a title="<?= $trainee_name; ?> No Facebook" href="//www.facebook.com/<?= $trainee_facebook; ?>" target="_blank"><i class="fa fa-facebook-f"></i></a>
                <a title="<?= $trainee_name; ?> No Instagram" href="//www.instagram.com/<?= $trainee_instagram; ?>" target="_blank"><i class="fa fa-instagram"></i></a>
                <a title="<?= $trainee_name; ?> No Twitter" href="//www.twitter.com/<?= $trainee_twitter; ?>" target="_blank"><i class="fa fa-twitter"></i></a>
                <a title="<?= $trainee_name; ?> No Linkedin" href="//www.linkedin.com/<?= $trainee_linkedin; ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
            </div>
        </div>
    </div>
</div>