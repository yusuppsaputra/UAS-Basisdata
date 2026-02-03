<?php

namespace App\Filament\Admin\Resources\RumahSakitResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PolikliniksRelationManager extends RelationManager
{
    protected static string $relationship = 'poliklinik';

    protected static ?string $recordTitleAttribute = 'nama_poli';

    public function form(Form $form): Form
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

                Forms\Components\TextInput::make('nama_poli')
                    ->label('Nama Poliklinik')
                    ->required()
                    ->maxLength(100),

                Forms\Components\TextInput::make('lantai')
                    ->label('Lantai')
                    ->required()
                    ->numeric()
                    ->minValue(1),

                Forms\Components\TextInput::make('jam_operasional')
                    ->label('Jam Operasional')
                    ->required()
                    ->maxLength(100),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('upload_gambar')
                    ->disk('minio')
                    ->label('Gambar')
                    ->toggleable(isToggledHiddenByDefault: true),

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
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
