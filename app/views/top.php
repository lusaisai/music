<button type="button" id="to-top" class="btn btn-default btn-lg">
	<span class="glyphicon glyphicon-chevron-up"></span>
</button>
<style>
	#to-top {
	position:fixed;
	bottom:25px;
	right:25px;
	display: none;
	}
</style>
<script>
	$(window).scroll(function() {
		if ( $(window).scrollTop() > 0 ) {
			$("#to-top").fadeIn();
		} else {
			$("#to-top").fadeOut();
		}
	});
	$("#to-top").click(function (argument) {
		$("html, body").animate({ scrollTop: 0 });
	});
</script>
