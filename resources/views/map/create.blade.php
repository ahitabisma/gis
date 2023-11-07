@extends('components.layout.app')

@section('content')
    <div id="map" style="height: 400px"></div>

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Add New Place</h3>
        </div>
        <form action="{{ route('map.store') }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group grid-cols-2">
                    <label for="placeName">Place Name</label>
                    <input type="text" name="nama" class="form-control" id="placeName" placeholder="Enter Place Name">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" class="form-control" id="latitude"
                                value="{{ request('lat') }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" class="form-control" id="longitude"
                                value="{{ request('lng') }}">
                        </div>
                    </div>
                </div>
                <div class="form-group grid-cols-2">
                    <label for="description">Description</label>
                    <textarea name="deskripsi" class="form-control" id="description" placeholder="Enter Description" cols="30"
                        rows="10"></textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="kategori_id" class="form-control">
                        @foreach ($kategoris as $item)
                            <option value="{{ $item->id }}">{{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add Place</button>
            </div>
        </form>
    </div>

    <script>
        // Map
        var map = L.map('map').setView([-7.42947, -250.664009], 13);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        var markerOld = L.marker([{{ request('lat') }}, {{ request('lng') }}]).addTo(map);
        var previousMarker = null;

        // Popup
        var popup = L.popup();

        // Click Coordinate
        function onMapClick(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (markerOld) {
                if (previousMarker) {
                    map.removeLayer(previousMarker);
                }

                var newMarker = L.marker([lat, lng]).addTo(map);

                previousMarker = newMarker;
            }

            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

        }
        map.on('click', onMapClick);
    </script>
@endsection
