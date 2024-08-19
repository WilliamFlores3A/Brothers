<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use Carbon\Carbon;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class AverageConsultationTime extends BaseWidget
{
    protected function getStats(): array
    {
        $topMechanic = Consulta::selectRaw('Mecanico_ID, COUNT(*) as total')
            ->groupBy('Mecanico_ID')
            ->orderByDesc('total')
            ->with('mecanico')
            ->first();

        $averageTimeInMinutes = Consulta::whereNotNull('FechaSalida')
            ->get()
            ->average(function ($consulta) {
                return Carbon::parse($consulta->HoraEntrada)
                    ->diffInMinutes(Carbon::parse($consulta->HoraSalida));
            });

        $totalCost = Consulta::with('servicio')->get()->sum(function ($consulta) {
                return $consulta->servicio->costoServicio ?? 0; // Asegurarse de que no falle si servicio es null
            });

        // Convertir el tiempo promedio de minutos a horas
        $averageTimeInHours = $averageTimeInMinutes ? $averageTimeInMinutes / 60 : null;

        $mechanicInfo = $topMechanic && $topMechanic->mecanico
        ? $topMechanic->mecanico->nombre . ' (' . $topMechanic->total . ' consultas)'
        : 'No disponible';

        return [
            Stat::make('Mecánico con Más Consultas', $mechanicInfo)
                ->icon('heroicon-o-user-circle') // Añadir un ícono de usuario para representar al mecánico
                ->color('text-blue-600') // Añadir color azul para resaltar el mejor desempeño
                ->description('Mecánico con el mayor número de consultas realizadas.')
                ->descriptionIcon('heroicon-o-star'), // Cambiar a un ícono de estrella disponible
            
            Stat::make('Tiempo Promedio por Consulta', $averageTimeInHours ? round($averageTimeInHours, 2) . ' horas' : 'No disponible')
                ->icon('heroicon-o-clock') // Añadir un ícono de reloj
                ->color('text-blue-600') // Añadir color azul para resaltar el tiempo
                ->description('Promedio de duración de consultas en horas.')
                ->descriptionIcon('heroicon-o-chart-bar'), // Ícono de gráfico de barras disponible

            Stat::make('Costo Total de Servicios', '$' . number_format($totalCost, 2))
                ->icon('heroicon-o-currency-dollar') // Añadir un ícono de dólar para representar el costo
                ->color('text-green-600') // Añadir color verde para resaltar el valor total positivo
                ->description('Suma total del costo de todos los servicios realizados.')
                ->descriptionIcon('heroicon-o-credit-card'), // Cambiar a un ícono de tarjeta de crédito disponible
           
        ];
    }
}
