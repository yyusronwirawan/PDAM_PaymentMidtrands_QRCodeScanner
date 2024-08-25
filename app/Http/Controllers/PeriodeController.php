<?php

namespace App\Http\Controllers;

use App\Models\Bulan;
use App\Models\Tahun;
use App\Models\Periode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('periode.index', [
            'periodes'     => Periode::with(['bulan', 'tahun'])->orderBy('id', 'DESC')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periode.create', [
            'bulans'    => Bulan::all(),
            'tahuns'    => Tahun::all() 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'periode'   => 'required',
            'bulan_id'  => 'required',
            'tahun_id'  => 'required',
        ], [
            'periode.required'  => 'Form wajib diisi !', 
            'bulan_id.required' => 'Pilih bulan !',
            'tahun_id.required' => 'Pilih tahun !'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Periode::create([
            'periode'   => $request->periode,
            'bulan_id'  => $request->bulan_id,
            'tahun_id'  => $request->tahun_id
        ]);

        return redirect('/periode')->with('success', 'Berhasil menambahkan periode baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Periode $periode)
    {
        return view('periode.edit', [
            'periode'   => $periode,
            'bulans'    => Bulan::all(),
            'tahuns'    => Tahun::all() 
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Periode $periode)
    {
        $validator = Validator::make($request->all(), [
            'periode'   => 'required',
            'bulan_id'  => 'required',
            'tahun_id'  => 'required',
            'status'    => 'required'
        ], [
            'periode.required'  => 'Form wajib diisi !', 
            'bulan_id.required' => 'Pilih bulan !',
            'tahun_id.required' => 'Pilih tahun !',
            'status.required'   => 'Pilih status'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $periode->update([
            'periode'   => $request->periode,
            'bulan_id'  => $request->bulan_id,
            'tahun_id'  => $request->tahun_id,
            'status'    => $request->status
        ]);

        return redirect('/periode')->with('success', 'Berhasil memperbarui data periode');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Periode $periode)
    {
        $periode->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data periode !');
    }
}
