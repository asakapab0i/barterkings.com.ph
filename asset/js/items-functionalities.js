$(function(){

	$(document).on('click', '#favorite-btn', function(event){

		alert('yeah!');

		$(this).trigger('favorite-btn-update', function(event){
			alert('yeah!');
		});

	});

	$(document).on('favorite-btn-update', '#favorite-btn', function(event, check_favorite_btn){

		$.when($.ajax({
			method: "POST",
			url: base_url + $(this).data('url'),
			data: {id : $(this).data('id')},
			success: function(result){
				
				if (result == 'true') {
					$(this).removeClass('btn-warning');
					$(this).addClass('btn-default');
				};				

			}
		})).done(function(){
			check_favorite_btn();
		});

	});

	$(document).on('click', '#selected-offer', function(){

		var item_id = $(this).data('item-id');
		var offer_item_id = $(this).data('item-offer-id');
		$('#myModal').modal('hide');

		$.ajax({
			method: "POST",
			url: base_url + 'item/get_offered_item/' + offer_item_id,
			data: {item_id : item_id, offer_item_id: offer_item_id},
				success: function(result){
					$('.offers-cart').html(result);
				}
		});

	});                                                        

	$(document).on('click', '#confirm-offer', function(){

		var item_id = $(this).data('item-id');
		var offer_item_id = $(this).data('offer-item-id');

		$.ajax({
			method: "POST",
			url: base_url + 'item/offer/' + item_id,
			data: {item_id: item_id, offer_item_id: offer_item_id},
				success: function(result){
					$('.offers-cart').html(result);
					$('.reload-offers-count').load(base_url + 'offer/get_offers_count/' + item_id);
				}
		});

		$

	});

});