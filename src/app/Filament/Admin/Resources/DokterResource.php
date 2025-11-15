<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\DokterResource\Pages;
use App\Models\Dokter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class DokterResource extends Resource
{
    protected static ?string $model = Dokter::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationLabel = 'Dokter';
    protected static ?string $modelLabel = 'Dokter';
    protected static ?string $pluralModelLabel = 'Dokter';
    protected static ?int $navigationSort = 4;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dokter')
                    ->description('Data pribadi dan profesional dokter')
                    ->schema([
                        Forms\Components\Select::make('id_rumahsakit')
                            ->label('Rumah Sakit')
                            ->relationship('rumahSakit', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('id_poli')
                            ->label('Poliklinik')
                            ->relationship('poliklinik', 'nama_poli')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('nama_dokter')
                            ->label('Nama Dokter')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('spesialisasi')
                            ->label('Spesialisasi')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: Umum, Jantung, Anak, dll'),
                    ])->columns(2),

                Forms\Components\Section::make('Data Registrasi & Kontak')
                    ->description('Nomor STR dan kontak dokter')
                    ->schema([
                        Forms\Components\TextInput::make('no_str')
                            ->label('Nomor STR')
                            ->required()
                            ->maxLength(20)
                            ->unique(ignoreRecord: true)
                            ->placeholder('Contoh: STR001-2023'),

                        Forms\Components\TextInput::make('no_telepon')
                            ->label('Nomor Telepon')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama_dokter')
                    ->label('Nama Dokter')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('spesialisasi')
                    ->label('Spesialisasi')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                Tables\Columns\TextColumn::make('rumahSakit.nama')
                    ->label('Rumah Sakit')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('poliklinik.nama_poli')
                    ->label('Poliklinik')
                    ->searchable(),

                Tables\Columns\TextColumn::make('no_str')
                    ->label('No. STR')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('no_telepon')
                    ->label('Telepon')
                    ->searchable(),

                Tables\Columns\TextColumn::make('kunjungan_count')
                    ->label('Kunjungan')
                    ->counts('kunjungan')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('spesialisasi')
                    ->label('Spesialisasi')
                    ->options(Dokter::distinct()->pluck('spesialisasi', 'spesialisasi')->toArray()),

                Tables\Filters\SelectFilter::make('id_rumahsakit')
                    ->label('Rumah Sakit')
                    ->relationship('rumahSakit', 'nama'),

                Tables\Filters\SelectFilter::make('id_poli')
                    ->label('Poliklinik')
                    ->relationship('poliklinik', 'nama_poli'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListDokter::route('/'),
        ];
    }
}
