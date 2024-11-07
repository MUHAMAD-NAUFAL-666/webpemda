<?php

use App\Filament\Resources\PeminjamanResource;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PeminjamanController;
use Illuminate\Support\Facades\Route;
use Filament\Facades\Filament;
Route::get('/', [DocumentController::class, 'create'])->name('documents.create');


Route::post('/documents', [DocumentController::class, 'store'])->name('documents.store');
Route::get('/districts/{regencyId}', [DocumentController::class, 'getDistricts']);
Route::get('/villages/{districtId}', [DocumentController::class, 'getVillages']);


Route::middleware(['auth', 'verified'])
    ->group(function () {
        Filament::registerResources([
            PeminjamanResource::class,
        ]);

        Route::get('/peminjaman/{id}/cetak', [PeminjamanController::class, 'cetakPeminjaman'])->name('peminjaman.cetak');


Route::get('/peminjaman/create', [PeminjamanResource::class, 'create'])->name('peminjaman.create');
    });

    