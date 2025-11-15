<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\PasienResource\Pages;
use App\Models\Pasien;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class PasienResource extends Resource
{
    protected static ?string $model = Pasien::class;

    protected static ?string $navigationIcon = 'heroicon-o-heart';
    protected static ?string $navigationLabel = 'Pasien';
    protected static ?string $modelLabel = 'Pasien';
    protected static ?string $pluralModelLabel = 'Pasien';
    protected static ?int $navigationSort = 5;
    protected static ?string $navigationGroup = 'Hospital Management';

    public static function canAccess(): bool
    {
        return auth()->check();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Pribadi')
                    ->description('Data identitas pasien')
                    ->schema([
                        Forms\Components\TextInput::make('nik')
                            ->label('Nomor Identitas (NIK)')
                            ->required()
                            ->maxLength(16)
                            ->unique(ignoreRecord: true)
                            ->placeholder('16 digit nomor identitas')
                            ->columnSpan('full'),

                        Forms\Components\TextInput::make('nama')
                            ->label('Nama Lengkap')
                            ->required()
                            ->maxLength(100),

                        Forms\Components\Select::make('jenis_kelamin')
                            ->label('Jenis Kelamin')
                            ->options([
                                'Laki-laki' => 'Laki-laki',
                                'Perempuan' => 'Perempuan',
                            ])
                            ->required(),

                        Forms\Components\DatePicker::make('tanggal_lahir')
                            ->label('Tanggal Lahir')
                            ->required(),
                    ])->columns(2),

                Forms\Components\Section::make('Alamat & Kontak')
                    ->description('Data alamat dan nomor telepon')
                    ->schema([
                        Forms\Components\Textarea::make('alamat')
                            ->label('Alamat Lengkap')
                            ->required()
                            ->rows(3)
                            ->columnSpan('full'),

                        Forms\Components\TextInput::make('no_telepon')
                            ->label('Nomor Telepon')
                            ->required()
                            ->tel()
                            ->maxLength(20),
                    ])->columns(2),

                Forms\Components\Section::make('Kesehatan')
                    ->description('Informasi kesehatan pasien')
                    ->schema([
                        Forms\Components\Select::make('golongan_darah')
                            ->label('Golongan Darah')
                            ->options([
                                'A' => 'A',
                                'B' => 'B',
                                'AB' => 'AB',
                                'O' => 'O',
                            ])
                            ->required(),

                        Forms\Components\Textarea::make('alergi')
                            ->label('Alergi (Jika Ada)')
                            ->rows(2)
                            ->placeholder('Tuliskan obat atau zat yang menyebabkan alergi'),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nik')
                    ->label('NIK')
                    ->searchable()
                    ->sortable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('nama')
                    ->label('Nama Pasien')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('jenis_kelamin')
                    ->label('Kelamin')
                    ->badge()
                    ->color(fn($state) => $state === 'Laki-laki' ? 'info' : 'danger'),

                Tables\Columns\TextColumn::make('tanggal_lahir')
                    ->label('Tanggal Lahir')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('golongan_darah')
                    ->label('Goldar')
                    ->badge()
                    ->color('warning'),

                Tables\Columns\TextColumn::make('no_telepon')
                    ->label('Telepon')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\TextColumn::make('alergi')
                    ->label('Alergi')
                    ->searchable()
                    ->limit(20),

                Tables\Columns\TextColumn::make('kunjungan_count')
                    ->label('Kunjungan')
                    ->counts('kunjungan')
                    ->badge()
                    ->color('success'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Terdaftar')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('jenis_kelamin')
                    ->label('Jenis Kelamin')
                    ->options([
                        'Laki-laki' => 'Laki-laki',
                        'Perempuan' => 'Perempuan',
                    ]),

                Tables\Filters\SelectFilter::make('golongan_darah')
                    ->label('Golongan Darah')
                    ->options([
                        'A' => 'A',
                        'B' => 'B',
                        'AB' => 'AB',
                        'O' => 'O',
                    ]),

                Tables\Filters\Filter::make('tanggal_lahir')
                    ->form([
                        Forms\Components\DatePicker::make('tanggal_lahir_dari')
                            ->label('Dari Tanggal'),
                        Forms\Components\DatePicker::make('tanggal_lahir_sampai')
                            ->label('Sampai Tanggal'),
                    ])
                    ->query(function ($query, array $data) {
                        return $query
                            ->when(
                                $data['tanggal_lahir_dari'],
                                fn($q, $date) => $q->whereDate('tanggal_lahir', '>=', $date),
                            )
                            ->when(
                                $data['tanggal_lahir_sampai'],
                                fn($q, $date) => $q->whereDate('tanggal_lahir', '<=', $date),
                            );
                    }),

                Tables\Filters\Filter::make('memiliki_alergi')
                    ->label('Memiliki Alergi')
                    ->query(fn($query) => $query->whereNotNull('alergi'))
                    ->toggle(),
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
            'index' => Pages\ListPasien::route('/'),
        ];
    }
}
