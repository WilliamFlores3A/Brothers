<?php

/*namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class LeastBusyMechanic extends BaseWidget
{
    protected function getStats(): array
    {
        
        // Buscar el mecánico con menos consultas
        $leastBusyMechanic = Consulta::selectRaw('Mecanico_ID, COUNT(*) as total')
            ->groupBy('Mecanico_ID')
            ->orderBy('total')
            ->with('mecanico')
            ->first();

        // Preparar la visualización del nombre del mecánico y el número de consultas
        $mechanicInfo = $leastBusyMechanic && $leastBusyMechanic->mecanico
            ? $leastBusyMechanic->mecanico->nombre . ' (' . $leastBusyMechanic->total . ' consultas)'
            : 'No disponible';

        return [
            Stat::make('Mecánico con Menos Consultas', $mechanicInfo)
                ->icon('heroicon-o-user-circle') // Añadir un ícono de usuario para representar el mecánico
                ->color('text-red-600') // Añadir color rojo para resaltar el valor
                ->description('Mecánico que ha realizado menos consultas.')
                ->descriptionIcon('heroicon-o-briefcase'), // Añadir un ícono de maletín para representar el trabajo
        ];
        
    }
}*/
