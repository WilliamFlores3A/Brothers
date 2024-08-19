<?php

/*namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Carbon\Carbon;

class NearestDeliveryAuto extends BaseWidget
{
    protected function getStats(): array
    {
        $nearestAuto = Consulta::whereNotNull('FechaSalida')
            ->orderBy('FechaSalida')
            ->with('auto')
            ->first();

        // Formatear la información del auto más pronto a entregar
        $autoInfo = $nearestAuto && $nearestAuto->auto
            ? $nearestAuto->auto->placa . ' (Entrega: ' . Carbon::parse($nearestAuto->FechaSalida)->format('d/m/Y') . ')'
            : 'No disponible';

        return [
            Stat::make('Auto Más Pronto a Entregar', $autoInfo)
                ->icon('heroicon-o-truck') // Añadir un ícono de camión o vehículo para representar el auto
                ->color('text-green-600') // Añadir color verde para resaltar la entrega próxima
                ->description('Auto con la fecha de entrega más cercana.')
                ->descriptionIcon('heroicon-o-calendar'), // Añadir un ícono de calendario para representar la fecha
        ];
    }
}
*/