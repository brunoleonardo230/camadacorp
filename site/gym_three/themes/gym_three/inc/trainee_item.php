<div class="item">
    <div class="team_box">
        <a href="#">
            <img src="<?= BASE; ?>/uploads/<?= $trainee_cover; ?>" title="<?= $trainee_name; ?>"
                 alt="<?= $trainee_name; ?>" class="img-responsive">
        </a>
        <div class="overlay">
            <div class="text">
                <p><?= Check::Words($trainee_content, 25); ?></p>
                <div class="team_icon"><a class="fa fa-facebook-f" href="#"></a> <a
                        class="fa fa-twitter" href="#"></a><a class="fa fa-instagram" href="#"></a>
                </div>
            </div>
        </div>
        <div class="text-content hvr-bounce-to-bottom">
            <div class="text">
                <h4><?= $trainee_name; ?></h4>
                <h5><?= getSpecialtiesTrainees($trainee_specialty); ?></h5>
            </div>
        </div>
    </div>
</div>