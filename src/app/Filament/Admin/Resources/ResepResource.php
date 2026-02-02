<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\ResepResource\Pages;
use App\Models\Resep;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class ResepResource extends Resource
{
    protected static ?string $model = Resep::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-check';
    protected static ?string $navigationLabel = 'Resep';
    protected static ?string $modelLabel = 'Resep';
    protected static ?string $pluralModelLabel = 'Resep';
    protected static ?int $navigationSort = 9;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Resep')
                    ->description('Buat resep obat dari kunjungan pasien')
                    ->schema([
                        Forms\Components\Select::make('id_kunjungan')
                            ->label('Kunjungan')
                            ->relationship('kunjungan', 'id')
                            ->getOptionLabelFromRecordUsing(fn ($record) => "Kunjungan #{$record->id} - {$record->pasien->nama}")
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('id_obat')
                            ->label('Obat')
                            ->relationship('obat', 'nama_obat')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('jumlah')
                            ->label('Jumlah')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        Forms\Components\Textarea::make('aturan_pakai')
                            ->label('Aturan Pakai')
                            ->required()
                            ->rows(3)
                            ->placeholder('Contoh: Minum 3 kali sehari, 1 tablet per kali, setelah makan, selama 7 hari'),

                        Forms\Components\FileUpload::make('upload_gambar')
                            ->disk('minio')
                            ->visibility('public')
                            ->image()
                            ->maxSize(2048),
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
                Tables\Columns\TextColumn::make('kunjungan.pasien.nama')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('obat.nama_obat')
                    ->label('Obat')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jumlah')
                    ->label('Jumlah')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('aturan_pakai')
                    ->label('Aturan Pakai')
                    ->limit(30)
                    ->searchable(),

                Tables\Columns\TextColumn::make('obat.kategori')
                    ->label('Kategori')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('obat.harga')
                    ->label('Harga Obat')
                    ->money('IDR', locale: 'id'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_obat')
                    ->label('Obat')
                    ->relationship('obat', 'nama_obat'),

                Tables\Filters\SelectFilter::make('obat.kategori')
                    ->label('Kategori Obat')
                    ->relationship('obat', 'kategori')
                    ->multiple(),
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
            'index' => Pages\ListResep::route('/'),
        ];
    }
}
