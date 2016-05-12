'use strict';

$(function(){

	$(document).on('click', '.call-ajax', function(e){
		e.preventDefault();

		var id = $(this).data('item-id');
		var url = $(this).data('url');
		var params = $(this).data('params') || null;

		$.ajax({
			method: "POST",
			url: url,
			data: { id: id, params: params }
		}).done(function(result){

			$(this).trigger('update-favorite-button', function(){
			});

		});

	});

	$(document).on('click', '.auto-save-search', function(){
		var that = $(this);
		var url = (that.text() == 'View saved searches' ? base_url + that.data('url') : base_url + 'item/post_saved_searches');

		$.ajax({
			method: 'POST',
			url: url,
			data : {
					term: that.data('term'),
					url_query: that.data('query-url')
			},
			success : function(data){
				if (data == 1) {
						that.text('View saved searches');
				}

			}
		});
	});

	$(document).on('click', '.pop-modal', function(e){
		e.preventDefault();

		var id = $(this).data('itemid');
		var account_id = $(this).data('accountid');
		var search = $(this).data('term');
		var url = $(this).data('url');
		var options = $(this).data('options');

		var data = {
			id: id,
			account_id: account_id,
			search : search,
			options : options
		}

		var that = $('#myModal');
		that.find('.modal-content').empty();

		//pop the modal
		that.modal('show');

		$.ajax({
			method: "POST",
			url: base_url + url,
			data: data
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
			var that_comments = $('.reload-comments-' + itemid);
			var that_comments_count = $('.reload-comments-count-' + itemid);
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
				$('.modal-content').html('<div class="alert alert-success"><span>Comment has been added.</span></div>');
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
				$('.modal-content').html('<div class="alert alert-success">'+result+'</div>');
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
if (url.search('/message') == -1 && url.match('#')) {
	$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;

	var href = url.split('#')[1]
	$.ajax({
		type : 'GET',
		url : base_url + 'message/' + href,
		success : function(result){
			if(href.typeof !== undefined){
				$('.content-title').html(href[0].toUpperCase() + href.substr(1));
				$('.content-body').html(result);
			}
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
		style: 'btn-default btn-block',
		size: 3
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
		// $('.nav-profile-dropdown').dropdown('toggle');
		$('.nav-profile-dropdown').addClass('open').show();
		$('.nav-username .caret').css({color: 'white'});
	}, function(){
		$('.nav-profile-dropdown').removeClass('open').hide();
		// $('.nav-profile-dropdown').dropdown('toggle');
		$('.nav-username .caret').css({color : '#555555'});
	});

	$('.nav-sub-category').click(function() {
		$('#navbar-open').toggleClass('hidden');
		$('#navbar-close').toggleClass('hidden');
	});

	$('.barter-now button').click(function(){
		var url = $(this).attr('href');
		console.log(url);
		window.location.replace(url);
	});

	$('.listing-order-label').change(function(){
		$(this).submit();
	});

	$('.category-card-parent').click(function(){

		$('.category-card-parent').each(function(i, v){
			var prevColor = $(v).data('category-color');
			$(v).css({backgroundColor: 'white', color: prevColor, boder: '1px solid' + prevColor});
		});

		var color = $(this).data('category-color');
		$(this).css({
			backgroundColor: color,
			color: 'white'
		});
	});

	$('#description-editor').wysihtml5({
		"font-styles": true, //Font styling, e.g. h1, h2, etc. Default true
		"emphasis": true, //Italics, bold, etc. Default true
		"lists": true, //(Un)ordered lists, e.g. Bullets, Numbers. Default true
		"html": false, //Button which allows you to edit the generated HTML. Default false
		"link": true, //Button to insert a link. Default true
		"image": true, //Button to insert an image. Default true,
		"color": false, //Button to change color of font
		"blockquote": true, //Blockquote
		"size": '12' //default: none, other options are xs, sm, lg
	});

	$('#tags-input').tagsinput({
		tagClass: 'label label-primary',
		confirmKeys: [44, 18, 32, 13],
		// itemValue: 'label',
	});


	var item_id = $('#tags-input').data('item-id')

	$.get(base_url + 'item/get_tags_json/' + item_id, function(data){
		$.each(data, function(k, v){
			console.log(k, v.tag_term);
			$('#tags-input').tagsinput('add', { label: $.trim(v.tag_term) });
		});
	});


	var names = new Bloodhound({
		datumTokenizer: Bloodhound.tokenizers.whitespace,
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		// `states` is an array of state names defined in "The Basics"
		remote: {
	    url: base_url + 'item/get_item_names_json/%QUERY',
			wildcard: '%QUERY',
			cache: true

	  }
	});

	$('#nav-search').typeahead({
		hint: true,
		highlight: true,
		minLength: 1
	},
	{
		name: 'name',
		source: names
	});

	$('#searches-tabs').click(function(e){
		e.preventDefault();
		$(this).tab('show');
	});

});
