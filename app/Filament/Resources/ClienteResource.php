<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClienteResource\Pages;
use App\Filament\Resources\ClienteResource\RelationManagers;
use App\Models\Cliente;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClienteResource extends Resource
{
    protected static ?string $model = Cliente::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\TextInput::make('nombre')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('apellido')
                ->required()
                ->maxLength(255),

            Forms\Components\TextInput::make('cedula')
                ->required()
                ->length(10) // Validar que tenga exactamente 10 caracteres
                ->unique(ignoreRecord: true), // Valida la unicidad del campo en la base de datos

            Forms\Components\TextInput::make('telefono')
                ->required()
                ->maxLength(15)
                ->regex('/^\d{7,15}$/') // Valida que sea un número de 7 a 15 dígitos
                ->label('Teléfono'),

            Forms\Components\TextInput::make('correo')
                ->required()
                ->email() // Valida que sea un correo válido
                ->unique(ignoreRecord: true), // Valida la unicidad del campo en la base de datos

            Forms\Components\TextInput::make('direccion')
                ->required()
                ->maxLength(255),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nombre')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('apellido')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('cedula')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('telefono')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('correo')->sortable()->searchable(),
                Tables\Columns\TextColumn::make('direccion')->sortable()->searchable(),
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
            'index' => Pages\ListClientes::route('/'),
            'create' => Pages\CreateCliente::route('/create'),
            'edit' => Pages\EditCliente::route('/{record}/edit'),
        ];
    }
}
