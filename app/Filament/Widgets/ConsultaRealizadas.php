<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Consulta;

class ConsultaRealizadas extends BaseWidget
{
    protected function getStats(): array
    {
        $mostRequestedService = Consulta::selectRaw('Servicio_ID, COUNT(*) as total')
            ->groupBy('Servicio_ID')
            ->orderByDesc('total')
            ->with('servicio')
            ->first();

        $mostUsedMaterial = Consulta::selectRaw('Material_ID, COUNT(*) as total')
            ->groupBy('Material_ID')
            ->orderByDesc('total')
            ->with('material')
            ->first();

        // Verificar si existe un servicio más solicitado y mostrarlo con el número de veces que ha sido solicitado
        $serviceInfo = $mostRequestedService && $mostRequestedService->servicio
            ? $mostRequestedService->servicio->nombre_servicio . ' (' . $mostRequestedService->total . ' veces)'
            : 'No disponible';
         // Verificar si existe un material más utilizado y mostrarlo con el número de veces que ha sido utilizado
        $materialInfo = $mostUsedMaterial && $mostUsedMaterial->material
            ? $mostUsedMaterial->material->nombre . ' (' . $mostUsedMaterial->total . ' veces)'
            : 'No disponible';

        $totalConsultations = Consulta::count();

        $vehiclesAttended = Consulta::distinct('Auto_ID')->count('Auto_ID');

        return [
            Stat::make('Servicio Más Solicitado', $serviceInfo)
                ->icon('heroicon-o-briefcase') // Añadir un ícono de maletín para representar el servicio
                ->color('text-indigo-600') // Añadir color índigo para resaltar el servicio más solicitado
                ->description('Servicio que ha sido solicitado más veces.')
                ->descriptionIcon('heroicon-o-chart-bar'), // Añadir un ícono de gráfico para representar la cantidad
            Stat::make('Material Más Utilizado', $materialInfo)
                ->icon('heroicon-o-cube') // Añadir un ícono de cubo para representar el material
                ->color('text-orange-600') // Añadir color naranja para resaltar el material más utilizado
                ->description('Material que ha sido utilizado más veces en consultas.')
                ->descriptionIcon('heroicon-o-check-circle'), // Cambiar a un ícono de círculo con check disponible
            Stat::make('Consultas Realizadas', $totalConsultations)
                ->icon('heroicon-o-document-text') // Cambiar a un ícono de documento para representar las consultas
                ->color('text-blue-600') // Añadir color azul para resaltar el número de consultas
                ->description('Total de consultas registradas.')
                ->descriptionIcon('heroicon-o-information-circle'), // Añadir un ícono de información
            Stat::make('Vehículos Atendidos', $vehiclesAttended)
                ->icon('heroicon-o-truck') // Añadir un ícono de camión o vehículo para representar los autos atendidos
                ->color('text-green-600') // Añadir color verde para resaltar el número de vehículos atendidos
                ->description('Total de vehículos atendidos en el taller.')
                ->descriptionIcon('heroicon-o-check-circle'), // Añadir un ícono de check para representar el servicio completado
        ];
    }
}
