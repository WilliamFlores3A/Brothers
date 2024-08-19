<?php

namespace App\Filament\Widgets;

use App\Models\Material;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class MaterialesMenosStockChart extends BaseWidget
{
    protected static ?string $heading = 'Materiales con Menos Stock';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Material::query()->orderBy('stock', 'asc')->limit(5) // Ordenar por stock ascendente y limitar a los 5 con menos stock
            )
            ->columns([
                TextColumn::make('nombre')
                    ->label('Nombre del Material')
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-o-cube'), // Agregar un ícono a la columna del nombre,

                TextColumn::make('descripcion')
                    ->label('Descripción')
                    ->limit(50), // Limitar la longitud del texto de la descripción,

                TextColumn::make('stock')
                    ->label('Stock Disponible')
                    ->sortable()
                    ->color(fn ($record) => $record->stock < 10 ? 'text-red-500' : 'text-yellow-500') // Color según nivel de stock
                    ->icon(fn ($record) => $record->stock < 10 ? 'heroicon-o-exclamation-circle' : 'heroicon-o-check-circle'), // Íconos para resaltar el nivel de stock
            ])
            ->filters([
                //
            ])
            ->actions([
                //
            ])
            ->bulkActions([
                //
            ]);
    }
}
