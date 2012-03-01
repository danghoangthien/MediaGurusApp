<? include_once "../../config.php"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<? include "../../theme/whitelabelTheme/template/head.html"; ?> 
<script src="google_api_handle.js"></script>
<script type="text/x-jquery-tmpl" id="bank_chooser_tmpl">
	    {{if row.bank_id=="1"}}
		<option value="${row.bank_id}" selected="selected">${row.bank_name}</option>
		{{/if}}
		{{if row.bank_id!=="1"}}
    	<option value="${row.bank_id}">${row.bank_name}</option>
		{{/if}}
</script>
<script type="text/javascript">
    $.fn.ready(function(){
		 $("#bank_id").selectbind({
		  	data:{type:"get_all"},
			url:"../../module/bank.php",
			template:"#bank_chooser_tmpl"
		 })
		$("#action").click(function(){
			$.ajax({
				type	:"POST",
				data	:$('form#manage').serializeArray(),
				dataType:"xml",
				url		:"../../htinmotion/orm/atm/core.php?type=add_atm",
				success	:function(xml){
						jQuery.facebox($(xml).find("status").text());
						}
			})	
		});
		var map=init_map(10.794641154236784,106.6693022074096);
		var marker2 = new google.maps.Marker({position: new google.maps.LatLng(10.794641154236784, 106.6693022074096), map: map,draggable: true});
			google.maps.event.addListener(marker2, 'dragstart', function() {
		});
		google.maps.event.addListener(marker2, 'drag', function() {
			updateMarkerPosition(marker2.getPosition())
		  });
		google.maps.event.addListener(marker2, 'dragend', function() {
			updateMarkerPosition(marker2.getPosition());
		  });
		var input = document.getElementById('atm_address');
		var autocomplete = new google.maps.places.Autocomplete(input, {});
		autocomplete.bindTo('bounds',map)
			google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace();
		  if (place.geometry.viewport) {
			map.fitBounds(place.geometry.viewport);
		  } else {
			map.setCenter(place.geometry.location);
			map.setZoom(16);
		  }
		  marker2.setPosition(place.geometry.location);
		  updateMarkerPosition(place.geometry.location);
		  //infowindow.setContent(place.name);
		  //infowindow.open(map, marker);
		});
	});
</script>
<body>
	<div id="pageoptions">
	<? include "../../theme/whitelabelTheme/template/pageoptions.html"; ?> 
    	<!--#include file="file:///C|/AppServ/www/Theme/template/pageoptions.html" --> 
    </div>
	<header>
    <? include "../../theme/whitelabelTheme/template/header.html"; ?> 
		<!--#include file="file:///C|/AppServ/www/Theme/template/header.html" --> 
	</header>
    <nav>
	 <? include "../../theme/whitelabelTheme/template/nav.html"; ?> 
	</nav>			
	<section id="content">
     <? include "form.php"; ?>     
</section>
<footer>Developed by HT-In-Motion </footer>
</body>
</html>
