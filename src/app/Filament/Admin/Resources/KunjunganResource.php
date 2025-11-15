<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\KunjunganResource\Pages;
use App\Models\Kunjungan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class KunjunganResource extends Resource
{
    protected static ?string $model = Kunjungan::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Kunjungan';
    protected static ?string $modelLabel = 'Kunjungan';
    protected static ?string $pluralModelLabel = 'Kunjungan';
    protected static ?int $navigationSort = 8;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Data Kunjungan')
                    ->description('Rekam data kunjungan pasien ke dokter')
                    ->schema([
                        Forms\Components\Select::make('id_pasien')
                            ->label('Pasien')
                            ->relationship('pasien', 'nama')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\Select::make('id_dokter')
                            ->label('Dokter')
                            ->relationship('dokter', 'nama_dokter')
                            ->required()
                            ->searchable()
                            ->preload(),

                        Forms\Components\DateTimePicker::make('tanggal_kunjungan')
                            ->label('Tanggal & Jam Kunjungan')
                            ->required(),

                        Forms\Components\Textarea::make('keluhan')
                            ->label('Keluhan')
                            ->required()
                            ->rows(2),

                        Forms\Components\Textarea::make('diagnosa')
                            ->label('Diagnosa')
                            ->required()
                            ->rows(2),

                        Forms\Components\TextInput::make('biaya_admin')
                            ->label('Biaya Administrasi')
                            ->required()
                            ->numeric()
                            ->minValue(0)
                            ->step(0.01)
                            ->prefix('Rp'),

                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'Selesai' => 'Selesai',
                                'Proses' => 'Proses',
                                'Batal' => 'Batal',
                            ])
                            ->required(),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('pasien.nama')
                    ->label('Pasien')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('dokter.nama_dokter')
                    ->label('Dokter')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tanggal_kunjungan')
                    ->label('Tanggal Kunjungan')
                    ->dateTime('d M Y H:i')
                    ->sortable(),

                Tables\Columns\TextColumn::make('keluhan')
                    ->label('Keluhan')
                    ->limit(20)
                    ->searchable(),

                Tables\Columns\TextColumn::make('diagnosa')
                    ->label('Diagnosa')
                    ->limit(20)
                    ->searchable(),

                Tables\Columns\TextColumn::make('biaya_admin')
                    ->label('Biaya Admin')
                    ->money('IDR', locale: 'id'),

                Tables\Columns\BadgeColumn::make('status')
                    ->label('Status')
                    ->colors([
                        'success' => 'Selesai',
                        'warning' => 'Proses',
                        'danger' => 'Batal',
                    ]),

                Tables\Columns\TextColumn::make('resep_count')
                    ->label('Resep')
                    ->counts('resep')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Dibuat')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'Selesai' => 'Selesai',
                        'Proses' => 'Proses',
                        'Batal' => 'Batal',
                    ]),

                Tables\Filters\SelectFilter::make('id_dokter')
                    ->label('Dokter')
                    ->relationship('dokter', 'nama_dokter'),

                Tables\Filters\SelectFilter::make('id_pasien')
                    ->label('Pasien')
                    ->relationship('pasien', 'nama'),

                Tables\Filters\Filter::make('tanggal_kunjungan')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_dari')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('tanggal_sampai')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['tanggal_dari'],
                                fn($q, $date) => $q->whereDate('tanggal_kunjungan', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_sampai'],
                                fn($q, $date) => $q->whereDate('tanggal_kunjungan', '<=', $date),
                            );
                    }),
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
            'index' => Pages\ListKunjungan::route('/'),
        ];
    }
}
