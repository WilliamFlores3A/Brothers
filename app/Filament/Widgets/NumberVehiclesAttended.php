<?php
/*
namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NumberVehiclesAttended extends BaseWidget
{
    protected function getStats(): array
    {
        $vehiclesAttended = Consulta::distinct('Auto_ID')->count('Auto_ID');

        return [
            Stat::make('Vehículos Atendidos', $vehiclesAttended)
                ->icon('heroicon-o-truck') // Añadir un ícono de camión o vehículo para representar los autos atendidos
                ->color('text-green-600') // Añadir color verde para resaltar el número de vehículos atendidos
                ->description('Total de vehículos atendidos en el taller.')
                ->descriptionIcon('heroicon-o-check-circle'), // Añadir un ícono de check para representar el servicio completado
        ];
    }
}
*/