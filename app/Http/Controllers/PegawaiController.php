<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pegawai;

class PegawaiController extends Controller
{
    public function index()
    {
        $pegawai = Pegawai::all();

        return view('index', compact('pegawai'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nomor_kontak' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
        ]);

        Pegawai::create([
            'nama_pegawai' => $request->nama_pegawai,
            'nomor_kontak' => $request->nomor_kontak,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
        ]);

        return redirect('/')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        return view('edit', compact('pegawai'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_pegawai' => 'required',
            'nomor_kontak' => 'required',
            'jabatan' => 'required',
            'status' => 'required',
        ]);

        $pegawai = Pegawai::findOrFail($id);

        $pegawai->update([
            'nama_pegawai' => $request->nama_pegawai,
            'nomor_kontak' => $request->nomor_kontak,
            'jabatan' => $request->jabatan,
            'status' => $request->status,
        ]);

        return redirect('/')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        $pegawai->delete();

        return redirect('/')->with('success', 'Data pegawai berhasil dihapus!');
    }

}
