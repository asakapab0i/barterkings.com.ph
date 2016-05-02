$(function(){

	$(document).on('click', '.auto-save-search', function(){

		var that = $(this);
		var url = (that.text() == 'View saved searches' ? base_url + that.data('url') : base_url + 'item/post_saved_searches');

		console.log(url);

		// $.ajax({
		// 	method: 'POST',
		// 	url: url,
		// 	data : {
		// 			term: that.data('term'),
		// 			url_query: that.data('query-url')
		// 	},
		// 	success : function(data){
		// 		if (data == 1) {
		// 				that.text('View saved searches');
		// 		}
		//
		// 	}
		// });
	});

	$(document).on('click', '.update-ajax', function(event){
		$(this).trigger('favorite-btn-update', function(event){
		});
	});

	$(document).on('favorite-btn-update', '.update-ajax', function(event, item_tool){
		var that = $(this);

		$.when($.ajax({
			method: "POST",
			url: base_url + $(this).data('url'),
			data: {itemid : $(this).data('item-id')},
			success: function(result){
				if (result != 'failed') {
					console.log(that.data());
					if (that.hasClass('btn-inverse')) {
						that.removeClass('btn-inverse');
						if(that.is('#love-btn')){
								that.addClass('btn-danger');
								that.attr('data-url', 'item/wishlist');
								that.data('url', 'item/wishlist');
						}else if(that.is('#favorite-btn')){
								that.addClass('btn-warning');
								that.attr('data-url', 'item/favorite');
								that.data('url', 'item/favorite');
						}
					}else{
							if (that.hasClass('btn-warning')) {
								that.removeClass('btn-warning');
								that.addClass('btn-inverse');
								that.attr('data-url', 'item/unfavorite')
								that.data('url', 'item/unfavorite');
							}
							if (that.hasClass('btn-danger')) {
								that.removeClass('btn-danger');
								that.addClass('btn-inverse');
								that.attr('data-url', 'item/unwishlist')
								that.data('url', 'item/unwishlist');
							}
					}
				}
			}
		})).done(function(){
			item_tool();
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
