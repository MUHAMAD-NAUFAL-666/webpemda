<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;
use App\Models\Regency;
use App\Models\District;
use App\Models\Village;

class DocumentController extends Controller
{
    public function create()
    {
        $regencies = Regency::all(); // Ambil data kabupaten
        return view('documents.create', compact('regencies'));
    }

    public function getDistricts($regencyId)
    {
        $districts = District::where('regency_id', $regencyId)->pluck('name', 'id');
        return response()->json($districts);
    }

    public function getVillages($districtId)
    {
        $villages = Village::where('district_id', $districtId)->get();
        return response()->json($villages);
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokumen_dipinjam' => 'required',
            'jenis_no_hak_di_208' => 'required',
            'regency_id' => 'required',
            'district_id' => 'required',
            'village_id' => 'required',
            'peminjam' => 'required',
            'keperluan' => 'required',
            'tanggal' => 'required',
            'di_301' => 'required',
            'di_302_303' => 'required',
        ]);

        Document::create($request->all());

        return redirect()->route('documents.create')->with('success', 'Data berhasil disimpan.');
    }
}
