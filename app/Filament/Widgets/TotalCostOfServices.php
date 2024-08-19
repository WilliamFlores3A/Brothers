<?php
/*
namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class TotalCostOfServices extends BaseWidget
{
    protected function getStats(): array
    {
        $totalCost = Consulta::with('servicio')->get()->sum(function ($consulta) {
            return $consulta->servicio->costoServicio ?? 0; // Asegurarse de que no falle si servicio es null
        });

        return [
            Stat::make('Costo Total de Servicios', '$' . number_format($totalCost, 2))
                ->icon('heroicon-o-currency-dollar') // Añadir un ícono de dólar para representar el costo
                ->color('text-green-600') // Añadir color verde para resaltar el valor total positivo
                ->description('Suma total del costo de todos los servicios realizados.')
                ->descriptionIcon('heroicon-o-credit-card'), // Cambiar a un ícono de tarjeta de crédito disponible
        ];
    }
}
*/