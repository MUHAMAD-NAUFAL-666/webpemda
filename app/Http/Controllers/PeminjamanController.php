<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function cetakPeminjaman($id)
    {

        $data = Peminjaman::with('hakArsipMilik')->findOrFail($id); // Data yang ingin ditampilkan di PDF

        $pdf = Pdf::loadView('peminjaman.cetak', compact('data')); // Ganti 'pdf_view' dengan nama view kamu
        return $pdf->download($data['nama_pemohon'] . '.pdf'); // Nama file yang akan diunduh

        // // Mendapatkan data peminjaman berdasarkan ID
        // $peminjaman = Peminjaman::with('hakArsipMilik')->findOrFail($id);

        // // Mengirim data ke view cetak
        // return view('peminjaman.cetak', compact('peminjaman'));
    }
}