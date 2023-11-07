@extends('components.layout.app')

@section('content')
    <div class="card-body">
        <div class="form-group grid-cols-2">
            <label for="placeName">Place Name</label>
            <input type="text" name="nama" class="form-control" id="placeName" placeholder="Enter Place Name"
                value="{{ $map->nama }}" disabled>
        </div>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="latitude">Latitude</label>
                    <input type="text" name="latitude" class="form-control" id="latitude" value="{{ $map->latitude }}"
                        disabled>
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="longitude">Longitude</label>
                    <input type="text" name="longitude" class="form-control" id="longitude" value="{{ $map->longitude }}"
                        disabled>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="category">Category</label>
            <select id="category" name="kategori_id" class="form-control" disabled>
                @foreach ($kategoris as $item)
                    <option value="{{ $item->id }}" {{ $item->id == $map->kategori_id ? 'selected' : null }}>
                        {{ $item->kategori }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="card-footer">
        <a href="{{ route('map.edit', $map->id) }}" class="btn btn-warning">Edit Place</a>
        <a href="{{ route('place') }}" class="btn btn-success">Back</a>
    </div>
@endsection
