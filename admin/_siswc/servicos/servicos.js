$(function () {
    //SELECT O TIPO DE ÍCONE ESPECIALIDADE (IMAGEM OU TEXTO)
    $('.j_icon_image').hide();
    $('.j_icon_text').hide();

    if ($('.j_icon').val() == 1) {
        $('.j_icon_text').hide();
        $('.j_icon_image').show();
    } else {
        $('.j_icon_image').hide();
        $('.j_icon_text').show();
    }
    $('.j_icon').change(function () {
        if ($('.j_icon').val() == 1) {
            $('.j_icon_text').hide();
            $('.j_icon_image').show();
        } else {
            $('.j_icon_image').hide();
            $('.j_icon_text').show();
        }
    });
    
    //SELECT O TIPO DE ÍCONE DO BENEFÍCIO DO SERVIÇO (IMAGEM OU TEXTO)
    $('.j_benefits_icon_image').hide();
    $('.j_benefits_icon_text').hide();

    if ($('.j_benefits_icon').val() == 1) {
        $('.j_benefits_icon_text').hide();
        $('.j_benefits_icon_image').show();
    } else {
        $('.j_benefits_icon_image').hide();
        $('.j_benefits_icon_text').show();
    }
    $('.j_benefits_icon').change(function () {
        if ($('.j_benefits_icon').val() == 1) {
            $('.j_benefits_icon_text').hide();
            $('.j_benefits_icon_image').show();
        } else {
            $('.j_benefits_icon_image').hide();
            $('.j_benefits_icon_text').show();
        }
    });
    
   /* OPEN MODAL PROCEDIMENTOS */
    $(".j_create_procedure_modal").on('click', function (e) {
    	e.preventDefault();
    	e.stopPropagation();
    	
    	//Limpa Form
        $('form[name="procedure_create_modal"]').trigger('reset');
        $('input[name="specialtie_procedure_id"]').val("");

    	var modal = $(this).data('modal');
    	$(modal).fadeIn('slow');
    });
});