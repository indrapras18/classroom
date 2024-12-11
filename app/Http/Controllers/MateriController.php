<?php

namespace App\Http\Controllers;

use App\Models\Materis;
use Illuminate\Http\Request;

class MateriController extends Controller
{
    function materi()
    {
        $materi = Materis::all();
        return view('pages/teacher/materi', compact('materi'));
    }

    function formMateri()
    {
        return view('pages/teacher/uploadMateri');
    }

    function tambahMateri(Request $request)
    {
        $request->validate([
            'nama_materi' => 'required|string|max:255',
            'content' => 'required|string',
            'link' => 'required|url|max:255',
        ]);

        Materis::create($request->all());
        return redirect()->route('materi')->with('success', 'Materi Berhasil Ditambahkan!');
    }

    function deleteMateri($id)
    {
        $data = Materis::find($id);
        $data->delete();
        return redirect()->route('materi')->with('success', 'Materi Berhasil Dihapus!');
    }

    function tampildataMateri($id)
    {
        $data = Materis::find($id);
        return view('pages/teacher/tampildataMateri', compact('data'));
    }


    // function detailMateri($id) {
    //     $data = Materis::find($id);
    //     $next = Materis::where('id', '>', $id)->orderBy('id')->first();
    //     return view('pages/teacher/detailMateri', compact('data', 'next'));
    // }

    function detailMateri($id, $page = 1)
    {
        $data = Materis::find($id);
        $next = Materis::where('id', '>', $id)->orderBy('id')->first();
        $previous = Materis::where('id', '<', $id)->orderBy('id', 'desc')->first();
        return view('pages/teacher/detailMateri', compact('data', 'next', 'page', 'previous'));
    }

    function uploadMateri()
    {
        return view('pages/teacher/uploadMateri');
    }

    function updateMateri($id, Request $request)
    {
        $data = Materis::find($id);
        $data->update($request->all());
        return redirect()->route('materi')->with('success', 'Materi Berhasil Diperbarui!');
    }

    function materiStudent()
    {
        $materi = Materis::all();
        return view('pages/student/materiStudent', compact('materi'));
    }

    function detailMateriStudent($id, $page = 1)
    {
        $data = Materis::find($id);
        $next = Materis::where('id', '>', $id)->orderBy('id')->first();
        $previous = Materis::where('id', '<', $id)->orderBy('id', 'desc')->first();
        return view('pages/student/detailMateriStudent', compact('data', 'next', 'previous', 'page'));
    }
}
