<aside itemscope itemtype="http://schema.org/WPSideBar" id=""  class="col-sm-12 col-md-4 col-xs-12 blog_right">
    <article class="search_blog">
        <h3 class="blog_title"> Pesquisar </h3>
        <form class="input-group col-md-12 col-sm-12 col-xs-12"
              name="search" action="" method="post" enctype="multipart/form-data">
            <input type="text" name="s" class="form-control input-lg" placeholder="Pesquisar..."/>
            <span class="input-group-btn">
                 <button class="btn" type="submit" title="Pesquisar"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>
        </form>
    </article>
    <article class="Categories_blog">
        <h3 class="blog_title"> Categorias </h3>
        <ul class="Categories">
            <?php
            $Read->ExeRead(DB_CATEGORIES, "WHERE category_parent IS NULL AND category_id IN(SELECT post_category FROM " . DB_POSTS . " WHERE post_status = 1 AND post_date <= NOW()) ORDER BY category_title ASC");
            if (!$Read->getResult()):
                echo Erro("Ainda Não Existe Categorias Cadastradas!", E_USER_NOTICE);
            else:
                foreach ($Read->getResult() as $Ses):
                    $Read->FullRead('SELECT COUNT(post_category) AS total FROM ' . DB_POSTS . ' WHERE post_category = :id', "id={$Ses['category_id']}");
                    $totalPosts = (!empty($Read->getResult()) && $Read->getResult()[0]['total'] >= 1 ? $Read->getResult()[0]['total'] : 0);
                    echo "<li class='cat_list'><a title='{$Ses['category_title']}' href='" . BASE . "/categorias/{$Ses['category_name']}'><i class='fa fa-circle' aria-hidden='true'></i> {$Ses['category_title']} <span>({$totalPosts})</span></a></li>";
                endforeach;
            endif;
            ?>
        </ul>
    </article>
    <article class="articles_blog">
        <h3 class="blog_title"> Últimas do Blog </h3>
        <ul>
            <?php
            $Read->ExeRead(DB_POSTS, "WHERE post_status = 1 AND post_date <= NOW() ORDER BY post_date DESC LIMIT 5");
            if (!$Read->getResult()):
                echo Erro("Ainda Não Existe Posts Cadastrados! :)", E_USER_NOTICE);
            else:
                foreach ($Read->getResult() as $Posts):
                    extract($Posts);
                    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                    date_default_timezone_set('America/Sao_Paulo');
                    ?>
                    <li class="articles col-sm-6 col-xs-12 col-md-12">
                        <div class="row">
                            <div class="col-sm-4 col-xs-4 col-md-4 art_img">
                                <div class="row">
                                    <img src="<?= BASE; ?>/tim.php?src=uploads/<?= $post_cover; ?>&w=288&h=270" title="<?= $post_title; ?>"
                                         alt="<?= $post_title; ?>" class="img-responsive">
                                </div>
                            </div>
                            <div class="col-sm-8 col-xs-8 col-md-8 art_info">
                                <h4>
                                    <a href="<?= BASE; ?>/artigo/<?= $post_name; ?>" title="<?= $post_title; ?>">
                                        <?= $post_title; ?>
                                    </a>
                                </h4>
                                <p> <?= date('d/m/Y', strtotime($post_date)); ?> </p>
                            </div>
                        </div>
                    </li>
                    <?php
                endforeach;
            endif;
            ?>
        </ul>
    </article>
    <article class="tags_blog">
        <h3 class="blog_title">Links</h3>
        <ul class="tag_list">
            <li class="tags"><a href="<?= BASE; ?>" title="<?= SITE_NAME; ?>">Home</a></li>
            <li class="tags"><a href="<?= BASE; ?>/sobre" title="Sobre">Sobre</a></li>
            <li class="tags"><a href="<?= BASE; ?>/aulas" title="Aulas">Aulas</a></li>
            <li class="tags"><a href="<?= BASE; ?>/horarios" title="Horários">Horários</a></li>
            <li class="tags"><a href="<?= BASE; ?>/treinadores" title="Treinadores">Treinadores</a></li>
            <li class="tags"><a href="<?= BASE; ?>/artigos" title="Blog">Blog</a></li>
            <li class="tags"><a href="<?= BASE; ?>/contato" title="Contato">Contato</a></li>
        </ul>
    </article>
</aside>