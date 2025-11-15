<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\RumahSakitResource\Pages;
use App\Models\RumahSakit;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class RumahSakitResource extends Resource
{
    protected static ?string $model = RumahSakit::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-library';
    protected static ?string $navigationLabel = 'Rumah Sakit';
    protected static ?string $modelLabel = 'Rumah Sakit';
    protected static ?string $pluralModelLabel = 'Rumah Sakit';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Dasar')
                    ->description('Data utama rumah sakit')
                    ->schema([
                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Rumah Sakit')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('Masukkan nama rumah sakit')
                            ->columnSpan('full'),

                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat')
                            ->required()
                            ->rows(3)
                            ->columnSpan('full'),

                        Forms\Components\TextInput::make('kota')
                            ->label('Kota')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\TextInput::make('provinsi')
                            ->label('Provinsi')
                            ->required()
                            ->maxLength(100),
                    ])->columns(2),

                Forms\Components\Section::make('Kontak & Klasifikasi')
                    ->description('Informasi kontak dan kelas rumah sakit')
                    ->schema([
                        Forms\Components\TextInput::make('no_telepon')
                            ->label('Nomor Telepon')
                            ->required()
                            ->tel()
                            ->maxLength(20),

                        Forms\Components\Select::make('kelas_rumah_sakit')
                            ->label('Kelas Rumah Sakit')
                            ->options([
                                'A' => 'Kelas A (Tertier)',
                                'B' => 'Kelas B (Sekunder)',
                                'C' => 'Kelas C (Primer)',
                                'D' => 'Kelas D (Pratama)',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Rumah Sakit')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('kota')
                    ->label('Kota')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('provinsi')
                    ->label('Provinsi')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('no_telepon')
                    ->label('Telepon')
                    ->searchable(),

                Tables\Columns\BadgeColumn::make('kelas_rumah_sakit')
                    ->label('Kelas')
                    ->colors([
                        'primary' => 'A',
                        'success' => 'B',
                        'warning' => 'C',
                        'danger' => 'D',
                    ])
                    ->icons([
                        'heroicon-m-star' => 'A',
                        'heroicon-m-star' => 'B',
                        'heroicon-m-star' => 'C',
                        'heroicon-m-star' => 'D',
                    ]),

                Tables\Columns\TextColumn::make('poliklinik_count')
                    ->label('Poliklinik')
                    ->counts('poliklinik')
                    ->badge()
                    ->color('info'),

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
                Tables\Filters\SelectFilter::make('kelas_rumah_sakit')
                    ->label('Kelas Rumah Sakit')
                    ->options([
                        'A' => 'Kelas A',
                        'B' => 'Kelas B',
                        'C' => 'Kelas C',
                        'D' => 'Kelas D',
                    ]),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('created_until')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn($q, $date) => $q->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn($q, $date) => $q->whereDate('created_at', '<=', $date),
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
            'index' => Pages\ListRumahSakit::route('/'),
        ];
    }
}
