<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables\Columns\TextColumn;

class LatestConsultas extends BaseWidget
{
    protected static ?string $heading = 'Últimas Consultas';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Consulta::query()->latest('FechaDelIngreso') // Consulta para obtener las últimas consultas
            )
            ->columns([
                TextColumn::make('servicio.nombre_servicio')
                    ->label('Servicio Realizado')
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-o-briefcase') // Añadir un ícono para representar el servicio
                    ->color('text-blue-500'), // Añadir color para resaltar el servicio

                TextColumn::make('auto.placa')
                    ->label('Auto')
                    ->sortable()
                    ->searchable()
                    ->icon('heroicon-o-truck') // Añadir un ícono para representar el auto
                    ->color('text-green-500'), // Añadir color para resaltar el auto

                TextColumn::make('FechaDelIngreso')
                    ->label('Fecha de Ingreso')
                    ->date('d/m/Y') // Mostrar solo día/mes/año
                    ->sortable()
                    ->icon('heroicon-o-calendar') // Añadir un ícono para la fecha de ingreso
                    ->color('text-gray-500'), // Añadir color para la fecha
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
