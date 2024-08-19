<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AutoResource\Pages;
use App\Filament\Resources\AutoResource\RelationManagers;
use App\Models\Auto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AutoResource extends Resource
{
    protected static ?string $model = Auto::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';


    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_modelo')
                    ->relationship('modelo', 'nombre_modelo')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre_modelo')
                            ->required()
                            ->maxLength(255),
                    ]),
                    
                Forms\Components\Select::make('id_version')
                    ->relationship('version', 'nombre_version')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre_version')
                            ->required()
                            ->maxLength(255),
                    ]),

                Forms\Components\Select::make('id_marca')
                    ->relationship('marca', 'nombre_marca')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre_marca')
                            ->required()
                            ->maxLength(255),
                    ]),

                Forms\Components\Select::make('id_color')
                    ->relationship('color', 'nombre_color')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre_color')
                            ->required()
                            ->maxLength(255),
                    ]),

                Forms\Components\Select::make('id_year')
                    ->relationship('year', 'year')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('year')
                            ->required()
                            ->numeric()
                            ->minValue(1900) // Validar que sea mayor que 1900
                            ->maxValue(date('Y') + 1), // Validar que no sea mayor al próximo año
                    ]),

                Forms\Components\Select::make('cliente_id')
                    ->relationship('cliente', 'nombre')
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('apellido')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('cedula')
                            ->required()
                            ->length(10) // Validar que tenga exactamente 10 caracteres
                            ->unique(ignoreRecord: true), // valida la unicidad del campo en la base de datos
                        Forms\Components\TextInput::make('telefono')
                            ->required()
                            ->maxLength(15)
                            ->regex('/^\d{7,15}$/') // Valida que sea un número de 7 a 15 dígitos
                            ->label('Teléfono'),
                        Forms\Components\TextInput::make('correo')
                            ->required()
                            ->email() // Valida que sea un correo válido
                            ->unique(ignoreRecord: true), // valida la unicidad del campo en la base de datos
                        Forms\Components\TextInput::make('direccion')
                            ->required()
                            ->maxLength(255),
                    ]),

                Forms\Components\TextInput::make('placa')
                    ->required()
                    ->regex('/^[A-Z]{3}-\d{1,4}$/') // Valida el formato de placa
                    ->unique(ignoreRecord: true) // valida la unicidad del campo en la base de datos
                    ->label('Placa (Formato: ABC-1234)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('modelo.nombre_modelo'),
                Tables\Columns\TextColumn::make('version.nombre_version'),
                Tables\Columns\TextColumn::make('marca.nombre_marca'),
                Tables\Columns\TextColumn::make('color.nombre_color'),
                Tables\Columns\TextColumn::make('year.year'),
                Tables\Columns\TextColumn::make('placa'),
                Tables\Columns\TextColumn::make('cliente.nombre'),
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
            'index' => Pages\ListAutos::route('/'),
            'create' => Pages\CreateAuto::route('/create'),
            'edit' => Pages\EditAuto::route('/{record}/edit'),
        ];
    }
}

