<div class="item">
    <div class="courses_box">
        <div class="courses_img">
            <img src="<?= BASE; ?>/tim.php?src=uploads/<?= $class_image; ?>&w=185&h=243" title="<?= $class_title; ?>"
                 alt="<?= $class_title; ?>" class="img-responsive">
        </div>
        <div class="courses_con">
            <h2 title="<?= $class_title; ?>"><?= Check::Chars($class_title, 12); ?></h2>
            <p><?= Check::Words($class_content, 10); ?></p>
            <a href="<?= BASE; ?>/sobre" class="read_coursr" title="Saber Mais">Saber Mais <i class="fa fa-angle-right" aria-hidden="true"></i></a>
        </div>
    </div>
</div>