<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    // Menampilkan seluruh data meja
    public function index()
    {
        $meja = Meja::all();

        return view('tables-basic', compact('meja'));
    }

    // Menampilkan form tambah meja
    public function create()
    {
        return view('ui-forms');
    }

    // Menyimpan data meja baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'nomor' => 'required|string|max:10',
            'kapasitas' => 'required|integer|min:1',
            'zonasi' => 'required|string|max:50',
            'status' => 'required|in:Available,Occupied,Booked'
        ]);

        Meja::create($data);

        return redirect()->route('meja.index');
    }

    // Menampilkan form edit meja
    public function edit($id)
    {
        $meja = Meja::findOrFail($id);

        return view('ui-edit', compact('meja'));
    }

    // Menyimpan perubahan data meja
    public function update(Request $request, $id)
    {
        $meja = Meja::findOrFail($id);

        $data = $request->validate([
            'nomor' => 'required|string|max:10',
            'kapasitas' => 'required|integer|min:1',
            'zonasi' => 'required|string|max:50',
            'status' => 'required|in:Available,Occupied,Booked'
        ]);

        $meja->update($data);

        return redirect()->route('meja.index');
    }

    // Menghapus data meja
    public function destroy($id)
    {
        $meja = Meja::findOrFail($id);

        $meja->delete();

        return redirect()->route('meja.index');
    }
}