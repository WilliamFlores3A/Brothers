<?php
/*
namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Consulta;

class TopMechanic extends BaseWidget
{
    protected function getStats(): array
    {
        $topMechanic = Consulta::selectRaw('Mecanico_ID, COUNT(*) as total')
            ->groupBy('Mecanico_ID')
            ->orderByDesc('total')
            ->with('mecanico')
            ->first();

        // Preparar la visualización del nombre del mecánico y el número de consultas
        $mechanicInfo = $topMechanic && $topMechanic->mecanico
            ? $topMechanic->mecanico->nombre . ' (' . $topMechanic->total . ' consultas)'
            : 'No disponible';

        return [
            Stat::make('Mecánico con Más Consultas', $mechanicInfo)
                ->icon('heroicon-o-user-circle') // Añadir un ícono de usuario para representar al mecánico
                ->color('text-blue-600') // Añadir color azul para resaltar el mejor desempeño
                ->description('Mecánico con el mayor número de consultas realizadas.')
                ->descriptionIcon('heroicon-o-star'), // Cambiar a un ícono de estrella disponible

            ];
    }
}
*/