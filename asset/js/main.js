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

	$(document).on('click', '#upload-profile-img-btn', function(event){
		event.preventDefault();

		$(this).trigger('upload-profile-img-event', function(){
			var that = $('.reload-profile');
			that.load(base_url + 'account/profile_upload');
		});
	});

	$(document).on('upload-profile-img-event', '#upload-profile-img-btn', function(event, reload_profile){
		event.preventDefault();

		var profile_input = $("input:file");
		var formdata = new FormData();
		var img, reader, file;
		var account_id = $(this).data('account_id');

		file = profile_input[0].files[0];
		console.log(file);
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
			formdata.append('account_id', account_id);

			$.when($.ajax({
				url: base_url + "account/profile_upload/",
				type: "POST",
				data: formdata,
				processData: false,
				contentType: false,
				cache: false,
				async: true,
				success: function (res) {
					console.log('Upload success.');
				}
			})).done(function(){
				reload_profile();
			});
		}
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

/*Message Event*/

$(function(){
	$(document).on('click', '.btn-send', function(event){
		event.preventDefault();
		$(this).trigger('send-message-event', function(){
			console.log('send-message-event triggered.');
		});
	});

	$(document).on('send-message-event', '.btn-send', function(){
		var form = $('#message-create-form');
		var formdata = new FormData(form[0]);

		$.ajax({
			type : 'POST',
			url : base_url + form.attr('action'),
			data : formdata,
			processData: false,
			contentType: false,
			success : function(result){
				console.log('Message sent.');
				$('.content-container').html('<div class="alert alert-success">'+result+'</div>');
			}
		});
	});
});

/*Tabbing Via Js*/

$(document).on('click', '.show-tab', function (e) {
	e.preventDefault();

	var type = $(this).data('type');
	var message_id = $(this).data('message-id');
	var name = type;
	var container = $('content-container');

	if (message_id != undefined) {
		type = type + '/' + message_id;
	};

	$.ajax({
		type : 'GET',
		url : base_url + 'message/' + type,
		success : function(result){
			$('.content-title').html(name[0].toUpperCase() + name.substr(1));
			$('.content-body').html(result);
		}
	});
	$(this).tab('show');
});

// Javascript to enable link to tab
var url = document.location.toString();
if (url.match('#')) {
	$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;

	var href = url.split('#')[1]
	$.ajax({
		type : 'GET',
		url : base_url + 'message/' + href,
		success : function(result){
			$('.content-title').html(href[0].toUpperCase() + href.substr(1));
			$('.content-body').html(result);
		}
	});
}

//ACTIVATION OF PLUGIN 

$(function(){
	$('.nav-tabs a').on('shown.bs.tab', function (e) {
		window.location.hash = e.target.hash;
	})

	$('[data-toggle="tooltip"]').tooltip({html:true});

	$('.slider').slider({
		formatter: function(value) {
			return 'Current value: ' + value;
		}
	});

	$('.selectpicker').selectpicker({
		style: 'btn-default',
		size: 4
	});

// $(function(){
// 	$(document).on('focus', '#search', function(){
// 		$(this).animate({width: '500px'});
// 	});
// 	$(document).on('focusout', '#search', function(){
// 		$(this).animate({width: '400px'});
// 	});
// });

});


//ACTIVATION OF SPECIFIC ELEMENT

$(function(){

	$('.item-card-parent').hover(function(){
		$(this).find('.user-info-card').show('fast');
	}, function(){
		$(this).find('.user-info-card').hide('fast');
	});

	$('.category-dropdown').hover(function(){
		$(this).parent().find('.category-each').dropdown('toggle');
		$(this).parent().find('.category-each').css({border:'1px solid #e7e7e7'});
	}, function(){
		$(this).parent().find('.category-each').dropdown('toggle');
		$(this).parent().find('.category-each').css({border:'1px solid white'});
	});

	$('.category-each').hover(function(){
		$(this).css({border:'1px solid #e7e7e7'});
	}, function(){
		$(this).css({border:'1px solid white'});
	});

	$('.nav-profile-image').hover(function(){
		$('.nav-profile-dropdown').dropdown('toggle');
		// $('.nav-profile-dropdown').addClass('open').show();
		$('.nav-username .caret').css({color: 'white'});
	}, function(){
		// $('.nav-profile-dropdown').removeClass('open').hide();
		$('.nav-profile-dropdown').dropdown('toggle');
		$('.nav-username .caret').css({color : '#555555'});
	});

	$('.barter-now button').click(function(){
		var url = $(this).attr('href');
		console.log(url);
		window.location.replace(url);
	});

});

