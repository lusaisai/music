$(function() {
	var process = function function_name (data) {
		return function( request, response ) {
			var maxCount = 15;
			var term = request.term;
			var items = [];

			var count = 0;
			for (var i = 0; i < data.length; i++) {
				if ( data[i].pinyin_name.toLowerCase().indexOf(term.toLowerCase()) >= 0 || data[i].name.toLowerCase().indexOf(term.toLowerCase()) >= 0 ) {
					items.push(data[i].name);
					count++;
				}
				if ( count > maxCount ) { break; }
			};
			response( items );
		}
	};

	var preFetchData = function (type) {
		$.getJSON( '/utils/' + type, function (type) {
			$(".form-search input").autocomplete({
				minLength: 1,
				source: process(type),
				select: function( e, ui ) {
					e.preventDefault();
					$("form.form-search input").val(ui.item.value);
					$("form.form-search").submit();
				}
			});
		});
	};

	var run = function () {
		$( "select.type" ).change(function() {
			var select = $( this ).val();

			if ( select == 'artist-name' ) {
				preFetchData('artists');
			} else if ( select == 'album-name' ) {
				preFetchData('albums');
			} else {
				preFetchData('songs');
			}
		});

		var pagetype = $('#data').attr('pagetype');

		if ( pagetype == 'artists' || pagetype == undefined ) {
			preFetchData('artists');
		} else if ( pagetype == 'albums' ) {
			preFetchData('albums');
		} else {
			preFetchData('songs');
		}
	};

	run();

	$(document).on( 'ajaxized', function () {
        run();
    });
});


