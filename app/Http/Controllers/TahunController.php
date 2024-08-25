<?php

namespace App\Http\Controllers;

use App\Models\Tahun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TahunController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('tahun.index', [
            'tahuns'    => Tahun::orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tahun.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tahun'             => 'required'
        ], [
            'tahun.required'    => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Tahun::create([
            'tahun'     => $request->tahun
        ]);

        return redirect('/tahun')->with('success', 'Berhasil menambahkan data tahun');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tahun $tahun)
    {
        return view('tahun.edit', [
            'tahun'     => $tahun
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tahun $tahun)
    {
        $validator = Validator::make($request->all(), [
            'tahun'             => 'required'
        ], [
            'tahun.required'    => 'Form wajib diisi !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $tahun->update([
            'tahun'     => $request->tahun
        ]);

        return redirect('/tahun')->with('success', 'Berhasil memperbarui data tahun');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tahun $tahun)
    {
        $tahun->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data tahun');
    }
}
