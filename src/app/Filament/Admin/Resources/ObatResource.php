<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ObatResource\Pages;
use App\Models\Obat;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ObatResource extends Resource
{
    protected static ?string $model = Obat::class;

    protected static ?string $navigationIcon = 'heroicon-o-beaker';
    protected static ?string $navigationLabel = 'Obat';
    protected static ?string $modelLabel = 'Obat';
    protected static ?string $pluralModelLabel = 'Obat';
    protected static ?int $navigationSort = 6;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Obat')
                    ->description('Data obat-obatan dan inventaris')
                    ->schema([
                        Forms\Components\FileUpload::make('upload_gambar')
                            ->disk('minio')
                            ->visibility('public')
                            ->image()
                            ->maxSize(2048),

                        Forms\Components\TextInput::make('nama_obat')
                            ->label('Nama Obat')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('kategori')
                            ->label('Kategori')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Contoh: Antibiotik, Analgesik, NSAID'),

                        Forms\Components\TextInput::make('satuan')
                            ->label('Satuan')
                            ->required()
                            ->maxLength(20)
                            ->placeholder('Contoh: Tablet, Botol, Ampul'),

                        Forms\Components\TextInput::make('stok')
                            ->label('Stok')
                            ->required()
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\TextInput::make('harga')
                            ->label('Harga (per satuan)')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->prefix('Rp'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('upload_gambar')
                    ->disk('minio')
                    ->label('Gambar')
                    ->rounded(),
                Tables\Columns\TextColumn::make('nama_obat')
                    ->label('Nama Obat')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('info')
                    ->searchable(),

                Tables\Columns\TextColumn::make('satuan')
                    ->label('Satuan'),

                Tables\Columns\TextColumn::make('stok')
                    ->label('Stok')
                    ->numeric()
                    ->sortable()
                    ->badge()
                    ->color(fn ($state) => $state < 50 ? 'danger' : 'success'),

                Tables\Columns\TextColumn::make('harga')
                    ->label('Harga')
                    ->money('IDR', locale: 'id')
                    ->sortable(),

                Tables\Columns\TextColumn::make('resep_count')
                    ->label('Resep')
                    ->counts('resep')
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('kategori')
                    ->label('Kategori')
                    ->options(Obat::distinct()->pluck('kategori', 'kategori')->toArray()),

                Tables\Filters\Filter::make('stok_rendah')
                    ->label('Stok < 50')
                    ->query(fn ($query) => $query->where('stok', '<', 50))
                    ->toggle(),
            ])
            ->actions([
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
            'index' => Pages\ListObat::route('/'),
        ];
    }
}
