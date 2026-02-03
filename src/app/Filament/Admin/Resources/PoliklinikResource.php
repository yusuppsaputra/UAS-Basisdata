<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PoliklinikResource\Pages;
use App\Models\Poliklinik;
use App\Models\RumahSakit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PoliklinikResource extends Resource
{
    protected static ?string $model = Poliklinik::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $navigationLabel = 'Poliklinik';
    protected static ?string $modelLabel = 'Poliklinik';
    protected static ?string $pluralModelLabel = 'Poliklinik';
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
                Forms\Components\FileUpload::make('upload_gambar')
                    ->disk('minio')
                    ->directory('poliklinik')
                    ->visibility('public')
                    ->image()
                    ->imagePreviewHeight(100)
                    ->maxSize(2048)
                    ->preserveFilenames(false),
                (RumahSakit::count() <= 15
                    ? Forms\Components\Radio::make('id_rumahsakit')
                        ->label('Rumah Sakit')
                        ->options(fn () => RumahSakit::pluck('nama', 'id_rumahsakit')->toArray())
                        ->required()
                        ->inline()
                        ->columnSpan('full')
                    : Forms\Components\Select::make('id_rumahsakit')
                        ->label('Rumah Sakit')
                        ->options(fn () => RumahSakit::pluck('nama', 'id_rumahsakit')->toArray())
                        ->placeholder('Pilih Rumah Sakit')
                        ->helperText('Klik untuk membuka daftar dan pilih Rumah Sakit (ketik untuk memfilter).')
                        ->required()
                        ->preload()
                        ->searchable()
                        ->columnSpan('full')
                ),
                Forms\Components\TextInput::make('nama_poli')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('lantai')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('jam_operasional')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\ImageColumn::make('upload_gambar')
                    ->disk('minio')
                    ->label('Gambar')
                    ->rounded(),
                Tables\Columns\TextColumn::make('rumahSakit.nama')
                    ->label('Rumah Sakit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('nama_poli')
                    ->searchable(),
                Tables\Columns\TextColumn::make('lantai')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('jam_operasional')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListPolikliniks::route('/'),
            'create' => Pages\CreatePoliklinik::route('/create'),
            'edit' => Pages\EditPoliklinik::route('/{record}/edit'),
        ];
    }
}
