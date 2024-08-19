<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MecanicoResource\Pages;
use App\Filament\Resources\MecanicoResource\RelationManagers;
use App\Models\Mecanico;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MecanicoResource extends Resource
{
    protected static ?string $model = Mecanico::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench';


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
                    ->unique(ignoreRecord: true) // Valida la unicidad del campo en la base de datos
                    ->maxLength(10)
                    ->length(10), // Validar que tenga exactamente 10 caracteres

                Forms\Components\TextInput::make('telefono')
                    ->required()
                    ->regex('/^\d{7,15}$/') // Valida que sea un número de 7 a 15 dígitos
                    ->label('Teléfono')
                    ->maxLength(15),

                Forms\Components\TextInput::make('correo')
                    ->required()
                    ->email() // Valida que sea un correo válido
                    ->unique(ignoreRecord: true) // Valida la unicidad del campo en la base de datos
                    ->maxLength(255),

                Forms\Components\TextInput::make('salario')
                    ->required()
                    ->numeric(),

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
                Tables\Columns\TextColumn::make('salario')->sortable(),
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
            'index' => Pages\ListMecanicos::route('/'),
            'create' => Pages\CreateMecanico::route('/create'),
            'edit' => Pages\EditMecanico::route('/{record}/edit'),
        ];
    }
}
