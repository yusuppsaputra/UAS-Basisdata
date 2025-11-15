<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\JadwalPraktekResource\Pages;
use App\Models\JadwalPraktek;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class JadwalPraktekResource extends Resource
{
    protected static ?string $model = JadwalPraktek::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar';
    protected static ?string $navigationLabel = 'Jadwal Praktek';
    protected static ?string $modelLabel = 'Jadwal Praktek';
    protected static ?string $pluralModelLabel = 'Jadwal Praktek';
    protected static ?int $navigationSort = 7;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Jadwal Praktek Dokter')
                    ->description('Atur jadwal praktek dokter di poliklinik')
                    ->schema([
                        Forms\Components\Select::make('id_dokter')
                            ->label('Dokter')
                            ->relationship('dokter', 'nama_dokter')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('hari')
                            ->label('Hari')
                            ->options([
                                'Senin' => 'Senin',
                                'Selasa' => 'Selasa',
                                'Rabu' => 'Rabu',
                                'Kamis' => 'Kamis',
                                'Jumat' => 'Jumat',
                                'Sabtu' => 'Sabtu',
                                'Minggu' => 'Minggu',
                            ])
                            ->required(),

                        Forms\Components\TimePicker::make('jam_mulai')
                            ->label('Jam Mulai')
                            ->required(),

                        Forms\Components\TimePicker::make('jam_selesai')
                            ->label('Jam Selesai')
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('dokter.nama_dokter')
                    ->label('Dokter')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('hari')
                    ->label('Hari')
                    ->badge()
                    ->color('info')
                    ->sortable(),

                Tables\Columns\TextColumn::make('jam_mulai')
                    ->label('Jam Mulai')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('jam_selesai')
                    ->label('Jam Selesai')
                    ->time('H:i'),

                Tables\Columns\TextColumn::make('dokter.poliklinik.nama_poli')
                    ->label('Poliklinik')
                    ->searchable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('hari')
                    ->label('Hari')
                    ->options([
                        'Senin' => 'Senin',
                        'Selasa' => 'Selasa',
                        'Rabu' => 'Rabu',
                        'Kamis' => 'Kamis',
                        'Jumat' => 'Jumat',
                        'Sabtu' => 'Sabtu',
                        'Minggu' => 'Minggu',
                    ]),

                Tables\Filters\SelectFilter::make('id_dokter')
                    ->label('Dokter')
                    ->relationship('dokter', 'nama_dokter'),
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
            'index' => Pages\ListJadwalPraktek::route('/'),
        ];
    }
}
