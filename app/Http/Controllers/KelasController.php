<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{

    function kelas()
    {
        $semuaKelas = Kelas::all();
        return view('pages/teacher/kelas', compact('semuaKelas'));
    }

    function tambahKelas(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
        ]);
        Kelas::create($request->all());
        return redirect()->route('kelas')->with('success', 'Data Kelas Berhasil Ditambahkan!');
    }


    function tampildata($id)
    {
        $data = Kelas::find($id);
        return view('pages/teacher/tampildata', compact('data'));
    }

    function updateKelas($id, Request $request)
    {
        $data = Kelas::find($id);
        $data->update($request->all());
        return redirect()->route('kelas')->with('success', 'Data Kelas Berhasil Diperbarui!');
    }

    function deleteKelas($id)
    {
        $data = Kelas::find($id);
        $data->delete();
        return redirect()->route('kelas')->with('success', 'Data Kelas Berhasil Dihapus!');
    }
}
