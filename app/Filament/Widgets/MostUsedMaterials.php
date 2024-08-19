<?php
/*
namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class MostUsedMaterials extends BaseWidget
{
    protected function getStats(): array
    {
        $mostUsedMaterial = Consulta::selectRaw('Material_ID, COUNT(*) as total')
            ->groupBy('Material_ID')
            ->orderByDesc('total')
            ->with('material')
            ->first();

        // Verificar si existe un material más utilizado y mostrarlo con el número de veces que ha sido utilizado
        $materialInfo = $mostUsedMaterial && $mostUsedMaterial->material
            ? $mostUsedMaterial->material->nombre . ' (' . $mostUsedMaterial->total . ' veces)'
            : 'No disponible';

        return [
            Stat::make('Material Más Utilizado', $materialInfo)
                ->icon('heroicon-o-cube') // Añadir un ícono de cubo para representar el material
                ->color('text-orange-600') // Añadir color naranja para resaltar el material más utilizado
                ->description('Material que ha sido utilizado más veces en consultas.')
                ->descriptionIcon('heroicon-o-check-circle'), // Cambiar a un ícono de círculo con check disponible
        ];
    }
}
*/