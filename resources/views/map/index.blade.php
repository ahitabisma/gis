@extends('components.layout.app')

@section('content')
    <div class="card">
        <div class="card-header">

            <a href="{{ route('map.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Place</a>
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Place Name</th>
                        <th style="width: 450px">Description</th>
                        <th>Category</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maps as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama }}</td>
                            <td>{{ $item->deskripsi }}</td>
                            <td>{{ $item->kategori->kategori }}</td>
                            <td>
                                <a href="{{ route('map.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <a href="{{ route('map.show', $item->id) }}" class="btn btn-sm btn-success">Lihat</a>
                                <a href="{{ route('map.destroy', $item->id) }}" class="btn btn-sm btn-danger"
                                    data-confirm-delete="true">Delete</a>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer clearfix">
            <ul class="pagination pagination-sm m-0 float-right">
                {{ $maps->links() }}
            </ul>
        </div>
    </div>
@endsection
