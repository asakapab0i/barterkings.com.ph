$(function(){

	$(document).on('click', '.update-ajax', function(event){
		$(this).trigger('favorite-btn-update', function(event){
		});
	});

	$(document).on('favorite-btn-update', '.update-ajax', function(event, check_favorite_btn){
		console.log($(this));
		var that = $(this);
		console.log(that.data('url'));

		$.when($.ajax({
			method: "POST",
			url: base_url + $(this).data('url'),
			data: {itemid : $(this).data('item-id')},
			success: function(result){
				if (result != 'failed') {

					if (that.hasClass('btn-warning') || that.hasClass('btn-danger')) {
						that.removeClass('btn-warning');
						that.removeClass('btn-danger');
						that.addClass('btn-default');
					}

				}
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

	$(document).on('click', '#remove-offer', function(event){
		event.preventDefault();

		var that = $(this).parent().parent().parent().parent().parent();
		console.log(that);

		var offer_id = $(this).data('item-offer-id');
		var item_id = $(this).data('item-id');
		$.ajax({
			method: "GET",
			url: base_url + 'item/remove_offered_item/' + item_id + '/' + offer_id,
			success: function(data){
				that.remove();
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
