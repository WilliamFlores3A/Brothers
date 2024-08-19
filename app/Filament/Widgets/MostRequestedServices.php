<?php
/*
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Consulta;

class MostRequestedServices extends BaseWidget
{
    protected function getStats(): array
    {
        $mostRequestedService = Consulta::selectRaw('Servicio_ID, COUNT(*) as total')
            ->groupBy('Servicio_ID')
            ->orderByDesc('total')
            ->with('servicio')
            ->first();

        // Verificar si existe un servicio más solicitado y mostrarlo con el número de veces que ha sido solicitado
        $serviceInfo = $mostRequestedService && $mostRequestedService->servicio
            ? $mostRequestedService->servicio->nombre_servicio . ' (' . $mostRequestedService->total . ' veces)'
            : 'No disponible';

        return [
            Stat::make('Servicio Más Solicitado', $serviceInfo)
                ->icon('heroicon-o-briefcase') // Añadir un ícono de maletín para representar el servicio
                ->color('text-indigo-600') // Añadir color índigo para resaltar el servicio más solicitado
                ->description('Servicio que ha sido solicitado más veces.')
                ->descriptionIcon('heroicon-o-chart-bar'), // Añadir un ícono de gráfico para representar la cantidad
        ];
    }
}
*/