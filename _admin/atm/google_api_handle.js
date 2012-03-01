// JavaScript Document
function updateMarkerPosition(latLng) {
  		$('#latitude').val(latLng.lat());
		$('#longitude').val(latLng.lng());
		geocodePosition(latLng);
}
function updateMarkerPosition2(lat,lng) {
  		$('#latitude').val(lat);
		$('#longitude').val(lng);
		//geocodePosition(latLng);
}
var geocoder = new google.maps.Geocoder();
function geocodePosition(pos) {
	  geocoder.geocode({
		latLng: pos
	  }, function(responses) {
		if (responses && responses.length > 0) {
		  updateMarkerAddress(responses[0].formatted_address);
		} else {
		  updateMarkerAddress('Chưa xác định được vị trí từ điểm này.');
		}
	  });
}
function updateMarkerAddress(str) {
  		//$("#address").html(str);
	}
function init_map(lat,lng){
		var map = new google.maps.Map(document.getElementById('map'), {
      	zoom: 16,
      	center: new google.maps.LatLng(lat, lng),
      	mapTypeId: google.maps.MapTypeId.ROADMAP
    	});
		return map;
}