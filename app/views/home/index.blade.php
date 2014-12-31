@extends('layouts.master')

@section('main')
<div id="randoms">
	<h3>Random Playing</h3>
	<form role="form" class="form-inline form-search" method="get" autocomplete="off">
	    <input name="words" style="width:200px" type="text" class="form-control" placeholder="品冠">
	    <button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-search"></span> Random</button>
	    <select name="type" class="type form-control" style="width:135px">
	        <option value="artist-name">Artist Name</option>
	        <option value="album-name">Album Name</option>
	        <option value="song-name">Song Name</option>
	    </select>
      <div class="input-group number-spinner">
        <span class="input-group-btn">
          <button class="btn btn-default minus" type="button">
            <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
          </button>
        </span>
        <input type="text" name="song-number" class="form-control" value="15">
        <span class="input-group-btn">
          <button class="btn btn-default plus" type="button">
            <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
          </button>
        </span>
      </div>
	</form>
</div>
<div id="popular-songs" class="tops">
<h3>Popular Songs</h3>

<div class="timeline btn-group" data-toggle="buttons">
  <label time="week" class="btn btn-primary">
    <input  type="radio" name="options"> Week
  </label>
  <label time="month" class="btn btn-primary">
    <input type="radio" name="options"> Month
  </label>
  <label time="all" class="btn btn-primary active">
    <input type="radio" name="options"> All
  </label>
</div>

<div class="userstatus btn-group" data-toggle="buttons">
	@if (Auth::check())
		<label user="user" class="btn btn-primary">
			<input type="radio" name="options"> Mine
		</label>
	@endif
  	<label user="all" class="btn btn-primary active">
    	<input type="radio" name="options"> All
  	</label>
</div>
<div id="top-song-cloud"></div>
<script>
(function () {
  var jspinner = $('.number-spinner');
  var jinput = jspinner.find('input');

  var check = function () {
    if ( ! $.isNumeric(jinput.val()) ) {
      jinput.val(15);
    }
  };
  
  jspinner.find('.minus').click(function(event) {
    check();
    jinput.val( parseInt(jinput.val(),10) - 1 );
  });
  jspinner.find('.plus').click(function(event) {
    check();
    jinput.val( parseInt(jinput.val(),10) + 1 );
  });
}());

(function() {
  var fetchData = function(user, time) {
    $('#top-song-cloud').fadeOut();
    $.ajax({
      dataType: "json",
      url: "/home/popularsongs/" + user + "/" + time,
      success: function( data, textStatus, jqXHR) {
        setCloud(data);
        $('#top-song-cloud').fadeIn();
      }
    });
  };

  var fontSize = d3.scale.log().range([20, 30]);

  var setCloud = function(data) {
    d3.layout.cloud()
      .size([800, 600])
      .words(data)
      .timeInterval(50)
      .text(function(d) { return d.song_name; })
      .padding(5)
      .rotate(function(d) { return ~~(Math.random() * 5) * 30 - 60; })
      .font("Impact")
      .fontSize(function(d) { return fontSize(d.cnt); })
      .on("end", draw)
      .start();
  };

  var fill = d3.scale.category20();

  var draw = function (words) {
    d3.select("#top-song-cloud")
      .html('')
      .append("svg")
      .attr("width", 800)
      .attr("height", 600)
      .append("g")
      .attr("transform", "translate(385,320)")
      .selectAll("text")
      .data(words)
      .enter()
      .append("text")
      .style("font-size", function(d) { return d.size + "px"; })
      // .style("font-family", "Impact")
      .style("fill", function(d, i) { return fill(i); })
      .attr('song-id', function(d){return d.song_id;})
      .attr("text-anchor", "middle")
      .attr("transform", function(d) {
        return "translate(" + [d.x, d.y] + ")rotate(" + d.rotate + ")";
      })
      .text(function(d) { return d.text; })
      ;
  };

  fetchData('all', 'all');

  $("#popular-songs .timeline label").click(function() {
    var user = $("#popular-songs .userstatus label.active").attr("user");
  	var time = $(this).attr("time");
    fetchData(user, time);
  });
  $('#popular-songs .userstatus label').not(".disabled").click(function () {
    var user = $(this).attr("user");
  	var time = $("#popular-songs .timeline label.active").attr("time");
  	fetchData(user, time);
  });

})();

</script>
</div>

@stop