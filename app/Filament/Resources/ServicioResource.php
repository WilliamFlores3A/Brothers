<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServicioResource\Pages;
use App\Filament\Resources\ServicioResource\RelationManagers;
use App\Models\Servicio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ServicioResource extends Resource
{
    protected static ?string $model = Servicio::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nombre_servicio')
                    ->label('Nombre del Servicio')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Textarea::make('descripcion')
                    ->label('Descripción')
                    ->required(),

                Forms\Components\TextInput::make('costoServicio')
                    ->label('Costo del Servicio')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre_servicio')->sortable()->searchable()->label('Nombre del Servicio'),
                Tables\Columns\TextColumn::make('descripcion')->sortable()->label('Descripción'),
                Tables\Columns\TextColumn::make('costoServicio')->sortable()->label('Costo del Servicio'),
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
            'index' => Pages\ListServicios::route('/'),
            'create' => Pages\CreateServicio::route('/create'),
            'edit' => Pages\EditServicio::route('/{record}/edit'),
        ];
    }
}
