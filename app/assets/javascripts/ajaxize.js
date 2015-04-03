$(function () {
	var header = $('#top-header');
	var main = $('#main');

	var ajaxized = function () {
		$.event.trigger({
			type: "ajaxized",
			message: "ajaxized",
			time: new Date()
		});

	};

	var progress_start = function(){
		$('#ajaxized-box').remove();
		var div = '<div id="ajaxized-box" style="width:100%;height:5px;position:fixed;top:0px;left:0px;z-index:100;">' +
		'<div id="ajaxized-progress" style="width:0%;height:100%;background-color:lightgreen;""></div>' +
		'</div>';
		$("body").prepend(div);
		$('#ajaxized-progress').animate({width: '99%'}, 1000);
	};
	

	var progress_end = function (complete) {
		var jbox = $('#ajaxized-box');
		var jpgs = $('#ajaxized-progress');

		jpgs.stop();
		jpgs.animate({width: '100%'}, 10, complete);
		jbox.fadeOut();
	};


	var headLinkRewrite = function(e){
		e.preventDefault();
		progress_start();
		var link = $(this).attr('href');
		$.get( link, function( html ) {
			progress_end(function () {
				var result = $('<result>').append($.parseHTML(html, true));
				header.html( result.find('#top-header').html() );
				main.html( result.find('#main').html() );
				ajaxized();
			});
		});

		if (history.pushState) {history.pushState('', '', link ); }
		
	};

	var paginationLinkRewrite = function(e){
		e.preventDefault();
		progress_start();
		var link = $(this).attr('href');
		$.get( link, function( html ) {
			progress_end(function () {
				var result = $('<result>').append($.parseHTML(html));
				$('#data').html( result.find('#data').html() );
				ajaxized();
			});
			
		});

		if (history.pushState) {history.pushState('', '', link ); }
		
	};

	var searchFormRewrite = function(e){
		e.preventDefault();
		progress_start();
		var link = $(this).attr('action') + '?' + $("#searching form").serialize();
		$.get( link, function( html ) {
			progress_end(function () {
				var result = $('<result>').append($.parseHTML(html));
				$('#data').html( result.find('#data').html() );
				ajaxized();
			});
		});

		if (history.pushState) {history.pushState('', '', link ); }
		
	};



	header.on( 'click', 'a[data-remote="true"]', headLinkRewrite );
	main.on( 'click', '.pagination a', paginationLinkRewrite );
	main.on( 'submit', "#searching form", searchFormRewrite );
});