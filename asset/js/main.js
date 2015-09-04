'use strict';

$(function(){
	$(document).on('click', '.pop-modal', function(e){
		e.preventDefault();

		var id = $(this).data('itemid');
		var url = $(this).data('url');;
		var that = $('#myModal');
		that.find('.modal-content').empty();

		//pop the modal
		that.modal('show');

		$.ajax({
			method: "POST",
			url: base_url + url,
			data: { id: id}
		}).done(function( result ) {
			that.find('.modal-content').html(result);
		});
	});

	$(document).on('click', '.approve-offer-btn', function(){

	});

	$(document).on('approve-offer-event', '.approve-offer-btn', function(){

	});

	$(document).on('click', '.decline-offer-btn', function(){

	});

	$(document).on('decline-offer-event', '.decline-offer-btn', function(){

	});

	$(document).on('click', '.add-comment-btn', function(event){
		event.preventDefault();
		$(this).trigger('add-comment-event', function(itemid){
			console.log('add-comment-event has been triggered.');
			var that_comments = $('.reload-comments');
			var that_comments_count = $('.reload-comments-count');
			that_comments.load(base_url + 'item/get_comments/' + itemid);
			that_comments_count.load(base_url + 'item/get_comments_count/' + itemid);
			$(this).remove();	
		});
	});

	$(document).on('add-comment-event', '.add-comment-btn', function(event, item_comment){
		var formdata = $('#add_comment_form');
		var itemid = $('[name=item_id]').val();

		$.when($.ajax({
			method: "POST",
			url: base_url + 'item/comment',
			data: formdata.serialize(),
			processData: false,
			success: function(){
				$('.modal-body').html('<div class="alert alert-success"><span>Comment has been added.</span></div>');
			}
		})).done(function(){
			item_comment(itemid);
		});

	});

	$(document).on('click', '.add-offer-btn', function(event){
		event.preventDefault();
		$(this).trigger('add-offer-event', function(itemid){
			console.log('add-offer-event has been triggered.');
			var that_offers = $('.reload-offers');
			var that_offers_count = $('.reload-offers-count');
			that_offers.load(base_url + 'offer/get_offers/' + itemid);
			that_offers_count.load(base_url + 'offer/get_offers_count/' + itemid);
			$(this).remove();
		});
	});

	$(document).on('add-offer-event', '.add-offer-btn', function(event, add_offer){
		var formdata = $('#add_offer_form');
		var itemid = $('[name=item_id]').val();
		$.when($.ajax({
			method: "POST",
			url: base_url + 'offer/add',
			data: formdata.serialize(),
			processData: false,
			success: function(){
				$('.modal-body').html('<div class="alert alert-success"><span>Offer has been made.</span></div>');
			}
		})).done(function(){
			add_offer(itemid);
		});
	});

	$(document).on('click', '.remove-file', function(){
		$(this).trigger('remove-images-event', function(){
			console.log('remove-images-event has been triggered.');
			var that_images = $('.reload-images');
			var that_images_count = $('.reload-images-count');
			that_images.load(base_url + 'item/get_images/' + that_images.data('itemid'));
			that_images_count.load(base_url + 'item/get_images_count/' + that_images.data('itemid'));
		});
	});

	$(document).on('remove-images-event', '.remove-file', function(event, remove_image){
		var file_div = $('.fileinput');
		if (file_div.length == 1) {
			$(this).attr('disabled', 'disabled');
		}else{
			var imageid = $(this).data('imageid');
			var url = $(this).data('url');
			console.log(url);
			$.when($.ajax({
				method: "POST",
				url: base_url + url,
				data: {imageid: imageid}
			}).done(function( result ) {
				//console.log(result);
			})).done(function(){
				remove_image();
			});

			$(this).parent().remove();
		};
	});

	$(document).on('change', '.userfile', function(){
		$(this).trigger('upload-images-event', function(itemid){
			console.log('upload-images-event has been triggered.');
			var that_images = $('.reload-images');
			var that_images_count = $('.reload-images-count');
			that_images.load(base_url + 'item/get_images/' + itemid);
			that_images_count.load(base_url + 'item/get_images_count/' + itemid);
		});
	});

	$(document).on('upload-images-event', '.userfile', function(e, reload_images){
		var formdata = false;
		if (window.FormData) {
			formdata = new FormData();
		}

		var itemid = $(this).parent().parent().find('[name=itemid]');
		var i = 0, len = this.files.length, img, reader, file;
		var imageid = $(this).data('imageid');
		var that = $('#myModal');

		file = this.files[0];
		if (!!file.type.match(/image.*/)) {
			if ( window.FileReader ) {
				reader = new FileReader();
				reader.onprogress = function(event){
					$('.progress').removeClass('hide');
					$('.progress').css('display', 'block');
					if (event.lengthComputable) {
						var percentage = Math.round((event.loaded * 100) / event.total);
						$('.progress-bar').css('width', percentage+'%')
						.attr('aria-valuenow', event.loaded)
						.attr('aria-valuemax', event.total);
						if(percentage == 100) {
							$('.progress').fadeOut();	
						}
					}	
				},
				reader.readAsDataURL(file);
			}
			formdata.append("userfile", file);
			formdata.append('imageid', imageid);
		}

		$.when($.ajax({
			url: base_url + "item/upload/" + itemid.val(),
			type: "POST",
			data: formdata,
			processData: false,
			contentType: false,
			cache: false,
			async: true,
			success: function (res) {
					//console.log(res);
					that.find('.modal-content').html(res);
				}
			})).done(function(){
			reload_images(itemid.val());
		});

			var fileinput_root = $('.fileinput');
			$(this).parent().parent().find('.fileinput-filename').text($(this).val());

			if (fileinput_root.length == 1) {
				$(this).parent().parent().find('.remove-file').attr('disabled', false);
			}
	});
});

$(function(){
	$(document).on("click", ".show-more a", function(e) {
		e.preventDefault();
		var $this = $(this); 
		var $content = $this.parent().prev("div.content");
		var linkText = $this.text().toUpperCase();    

		if(linkText === "SHOW MORE"){
			linkText = "Show less";
			$content.removeClass('hideContent');
			$content.addClass('showContent');
		} else {
			linkText = "Show more";
			$content.removeClass('showContent');
			$content.addClass('hideContent');
		};

		$this.text(linkText);
	});
});