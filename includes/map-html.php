<script src="//maps.googleapis.com/maps/api/js?v=3.exp&amp;sensor=false&amp;libraries=places"></script>
<script>
(function($) {
    var map;
    var activeMarker = null;
    var markersArray = [];

    $(function() {
        map = new google.maps.Map(document.getElementById('map'), {
            center: {lat: 37.9, lng: -79.5},
            mapTypeId: google.maps.MapTypeId.TERRAIN,
            scrollwheel: false,
            zoom: 7
        });
    });

    $(document).on('facetwp-loaded', function() {
        clearOverlays();

        $.each(window.map_data,function(idx, val) {
            var coords = val.coords.split(', ');

            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(
                    parseFloat(coords[0]),
                    parseFloat(coords[1])
                ),
                info: new google.maps.InfoWindow({
                    content: val.title + val.distance
                })
            });

            google.maps.event.addListener(marker, 'click', function() {
                if (null !== activeMarker) {
                    activeMarker.info.close();
                }
                marker.info.open(map, marker);
                activeMarker = marker;
            });

            markersArray.push(marker);
        });
    });

    // Clear markers
    function clearOverlays() {
        for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
        }
        markersArray = [];
    }
})(jQuery);
</script>

<div id="map" style="width:100%; height:400px"></div>
