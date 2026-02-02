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

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Dokter';
    protected static ?string $modelLabel = 'Dokter';
    protected static ?string $pluralModelLabel = 'Dokter';
    protected static ?int $navigationSort = 3;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('id_rumahsakit')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('id_poli')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('nama_dokter')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('spesialisasi')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('no_str')
                    ->required()
                    ->unique()
                    ->maxLength(20),
                Forms\Components\TextInput::make('no_telepon')
                    ->tel()
                    ->required()
                    ->maxLength(15),
                Forms\Components\FileUpload::make('upload_gambar')
                    ->label('Upload Gambar')
                    ->disk('public')
                    ->directory('dokter')
                    ->visibility('public')
                    ->image()
                    ->required()
                    ->maxSize(2048)
                    ->imagePreviewHeight('100')->helperText('Tunggu sampai pratinjau gambar muncul sebelum klik "Create". Gambar wajib diunggah.')->saveUploadedFileUsing(function (\Illuminate\Http\UploadedFile $file, $state) {
                        // Store file on public disk under 'dokter' and return the stored path
                        return \Illuminate\Support\Facades\Storage::disk('public')->putFile('dokter', $file);
                    })
                    ->columnSpan('full'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('rumahSakit.nama')
                    ->label('Rumah Sakit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('poliklinik.nama')
                    ->label('Poliklinik')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\ImageColumn::make('upload_gambar')
                    ->disk('public')
                    ->label('Gambar')
                    ->rounded()
                    ->getStateUsing(fn ($record) => (
                        ($path = $record->upload_gambar) && \Illuminate\Support\Facades\Storage::disk('public')->exists($path)
                        ? $path
                        : 'dokter/placeholder.png'
                    )),

                Tables\Columns\TextColumn::make('nama_dokter')
                    ->searchable(),
                Tables\Columns\TextColumn::make('spesialisasi')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_str')
                    ->searchable(),
                Tables\Columns\TextColumn::make('no_telepon')
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
            'index' => Pages\ListDokters::route('/'),
            'create' => Pages\CreateDokter::route('/create'),
            'edit' => Pages\EditDokter::route('/{record}/edit'),
        ];
    }
}
