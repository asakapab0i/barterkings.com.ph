$(function(){

	$('.category-card-parent').click(function(){

		$('#selling-form-warning-category').hide();
		var category_id = $(this).data('category-id');
		$('input[name="category"]').val(category_id);

	});

	$('.selling-card-parent').click(function(){

		$('#selling-form-warning-sell-type').hide();

		var sell_type_input = $(this).find('input[name="sell-type"]');
		sell_type_input.prop('checked', true);
		var selling_type = sell_type_input.val();
		$('.selling-item-form').attr('action', base_url + selling_type);

	});

	$('#selling-button').click(function(e){
		e.preventDefault();

		if ( $('input[name="category"]').val() == '' ) {
			$('#selling-form-warning-category').show();
			$('#selling-form-warning-category').focus();
		}else if( $('input[name="sell-type"]').is(':checked') == false ) {
			$('#selling-form-warning-sell-type').show();
			$('#selling-form-warning-sell-type').focus();
		}else{
			$('#selling-item-form').submit();
		}

	});

});