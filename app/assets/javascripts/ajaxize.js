$(function () {
	var header = $('#top-header');
	var main = $('#main');

	var headLinkRewrite = function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		$.get( link, function( html ) {
			var result = $('<result>').append($.parseHTML(html));
			header.html( result.find('#top-header').html() );
			main.html( result.find('#main').html() );
		});

		if (history.pushState) {history.pushState('', '', link ); }

	};

	var paginationLinkRewrite = function(e){
		e.preventDefault();
		var link = $(this).attr('href');
		$.get( link, function( html ) {
			var result = $('<result>').append($.parseHTML(html));
			$('#data').html( result.find('#data').html() );
		});

		if (history.pushState) {history.pushState('', '', link ); }

	};

	var searchFormRewrite = function(e){
		e.preventDefault();
		var link = $(this).attr('action') + '?' + $("#searching form").serialize();
		$.get( link, function( html ) {
			var result = $('<result>').append($.parseHTML(html));
			$('#data').html( result.find('#data').html() );
		});

		if (history.pushState) {history.pushState('', '', link ); }

	};



	header.on( 'click', 'a', headLinkRewrite );
	main.on( 'click', '.pagination a', paginationLinkRewrite );
	main.on( 'submit', "#searching form", searchFormRewrite );
});