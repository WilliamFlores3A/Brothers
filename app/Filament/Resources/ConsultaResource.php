<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConsultaResource\Pages;
use App\Filament\Resources\ConsultaResource\RelationManagers;
use App\Models\Consulta;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ConsultaResource extends Resource
{
    protected static ?string $model = Consulta::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\DatePicker::make('FechaDelIngreso')
                    ->label('Fecha de Ingreso')
                    ->required(),
                    //->afterOrEqual('today'), // Validar que la fecha de ingreso sea hoy o en el futuro

                Forms\Components\TimePicker::make('HoraEntrada')  // Añadir HoraEntrada
                ->label('Hora de Entrada')
                ->required()
                ->withoutSeconds(), // Excluir los segundos

                Forms\Components\DatePicker::make('FechaSalida')
                    ->label('Fecha de Salida')
                    ->nullable()
                    ->afterOrEqual('FechaDelIngreso'), // Validar que la fecha de salida sea posterior a la fecha de ingreso
                
                Forms\Components\TimePicker::make('HoraSalida')  // Añadir HoraSalida
                ->label('Hora de Salida')
                ->nullable()
                ->withoutSeconds(), // Excluir los segundos

                Forms\Components\Textarea::make('DetallesTecnicos')
                    ->label('Detalles Técnicos')
                    ->required(),

                Forms\Components\Textarea::make('Observacion')
                    ->label('Observación')
                    ->nullable(),

                Forms\Components\Select::make('Auto_ID')
                    ->relationship('auto', 'placa')
                    ->createOptionForm([
                        Forms\Components\Select::make('id_modelo')
                            ->relationship('modelo', 'nombre_modelo')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre_modelo')->required(),
                            ]),
                        Forms\Components\Select::make('id_version')
                            ->relationship('version', 'nombre_version')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre_version')->required(),
                            ]),
                        Forms\Components\Select::make('id_marca')
                            ->relationship('marca', 'nombre_marca')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre_marca')->required(),
                            ]),
                        Forms\Components\Select::make('id_color')
                            ->relationship('color', 'nombre_color')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre_color')->required(),
                            ]),
                        Forms\Components\Select::make('id_year')
                            ->relationship('year', 'year')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('year')->required(),
                            ]),
                        Forms\Components\TextInput::make('placa')->required()->unique(),
                        Forms\Components\Select::make('cliente_id')
                            ->relationship('cliente', 'nombre')
                            ->createOptionForm([
                                Forms\Components\TextInput::make('nombre')->required(),
                                Forms\Components\TextInput::make('apellido')->required(),
                                Forms\Components\TextInput::make('cedula')->required(),
                                Forms\Components\TextInput::make('telefono')->required(),
                                Forms\Components\TextInput::make('correo')->email()->required(),
                                Forms\Components\TextInput::make('direccion')->required(),
                            ]),
                    ]),

                Forms\Components\Select::make('Mecanico_ID')
                    ->relationship('mecanico', 'nombre')
                    //->unique(ignoreRecord: true) // Asegura que el mecánico no se repita
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')->required(),
                        Forms\Components\TextInput::make('apellido')->required(),
                        Forms\Components\TextInput::make('cedula')->required(),
                        Forms\Components\TextInput::make('telefono')->required(),
                        Forms\Components\TextInput::make('correo')->email()->required(),
                        Forms\Components\TextInput::make('salario')->numeric()->required(),
                        Forms\Components\TextInput::make('direccion')->required(),
                    ]),

                Forms\Components\Select::make('Material_ID')
                    ->relationship('material', 'nombre')
            
                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre')->required(),
                        Forms\Components\Textarea::make('descripcion')->required(),
                        Forms\Components\TextInput::make('costoMaterial')->numeric()->required(),
                        Forms\Components\TextInput::make('stock')->numeric()->required(),
                    ]),

                Forms\Components\Select::make('Servicio_ID')
                    ->relationship('servicio', 'nombre_servicio')

                    ->createOptionForm([
                        Forms\Components\TextInput::make('nombre_servicio')->required(),
                        Forms\Components\Textarea::make('descripcion')->required(),
                        Forms\Components\TextInput::make('costoServicio')->numeric()->required(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('FechaDelIngreso')
                    ->label('Fecha de Ingreso')
                    ->date(),
                Tables\Columns\TextColumn::make('FechaSalida')
                    ->label('Fecha de Salida')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('DetallesTecnicos')
                    ->label('Detalles Técnicos'),
                Tables\Columns\TextColumn::make('Observacion')
                    ->label('Observación'),
                Tables\Columns\TextColumn::make('auto.placa')
                    ->label('Auto (Placa)'),
                Tables\Columns\TextColumn::make('mecanico.nombre')
                    ->label('Mecánico'),
                Tables\Columns\TextColumn::make('material.nombre')
                    ->label('Material'),
                Tables\Columns\TextColumn::make('servicio.nombre_servicio')
                    ->label('Servicio'),
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
            'index' => Pages\ListConsultas::route('/'),
            'create' => Pages\CreateConsulta::route('/create'),
            'edit' => Pages\EditConsulta::route('/{record}/edit'),
        ];
    }
}