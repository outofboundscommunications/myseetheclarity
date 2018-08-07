<?php
global $location_title, $location_address;
$location_map     = get_field('location_map');
$location_map_url = get_field('location_map_url');
?>
<?php // echo $location_map_url;?>
<div class="location_map_wrapper">
	
	<a id="mapmodals_lnk" class="location-map-link" href="<?php echo $location_map_url;?>" data-toggle="modal" role="button" target="_blank">View on Map</a>
	
	<!-- Modal -->
	<div class="modal fade" id="mapmodals">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title"><?php echo $location_title;?></h4>
				</div>
				<div class="modal-body">
					<div id="map-marker" data-lat="<?php echo $location_map['lat'];?>" data-lng="<?php echo $location_map['lng'];?>"></div>
					<div id="map-container"></div>
				</div>
				<?php /*?>
				<div class="modal-footer">
					<button type="button" class="close" data-dismiss="modal">Close</button>
				</div>
				<?php */?>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<!-- Map Info Wrapper -->
	<div id="mapInfoWrapper">
		<div id="mapInfo">
			<span class="map-info-title"><?php echo $location_title;?></span>
			<address><?php echo $location_address;?></address>
			<?php
			if( $location_map_url ){
				?>
				<a href="<?php echo $location_map_url;?>" target="_blank">View on Google Map</a>
				<?php
			}
			?>
		</div>
	</div>
</div>
<?php
if( $location_map ){
	?>
<?php /*?><script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script><?php */?>
<script src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script>
jQuery(document).ready(function($) {
	var var_map;
	var marker = $('#map-marker');
	mar_lat = $(marker).data('lat');
	mar_lng = $(marker).data('lng');
	// console.log(mar_lat);
	// console.log(mar_lng);
	var var_location = new google.maps.LatLng(mar_lat, mar_lng);
	// var map_container = $("#map-container");
	var map_container = document.getElementById("map-container");
	console.log(map_container);
	
	function map_init() {
		var map_options = {
			center: var_location,
			zoom: 14,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false,
			panControl:false,
			rotateControl:false,
			streetViewControl: false,
		};
		
		var_map = new google.maps.Map(map_container, map_options);
		
		// Info Window
		var infoContent = $('#mapInfoWrapper').html();
		var infoTitle = "Click for information";
		
		var var_infowindow = new google.maps.InfoWindow({
			content: infoContent
		});
		var var_marker = new google.maps.Marker({
			position: var_location,
			map: var_map,
			title: infoTitle,
			maxWidth: 200,
			maxHeight: 200
		});
		google.maps.event.addListener(var_marker, 'click', function() {
			var_infowindow.open(var_map,var_marker);
		});
	}
	
	google.maps.event.addDomListener(window, 'load', map_init);

	//start of modal google map
	$('.location_map_wrapper #mapmodals_lnk').on('click', function (event) {
		event.preventDefault();
		$('#mapmodals').modal();
	});
	$('#mapmodals').on('shown.bs.modal', function () {
		google.maps.event.trigger(var_map, "resize");
		return var_map.setCenter(var_location);
	});
});
</script>
<?php
}
?>