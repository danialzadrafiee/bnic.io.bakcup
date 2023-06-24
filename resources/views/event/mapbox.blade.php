<mapbox class="relative block w-full">
    <div id="mapid" class="rounded-xl w-full"></div>
    <input type="text" id="address" class="absolute top-3 right-3 input input-sm input-bordered " placeholder="Search location" />
    {{-- <button class="js_log_location">Log Location</button> --}}
</mapbox>

<script src='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<link href='https://api.mapbox.com/mapbox-gl-js/v2.6.1/mapbox-gl.css' rel='stylesheet' />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #mapid {
        height: 380px;
    }
</style>
<script>
    mapboxgl.accessToken = "pk.eyJ1Ijoic3ViZGFuaWFsIiwiYSI6ImNsNTU4NXhmMTE2dXUzZG1hN3FqZGh5dHMifQ.xycsm0V8ywnavBW3lUk94A";
    var map = new mapboxgl.Map({
        container: 'mapid',
        style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
        center: [-0.09, 51.505], // starting position [lng, lat]
        zoom: 13 // starting zoom
    });

    var marker;

    map.on('click', function(e) {
        if (marker) {
            marker.remove();
        }
        marker = new mapboxgl.Marker()
            .setLngLat([e.lngLat.lng, e.lngLat.lat])
            .addTo(map);
    });
    map.on('dataloading', () => {
        window.dispatchEvent(new Event('resize'));
    });
    setTimeout(() => {
        window.dispatchEvent(new Event('resize'))
    }, 0)

    document.querySelector('.js_log_location').addEventListener('click', function() {
        if (marker) {
            console.log('Location:', marker.getLngLat());
        }
    });

    // Initialize Autocomplete with Mapbox's Geocoding API
    $("#address").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: "https://api.mapbox.com/geocoding/v5/mapbox.places/" + request.term + ".json",
                data: {
                    access_token: mapboxgl.accessToken
                },
                success: function(data) {
                    response($.map(data.features, function(item) {
                        return {
                            label: item.place_name,
                            value: item.place_name,
                            coordinates: item.center
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            if (marker) {
                marker.remove();
            }
            marker = new mapboxgl.Marker()
                .setLngLat(ui.item.coordinates)
                .addTo(map);
            map.flyTo({
                center: ui.item.coordinates
            });
        }
    });
</script>
