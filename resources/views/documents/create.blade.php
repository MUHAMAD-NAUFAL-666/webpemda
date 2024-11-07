@extends('layouts.app')

@section('content')
<div class="container my-5 p-4 shadow-sm bg-white rounded" style="max-width: 600px; border: 2px solid #999999;">
    <h1 class="mb-4 text-center">Formulir Peminjaman Dokumen</h1>

    @if (session('success'))
        <div class="alert alert-success text-center">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('documents.store') }}" method="POST">
        @csrf

        <div class="form-group mb-3">
            <label class="form-label">Dokumen Dipinjam:</label>
            <select name="dokumen_dipinjam" class="form-select border-green" required>
                <option value="" disabled selected>Pilih jenis dokumen</option>
                <option value="Warkah">Warkah</option>
                <option value="BT">BT</option>
                <option value="SU">SU</option>
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Jenis & No. Hak/DI 208:</label>
            <input type="text" name="jenis_no_hak_di_208" class="form-control border-green"
                placeholder="Masukkan Jenis & No. Hak/DI 208" required>
        </div>

        <div class="form-group mb-3">
            <label for="regency" class="form-label">Kabupaten:</label>
            <select name="regency_id" id="regency" class="form-select border-green" required>
                <option value="" disabled selected>Pilih Kabupaten</option>
                @foreach($regencies as $regency)
                    <option value="{{ $regency->id }}">{{ $regency->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="district" class="form-label">Kecamatan:</label>
            <select name="district_id" id="district" class="form-select border-green" required>
                <option value="" disabled selected>Pilih Kecamatan</option>
                <!-- Options Kecamatan akan diisi dengan AJAX -->
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="village" class="form-label">Desa:</label>
            <select name="village_id" id="village" class="form-select border-green" required>
                <option value="" disabled selected>Pilih Desa</option>
                <!-- Options Desa akan diisi dengan AJAX -->
            </select>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Peminjam:</label>
            <input type="text" name="peminjam" class="form-control border-green" placeholder="Masukkan Peminjaman"
                required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Keperluan:</label>
            <input type="text" name="keperluan" class="form-control border-green" placeholder="Masukkan Keperluan"
                required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">Tanggal:</label>
            <input type="date" name="tanggal" class="form-control border-green" required>
        </div>

        <div class="form-group mb-3">
            <label class="form-label">DI 301:</label>
            <input type="text" name="di_301" class="form-control border-green">
        </div>

        <div class="form-group mb-4">
            <label class="form-label">DI 302/303:</label>
            <input type="text" name="di_302_303" class="form-control border-green">
        </div>

        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-4 py-2">Submit</button>
        </div>
    </form>
</div>

<style>
    /* Warna hijau untuk border form */
    .border-green {
        border: 1px solid #00fa9a !important;
        /* Warna hijau untuk input */
    }

    /* Styling placeholder */
    .form-control::placeholder {
        color: #6c757d;
        /* Warna placeholder */
        opacity: 1;
        /* Opasitas placeholder */
    }
</style>

<!-- JQuery dan AJAX untuk pengisian dinamis combobox -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Ketika Kabupaten dipilih, muat Kecamatan
        $('#regency').on('change', function () {
            var regencyId = $(this).val();
            $('#district').empty().append('<option value="" disabled selected>Loading...</option>');
            $('#village').empty().append('<option value="" disabled selected>Pilih Desa</option>');

            if (regencyId) {
                $.get('/districts/' + regencyId, function (data) {
                    $('#district').empty().append('<option value="" disabled selected>Pilih Kecamatan</option>');
                    $.each(data, function (id, name) {
                        $('#district').append(new Option(name, id));
                    });
                });
            }
        });

        // Ketika Kecamatan dipilih, muat Desa
        $('#district').on('change', function () {
            var districtId = $(this).val();
            $('#village').empty().append('<option value="" disabled selected>Loading...</option>');

            if (districtId) {
                $.get('/villages/' + districtId, function (data) {
                    $('#village').empty().append('<option value="" disabled selected>Pilih Desa</option>');
                    $.each(data, function (id, name) {
                        $('#village').append(new Option(name, id));
                    });
                });
            }
        });
    });
</script>
@endsection