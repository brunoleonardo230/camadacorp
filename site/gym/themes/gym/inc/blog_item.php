<div class="item">
    <div class="blog_box">
        <a itemprop="url" href="<?= BASE;?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
            <div class="img_blog">
                <img itemprop="image" src="<?= BASE; ?>/uploads/<?= $post_cover; ?>"
                     title="<?= $post_title; ?>" alt="<?= $post_title; ?>" class="img-responsive">
            </div>
        </a>
        <div class="blog_con">
            <h3>
                <a itemprop="url" href="<?= BASE;?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                    <span itemprop="name"><?= $post_title; ?></span>
                </a>
            </h3>
            <p><?= Check::Words($post_content, 12); ?></p>
        </div>
    </div>
</div>