<?php

namespace App\Http\Controllers;

use App\Models\Map;
use App\Models\Kategori;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class MapController extends Controller
{
    public function index()
    {
        $data = [
            'maps' => Map::with('kategori')->get()->all(),
            'kategoris' => Kategori::pluck('kategori', 'id')->all(),
        ];
        return view('dashboard', $data);
    }

    public function place()
    {
        $data = [
            'maps' => Map::with('kategori')->paginate(10),
            'no' => 1
        ];
        $title = 'Delete Place !';
        $text = "Are you sure you want to delete?";
        confirmDelete($title, $text);
        return view('map.index', $data);
    }

    public function create(Request $request)
    {
        if ($request->ajax()) {
            $lat = $request->input('lat');
            $lng = $request->input('lng');

            return response()->json(['url' => route('map.create', ['lat' => $lat, 'lng' => $lng])]);
        }

        $data = [
            'kategoris' => Kategori::get()->all(),
        ];


        return view('map.create', $data);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            // 'mahasiswa_id' => 'required',
        ]);

        $data = Map::create($validated);

        // Alert::success('Succcess', 'Add Successfully');
        toast('Place has been added!', 'success');
        return redirect()->route('dashboard');
    }

    public function show(Map $map)
    {
        $data = [
            'map' => $map,
            'kategoris' => Kategori::get()->all(),
        ];

        return view('map.show', $data);
    }

    public function edit(Map $map)
    {
        $data = [
            'map' => $map,
            'kategoris' => Kategori::all(),
        ];

        return view("map.edit", $data);
    }

    public function update(Request $request, Map $map)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'deskripsi' => 'required',
            'kategori_id' => 'required',
            // 'mahasiswa_id' => 'required',
        ]);

        $map->update($validated);
        Alert::success('Succcess', 'Edit Successfully');
        return redirect()->route('map.index');
    }

    public function destroy(Map $map)
    {
        $map->delete();

        return redirect()->route('place')->with('success', "Delete Successfully");
    }
}
