$(document).ready(function () {
    /* GALERIA DE IMAGENS */
    $('.j_formsubmit').submit(function () {
        $('.gallery').fadeOut(1000, function () {
            $(this).empty();
        });
    });
});
