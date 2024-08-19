<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Servicio;
use Carbon\Carbon;

class AverageConsultationCost extends BaseWidget
{
    protected function getStats(): array
    {
        // Calcular el promedio del campo costoServicio de la tabla Servicio
        $leastBusyMechanic = Consulta::selectRaw('Mecanico_ID, COUNT(*) as total')
            ->groupBy('Mecanico_ID')
            ->orderBy('total')
            ->with('mecanico')
            ->first();

        $mechanicInfo = $leastBusyMechanic && $leastBusyMechanic->mecanico
        ? $leastBusyMechanic->mecanico->nombre . ' (' . $leastBusyMechanic->total . ' consulta)'
        : 'No disponible';


        $averageCost = Servicio::average('costoServicio');

        $nearestAuto = Consulta::whereNotNull('FechaSalida')
            ->orderBy('FechaSalida')
            ->with('auto')
            ->first();

        // Formatear la información del auto más pronto a entregar
        $autoInfo = $nearestAuto && $nearestAuto->auto
            ? $nearestAuto->auto->placa . ' (Entrega: ' . Carbon::parse($nearestAuto->FechaSalida)->format('d/m/Y') . ')'
            : 'No disponible';
        
        return [
            Stat::make('Mecánico con Menos Consultas', $mechanicInfo)
                ->icon('heroicon-o-user-circle') // Añadir un ícono de usuario para representar el mecánico
                ->color('text-red-600') // Añadir color rojo para resaltar el valor
                ->description('Mecánico que ha realizado menos consultas.')
                ->descriptionIcon('heroicon-o-briefcase'), // Añadir un ícono de maletín para representar el trabajo
            
            Stat::make('Costo Promedio por Consulta', $averageCost ? '$' . number_format($averageCost, 2) : 'No disponible')
                ->icon('heroicon-o-currency-dollar') // Añadir un ícono de dólar
                ->color('text-green-600') // Añadir color verde para resaltar el valor
                ->description('Promedio basado en todos los servicios realizados.')
                ->descriptionIcon('heroicon-o-chart-bar'), // Cambiar a un ícono de gráfico de barras disponible
            Stat::make('Auto Más Pronto a Entregar', $autoInfo)
                ->icon('heroicon-o-truck') // Añadir un ícono de camión o vehículo para representar el auto
                ->color('text-green-600') // Añadir color verde para resaltar la entrega próxima
                ->description('Auto con la fecha de entrega más cercana.')
                ->descriptionIcon('heroicon-o-calendar'), // Añadir un ícono de calendario para representar la fecha
        ];
    }
}
