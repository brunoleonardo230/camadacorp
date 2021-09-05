<div class="card">
    <div class="b_date">
        <img src="<?= INCLUDE_PATH; ?>/assets/images/blog_date.png" title="<?= $post_title; ?>"
             alt="<?= $post_title; ?>" class="img-responsive" >
        <span itemprop="dateCreated"><?= date('d', strtotime($post_date)); ?> <br> <?= utf8_encode(strftime('%b', strtotime($post_date))); ?></span>
    </div>
    <div class="blog_img">
        <a itemprop="url" href="<?= BASE;?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
            <img itemprop="image" src="<?= BASE; ?>/uploads/<?= $post_cover; ?>"
                 title="<?= $post_title; ?>" alt="<?= $post_title; ?>" class="img-responsive" >
        </a>
    </div>
    <div class="blog_info">
        <h4>
            <a itemprop="url" href="<?= BASE;?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                <span itemprop="name"><?= Check::Chars($post_title, 30); ?></span>
            </a>
        </h4>
        <p><?= Check::Words($post_content, 12); ?></p>
    </div>
</div>