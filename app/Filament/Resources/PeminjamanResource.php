<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PeminjamanResource\Pages;
use App\Models\Peminjaman;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class PeminjamanResource extends Resource
{
    // Menetapkan model dan ikon
    protected static ?string $model = Peminjaman::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Pilihan jenis dokumen
                Forms\Components\Select::make('jenis_dokumen')
                    ->options([
                        'buku tanah' => 'Buku Tanah',
                        'surat ukur' => 'Surat Ukur',
                        'warkah' => 'Warkah',
                    ])
                    ->label('Jenis Dokumen')
                    ->required(),
    
                Forms\Components\TextInput::make('nomor_dokumen')
                    ->label('Nomor Dokumen')
                    ->required(),
    
                Forms\Components\TextInput::make('nama_peminjam')
                    ->label('Nama Peminjam')
                    ->required(),
    
                Forms\Components\DatePicker::make('tanggal_peminjaman')
                    ->label('Tanggal Peminjaman')
                    ->required(),
    
                Forms\Components\DatePicker::make('tanggal_pengembalian')
                    ->label('Tanggal Pengembalian')
                    ->nullable(),
    
                // Combo box Kabupaten
                Forms\Components\Select::make('regency_id')
                    ->label('Kabupaten')
                    ->options(\App\Models\Regency::all()->pluck('name', 'id'))
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('district_id', null)),
    
                // Combo box Kecamatan yang bergantung pada Kabupaten
                Forms\Components\Select::make('district_id')
                    ->label('Kecamatan')
                    ->options(function (callable $get) {
                        $regencyId = $get('regency_id');
                        if ($regencyId) {
                            return \App\Models\District::where('regency_id', $regencyId)
                                ->pluck('name', 'id');
                        }
                        return [];
                    })
                    ->reactive()
                    ->afterStateUpdated(fn (callable $set) => $set('village_id', null)),
    
                // Combo box Desa yang bergantung pada Kecamatan
                Forms\Components\Select::make('village_id')
                    ->label('Desa')
                    ->options(function (callable $get) {
                        $districtId = $get('district_id');
                        if ($districtId) {
                            return \App\Models\Village::where('district_id', $districtId)
                                ->pluck('name', 'id');
                        }
                        return [];
                    })
                    ->reactive(),
    
                // Status
                Forms\Components\Select::make('status')
                    ->options([
                        'Dipinjam' => 'Dipinjam',
                        'Dikembalikan' => 'Dikembalikan',
                    ])
                    ->label('Status'),
            ]);
    }
    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('jenis_dokumen')->label('Jenis Dokumen'),
                Tables\Columns\TextColumn::make('nomor_dokumen')->label('Nomor Dokumen'),
                Tables\Columns\TextColumn::make('nama_peminjam')->label('Nama Peminjam'),
                Tables\Columns\TextColumn::make('tanggal_peminjaman')->label('Tanggal Peminjaman')->date(),
                Tables\Columns\TextColumn::make('tanggal_pengembalian')->label('Tanggal Pengembalian')->date(),
                Tables\Columns\TextColumn::make('regency.name')->label('Kabupaten'),
                Tables\Columns\TextColumn::make('district.name')->label('Kecamatan'),
                Tables\Columns\TextColumn::make('village.name')->label('Desa'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
    
                // Menampilkan kolom denda
                Tables\Columns\TextColumn::make('denda')->label('Denda')->money('IDR'),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status Peminjaman')
                    ->options([
                        'Dipinjam' => 'Dipinjam',
                        'Dikembalikan' => 'Dikembalikan',
                    ]),
                Tables\Filters\Filter::make('tanggal_peminjaman')
                    ->label('Tanggal Peminjaman')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_peminjaman_start')->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('tanggal_peminjaman_end')->label('Sampai Tanggal'),
                    ])
                    ->query(function (Builder $query, array $data) {
                        return $query
                            ->when($data['tanggal_peminjaman_start'], fn ($query, $date) => $query->whereDate('tanggal_peminjaman', '>=', $date))
                            ->when($data['tanggal_peminjaman_end'], fn ($query, $date) => $query->whereDate('tanggal_peminjaman', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('cetak')
                    ->label('Cetak Peminjaman')
                    ->url(fn(Peminjaman $record) => route('peminjaman.cetak', $record))
                    ->openUrlInNewTab(),
                Tables\Actions\Action::make('export')
                    ->label('Ekspor Data')
                    ->action(function () {
                        // Logika untuk mengekspor data
                    }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    

    // Label untuk judul halaman
    public static function getPluralLabel(): string
    {
        return 'Peminjaman';
    }

    public static function getLabel(): string
    {
        return 'Peminjaman';
    }

    public static function getRelations(): array
    {
        return [
            // Tambahkan relasi jika diperlukan
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjaman::route('/'),
            'create' => Pages\CreatePeminjaman::route('/create'),
            'edit' => Pages\EditPeminjaman::route('/{record}/edit'),
        ];
    }
}
