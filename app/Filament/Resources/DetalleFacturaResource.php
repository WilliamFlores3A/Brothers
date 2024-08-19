<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DetalleFacturaResource\Pages;
use App\Filament\Resources\DetalleFacturaResource\RelationManagers;
use App\Models\DetalleFactura;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Models\Consulta;
use App\Models\Factura;
use Carbon\Carbon;

class DetalleFacturaResource extends Resource
{
    protected static ?string $model = DetalleFactura::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';


    public static function form(Form $form): Form
    {
        return $form
        ->schema([
            Forms\Components\Select::make('factura_id')
                ->relationship('factura', 'id')
                ->label('Factura')
                ->options(function () {
                    return Factura::all()->mapWithKeys(function ($factura) {
                        return [
                            $factura->id => $factura->cliente->nombre . ' - ' . Carbon::parse($factura->fecha)->format('d/m/Y')
                        ];
                    });
                })
                ->searchable()
                ->createOptionForm([
                    Forms\Components\DatePicker::make('fecha')->required(),
                    Forms\Components\Select::make('cliente_id')
                        ->relationship('cliente', 'nombre')
                        ->label('Cliente'),
                    Forms\Components\Textarea::make('observacion')
                        ->label('Observación')
                        ->nullable(),
                ])
                ->required(),

                Forms\Components\Select::make('consulta_id')
                ->relationship('consulta', 'id')
                ->label('Consulta')
                ->reactive()
                ->afterStateUpdated(function (callable $set, $state) {
                    if ($state) {
                        $consulta = Consulta::find($state);
                        if ($consulta && $consulta->servicio) {
                            $set('costeTotal', $consulta->servicio->costoServicio);
                        }
                    }
                })
                ->options(function () {
                    return \App\Models\Consulta::all()->mapWithKeys(function ($consulta) {
                        $fechaIngreso = \Carbon\Carbon::parse($consulta->FechaDelIngreso);
                        return [$consulta->id => $consulta->auto->placa . ' - ' . $fechaIngreso->format('d/m/Y')];
                    });
                })
                ->searchable()
                ->required(),

            Forms\Components\Textarea::make('descripcion')
                ->label('Descripción')
                ->required(),

            Forms\Components\TextInput::make('costeTotal')
                ->label('Coste Total')
                ->numeric()
                ->required()
                ->disabled(), // Deshabilitado para evitar cambios manuales
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('factura.id')
                    ->label('Factura ID'),
                Tables\Columns\TextColumn::make('consulta.id')
                    ->label('Consulta ID'),
                Tables\Columns\TextColumn::make('descripcion')
                    ->label('Descripción'),
                Tables\Columns\TextColumn::make('costeTotal')
                    ->label('Coste Total')
                    ->money('usd', 2),
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
            'index' => Pages\ListDetalleFacturas::route('/'),
            'create' => Pages\CreateDetalleFactura::route('/create'),
            'edit' => Pages\EditDetalleFactura::route('/{record}/edit'),
        ];
    }
}
