$(document).ready(function(){
    /* GALERIA DE IMAGENS */
    $('.j_formsubmit').submit(function () {
        $('.gallery').fadeOut(1000, function () {
            $(this).empty();
        });
    });

    //SELECT O TIPO DE ÍCONE DA CLASSE (IMAGEM OU TEXTO)
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

    //SELECT O TIPO DE ÍCONE DO TIPO DA CLASSE (IMAGEM OU TEXTO)
    $('.j_types_icon_image').hide();
    $('.j_types_icon_text').hide();

    if ($('.j_types_icon').val() == 1) {
        $('.j_types_icon_text').hide();
        $('.j_types_icon_image').show();
    } else {
        $('.j_types_icon_image').hide();
        $('.j_types_icon_text').show();
    }
    $('.j_types_icon').change(function () {
        if ($('.j_types_icon').val() == 1) {
            $('.j_types_icon_text').hide();
            $('.j_types_icon_image').show();
        } else {
            $('.j_types_icon_image').hide();
            $('.j_types_icon_text').show();
        }
    });

    /* OPEN MODAL HORÁRIOS DAS CLASSES */
    $(".j_create_class_schedule_modal").on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        //Limpa Form
        $('form[name="class_schedules_create_modal"]').trigger('reset');
        $('input[name="class_schedule_id"]').val("");
        $('select[name="class_schedule_day"]').val("");
        $('select[name="class_schedule_start"]').val("");
        $('select[name="class_schedule_end"]').val("");

        var modal = $(this).data('modal');
        $(modal).fadeIn('slow');
    });

    /* OPEN MODAL HORÁRIOS DOS TIPOS DA CLASSE */
    $(".j_create_class_types_schedule_modal").on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        //Limpa Form
        $('form[name="class_types_schedules_create_modal"]').trigger('reset');
        $('input[name="class_type_schedule_id"]').val("");
        $('select[name="class_type_schedule_day"]').val("");
        $('select[name="class_type_schedule_start"]').val("");
        $('select[name="class_type_schedule_end"]').val("");

        var modal = $(this).data('modal');
        $(modal).fadeIn('slow');
    });

    /* OPEN MODAL TREINADORES DAS CLASSES*/
    $(".j_create_class_trainee_modal").on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        //Limpa Form
        $('form[name="class_trainee_create_modal"]').trigger('reset');
        $('input[name="class_trainee_id"]').val("");
        $('select[name="trainee_id"]').val("");

        var modal = $(this).data('modal');
        $(modal).fadeIn('slow');
    });

    /* OPEN MODAL TREINADORES DOS TIPOS DAS CLASSES */
    $(".j_create_class_types_trainee_modal").on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        //Limpa Form
        $('form[name="class_type_trainee_create_modal"]').trigger('reset');
        $('input[name="class_type_trainee_id"]').val("");
        $('select[name="trainee_id"]').val("");

        var modal = $(this).data('modal');
        $(modal).fadeIn('slow');
    });
    
    /* CLOSE MODAL */
    $(".j_close_modal").on('click', function (e) {
    	e.preventDefault();
    	e.stopPropagation();
    
    	var modal = $(this).data('modal');
    	$(modal).fadeOut('slow');
    });
    
    /* EDIT MODAL HORÁRIOS DAS CLASSES */
    $('html').on('click', '.j_edit_class_schedule_modal', function () {
        var EditId = $(this).attr('id');
        var Callback = $(this).attr('callback');
        $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: 'edit_class_schedule', edit_id: EditId}, function (data) {
            //ALERT DINAMIC
            if (data.alert) {
                bs_alert(data.alert[0], data.alert[1], data.alert[2], data.alert[3]);
            } else {
                $.each(data.data, function (key, value) {
                    $('input[name="' + key + '"], textarea[name="' + key + '"]').val(value);
                    $('select[name="' + key + '"] option[value="' + value + '"]').attr({selected: "selected"});
                });
    
                $('.js-class-schedules').fadeIn('fast');
            }
        }, 'json');
        return false;
    });

    /* EDIT MODAL HORÁRIOS DOS TIPOS DAS CLASSES */
    $('html').on('click', '.j_edit_class_type_schedule_modal', function () {
        var EditId = $(this).attr('id');
        var Callback = $(this).attr('callback');
        $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: 'edit_class_type_schedule', edit_id: EditId}, function (data) {
            //ALERT DINAMIC
            if (data.alert) {
                bs_alert(data.alert[0], data.alert[1], data.alert[2], data.alert[3]);
            } else {
                $.each(data.data, function (key, value) {
                    $('input[name="' + key + '"], textarea[name="' + key + '"]').val(value);
                    $('select[name="' + key + '"] option[value="' + value + '"]').attr({selected: "selected"});
                });

                $('.js-class-types-schedules').fadeIn('fast');
            }
        }, 'json');
        return false;
    });
});