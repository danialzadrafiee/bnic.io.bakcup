<relative class="relative block h-[380px]">

    <div id="mapid" class="rounded-xl absolute z-0 w-full"></div>
    <input type="text" id="address" class=" absolute input bg-white z-10 right-4 top-4 input-sm input-bordered border-neutral-5/30 "
        placeholder="Search location" />
</relative>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<style>
    #mapid {
        height: 380px;
    }
</style>

<script>
    var map = L.map('mapid').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    var marker;
    map.on('click', function(e) {
        if (marker) {
            map.removeLayer(marker);
        }
        marker = L.marker(e.latlng).addTo(map);
        $('.js_map_lng').val(e.latlng).change();
    });

    $("#address").autocomplete({
        source: function(request, response) {
            $.ajax({
                url: `https://nominatim.openstreetmap.org/search?format=json&q=${request.term}`,
                dataType: "json",
                success: function(data) {
                    response($.map(data, function(item) {
                        return {
                            label: item.display_name,
                            value: item.display_name,
                            latlng: [item.lat, item.lon]
                        };
                    }));
                }
            });
        },
        minLength: 2,
        select: function(event, ui) {
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker(ui.item.latlng).addTo(map);
            map.flyTo(ui.item.latlng, map.getZoom());
        }
    });
</script>
