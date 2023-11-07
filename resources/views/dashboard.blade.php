@extends('components.layout.app')

@section('content')
    <div id="map" style="height: 350px" class="mb-5"></div>

    <div class="card card-primary" style="display: none" id="placeDetail">
        <div class="card-header">
            <h3 class="card-title">Place Detail</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                    <div class="row">
                        <div class="col-12 col-sm-13">
                            <h4 id="placeName"></h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Category</span>
                                    <span id="placeCategory" class="info-box-number text-center text-muted mb-0"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Latitude</span>
                                    <span id="placeLat" class="info-box-number text-center text-muted mb-0"></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <div class="info-box bg-light">
                                <div class="info-box-content">
                                    <span class="info-box-text text-center text-muted">Longitude</span>
                                    <span id="placeLng" class="info-box-number text-center text-muted mb-0">20</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                    <img src="{{ asset('img/marker/cv.png') }}" alt="" class="img-fluid">
                    <p id="placeDesc" class="text-muted"></p>
                    <br>
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>

    <script>
        // Map & Layer Control
        var pt = L.layerGroup();
        var cv = L.layerGroup();
        var pemerintah = L.layerGroup();

        var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '© OpenStreetMap'
        });

        var map = L.map('map', {
            center: [-7.42947, -250.664009],
            zoom: 12,
            layers: [osm, pt, cv, pemerintah]
        });

        var baseMaps = {
            "OpenStreetMap": osm,
        };

        var overlayMaps = {
            "PT": pt,
            "CV": cv,
            "Pemerintahan": pemerintah
        };

        L.control.layers(baseMaps, overlayMaps).addTo(map);

        // Icon
        var ptIcon = L.icon({
            iconUrl: '{{ asset('img/marker/pt.png') }}',
            iconSize: [50, 55],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76]
        });
        var cvIcon = L.icon({
            iconUrl: '{{ asset('img/marker/cv.png') }}',
            iconSize: [50, 55],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76]
        });
        var pemerintahIcon = L.icon({
            iconUrl: '{{ asset('img/marker/pemerintah.png') }}',
            iconSize: [50, 55],
            iconAnchor: [22, 94],
            popupAnchor: [-3, -76]
        });

        // Marker
        var maps = {!! json_encode($maps) !!};
        maps.forEach(function(marker) {
            var lat = marker.latitude;
            var lng = marker.longitude;
            var kategori = marker.kategori_id;
            var node;

            if (kategori === 1) {
                node = L.marker([lat, lng], {
                    icon: ptIcon
                });
                pt.addLayer(node);
            } else if (kategori === 2) {
                node = L.marker([lat, lng], {
                    icon: cvIcon
                });
                cv.addLayer(node);
            } else if (kategori === 3) {
                node = L.marker([lat, lng], {
                    icon: pemerintahIcon
                });
                pemerintah.addLayer(node);
            }

            // node.bindPopup(marker.nama);
            var categoryNames = {!! json_encode($kategoris) !!};

            node.on('click', function() {
                document.getElementById("placeDetail").style.display = 'block';
                document.getElementById("placeName").textContent = marker.nama;
                var category = categoryNames[marker.kategori_id];
                document.getElementById("placeCategory").textContent = category;
                document.getElementById("placeDesc").textContent = marker.deskripsi;
                document.getElementById("placeLat").textContent = marker.latitude;
                document.getElementById("placeLng").textContent = marker.longitude;
            });
        });

        // Popup
        var popup = L.popup();

        // Click Coordinate
        function onMapClick(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            popup
                .setLatLng(e.latlng)
                .setContent("<a href=# id='lat-lng'>Add New Place</a>")
                .openOn(map);

            document.getElementById('lat-lng').addEventListener('click', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('map.create') }}',
                    method: 'GET',
                    data: {
                        lat: lat,
                        lng: lng
                    },
                    success: function(response) {
                        window.location.href = response.url;
                    },
                    error: function() {
                        alert('Gagal mengirim data.');
                    }
                });
            });
        }

        map.on('click', onMapClick);
    </script>
@endsection
