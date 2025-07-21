<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PeminjamResource\Pages;
use App\Filament\Admin\Resources\PeminjamResource\RelationManagers;
use App\Models\Peminjam;
use App\Models\Barang;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PeminjamResource extends Resource
{
    protected static ?string $model = Peminjam::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
            Select::make('barang_id')
                ->label('Barang')
                ->relationship('barang', 'nama')
                ->searchable()
                ->preload()
                ->options(function () {
                    return Barang::where('status', 'tersedia')->pluck('nama', 'id');
                })
                ->required(),
            TextInput::make('nama_peminjam')->required(),
            DatePicker::make('tanggal_pinjam')->required(),
            DatePicker::make('tanggal_kembali')->required(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('barang.nama')->label('Barang'),
                TextColumn::make('nama_peminjam'),
                TextColumn::make('tanggal_pinjam')->date(),
                TextColumn::make('tanggal_kembali')->date(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),

                Action::make('kembalikan')
                    ->label('Kembalikan')
                    ->color('success')
                    ->icon('heroicon-m-arrow-uturn-left')
                    ->visible(fn ($record) => $record->barang->status === 'dipinjam')
                    ->requiresConfirmation()
                    ->action(function ($record) {
                        $barang = $record->barang;
                        if ($barang && $barang->status === 'dipinjam') {
                            $barang->update(['status' => 'tersedia']);
                        }
                    }),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPeminjams::route('/'),
            'create' => Pages\CreatePeminjam::route('/create'),
            'edit' => Pages\EditPeminjam::route('/{record}/edit'),
        ];
    }
}
