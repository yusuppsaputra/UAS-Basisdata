<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PoliklinikResource\Pages;
use App\Models\Poliklinik;
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
                Forms\Components\Section::make('Informasi Poliklinik')
                    ->description('Data departemen/klinik dalam rumah sakit')
                    ->schema([
                        Forms\Components\Select::make('id_rumahsakit')
                            ->label('Rumah Sakit')
                            ->relationship('rumahSakit', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\TextInput::make('nama_poli')
                            ->label('Nama Poliklinik')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('Contoh: Poli Umum, Poli Jantung, dll'),

                        Forms\Components\TextInput::make('lantai')
                            ->label('Lantai')
                            ->required()
                            ->numeric()
                            ->minValue(1),

                        Forms\Components\TextInput::make('jam_operasional')
                            ->label('Jam Operasional')
                            ->required()
                            ->maxLength(50)
                            ->placeholder('Contoh: 08:00-17:00'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('rumahSakit.nama')
                    ->label('Rumah Sakit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('nama_poli')
                    ->label('Nama Poliklinik')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('lantai')
                    ->label('Lantai')
                    ->numeric()
                    ->sortable(),

                Tables\Columns\TextColumn::make('jam_operasional')
                    ->label('Jam Operasional'),

                Tables\Columns\TextColumn::make('dokter_count')
                    ->label('Dokter')
                    ->counts('dokter')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('id_rumahsakit')
                    ->label('Rumah Sakit')
                    ->relationship('rumahSakit', 'nama'),

                Tables\Filters\Filter::make('lantai')
                    ->form([
                        Forms\Components\TextInput::make('lantai')
                            ->label('Lantai')
                            ->numeric(),
                    ])
                    ->query(function ($query, array $data) {
                        return $query->when(
                            $data['lantai'],
                            fn($q, $lantai) => $q->where('lantai', $lantai),
                        );
                    }),
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
            'index' => Pages\ListPoliklinik::route('/'),
        ];
    }
}
