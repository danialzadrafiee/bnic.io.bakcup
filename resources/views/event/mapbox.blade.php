<mapbox class="relative block w-full">
    <div id="mapid" class="rounded-xl w-full"></div>
    <input type="text" id="address" class="absolute top-3 right-3 input input-sm input-bordered border-neutral-5/30 " placeholder="Search location" />
    {{-- <button class="js_log_location">Log Location</button> --}}
</mapbox>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/mapbox-gl@2.15.0/dist/mapbox-gl.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/mapbox-gl@2.15.0/dist/mapbox-gl.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<style>
    #mapid {
        height: 380px;
    }
</style>
<script>
    mapboxgl.accessToken = "pk.eyJ1Ijoic3ViZGFuaWFsIiwiYSI6ImNsNTU3cmcwdjE2cm0zZnFxdm1pemZ3cjQifQ.fLqs4EX703SYVVE0DzknNw";

    var map = new mapboxgl.Map({
        container: 'mapid',
        style: 'mapbox://styles/mapbox/streets-v11', // stylesheet location
        center: [-0.09, 51.505], // starting position [lng, lat]
        zoom: 13 // starting zoom
    });

    var marker;
    window.map_lng = [];
    map.on('click', function(e) {
        if (marker) {
            marker.remove();
        }
        marker = new mapboxgl.Marker()
            .setLngLat([e.lngLat.lng, e.lngLat.lat])
            .addTo(map);
        map_lng = [e.lngLat.lng, e.lngLat.lat]
        $('.js_map_lng').val(map_lng).change()
    });
    map.on('dataloading', () => {
        window.dispatchEvent(new Event('resize'));
    });
    setTimeout(() => {
        window.dispatchEvent(new Event('resize'))
    }, 0)



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
