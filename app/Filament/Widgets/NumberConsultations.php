<?php
/*
namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class NumberConsultations extends BaseWidget
{
    protected function getStats(): array
    {
        $totalConsultations = Consulta::count();

        return [
            Stat::make('Consultas Realizadas', $totalConsultations)
                ->icon('heroicon-o-document-text') // Cambiar a un ícono de documento para representar las consultas
                ->color('text-blue-600') // Añadir color azul para resaltar el número de consultas
                ->description('Total de consultas registradas.')
                ->descriptionIcon('heroicon-o-information-circle'), // Añadir un ícono de información
        ];
    }
}
*/