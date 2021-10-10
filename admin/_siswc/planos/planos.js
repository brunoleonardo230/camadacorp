$(document).ready(function(){   
    /* OPEN MODAL BENEFITS */
    $(".j_create_benefits_modal").on('click', function (e) {
    	e.preventDefault();
    	e.stopPropagation();
    	
    	//Limpa Form
        $('form[name="plan_benefits_create_modal"]').trigger('reset');
        $('input[name="plan_benefits_id"]').val("");
    
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
    
    /* EDIT MODAL BENEFITS */
    $('html').on('click', '.j_edit_benefits_modal', function () {
        var EditId = $(this).attr('id');
        var Callback = $(this).attr('callback');
        $.post('_ajax/' + Callback + '.ajax.php', {callback: Callback, callback_action: 'edit_benefits', edit_id: EditId}, function (data) {
            //ALERT DINAMIC
            if (data.alert) {
                bs_alert(data.alert[0], data.alert[1], data.alert[2], data.alert[3]);
            } else {
                $.each(data.data, function (key, value) {
                    $('input[name="' + key + '"], textarea[name="' + key + '"]').val(value);
                    $('select[name="' + key + '"] option[value="' + value + '"]').attr({selected: "selected"});
                });
    
                $('.js-benefits').fadeIn('fast');
            }
        }, 'json');
        return false;
    });
});
