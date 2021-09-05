<!-- Error Start -->
<main class="content1">
    <div class="error_con">
        <img class="img-responsive" src="<?= INCLUDE_PATH; ?>/assets/images/error_icon.png" alt="">
        <div class="back_home">
            <a href="<?= BASE; ?>" class="back_to_home" title="<?= SITE_NAME; ?>">
                Voltar Para a Home
            </a>
        </div>
    </div>
</main>
<div class="error_copy">
    <p>
        Copyright ® <?= date('Y'); ?> - Todos os Direitos Reservados - <a class="copyright-link" href="<?= BASE; ?>" title="<?= SITE_NAME; ?>"><?= SITE_NAME; ?></a>
    </p>
</div>
<!-- Error End -->

<script>
    function openSearch() {
        document.getElementById("myOverlay").style.display = "block";
    }

    function closeSearch() {
        document.getElementById("myOverlay").style.display = "none";
    }
</script>
