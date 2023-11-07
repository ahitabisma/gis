@extends('components.layout.app')

@section('content')
    <div>
        <div id="map"></div>
        <form action="{{ route('map.update', $map->id) }}" method="POST">
            @csrf
            <div class="card-body">
                <div class="form-group grid-cols-2">
                    <label for="placeName">Place Name</label>
                    <input type="text" name="nama" class="form-control" id="placeName" placeholder="Enter Place Name"
                        value="{{ $map->nama }}">
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="latitude">Latitude</label>
                            <input type="text" name="latitude" class="form-control" id="latitude"
                                value="{{ $map->latitude }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="longitude">Longitude</label>
                            <input type="text" name="longitude" class="form-control" id="longitude"
                                value="{{ $map->longitude }}">
                        </div>
                    </div>
                </div>
                <div class="form-group grid-cols-2">
                    <label for="description">Description</label>
                    <textarea name="deskripsi" class="form-control" id="description" placeholder="Enter Description" cols="30"
                        rows="10">{{ $map->deskripsi }}</textarea>
                </div>
                <div class="form-group">
                    <label for="category">Category</label>
                    <select id="category" name="kategori_id" class="form-control">
                        @foreach ($kategoris as $item)
                            <option value="{{ $item->id }}" {{ $item->id == $map->kategori_id ? 'selected' : null }}>
                                {{ $item->kategori }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Edit Place</button>
            </div>
        </form>
    </div>
@endsection
