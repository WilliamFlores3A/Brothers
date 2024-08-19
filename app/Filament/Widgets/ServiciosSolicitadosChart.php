<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ServiciosSolicitadosChart extends ChartWidget
{
    protected static ?string $heading = 'Servicios Solicitados';

    public ?string $filter = 'mas_solicitados'; // Filtro por defecto

    protected function getFilters(): ?array
    {
        return [
            'mas_solicitados' => 'Más Solicitados',
            'menos_solicitados' => 'Menos Solicitados',
        ];
    }

    protected function getType(): string
    {
        return 'bar'; // Gráfico de barras
    }

    protected function getData(): array
    {
        if ($this->filter === 'mas_solicitados') {
            // Obtener los servicios más solicitados
            $servicios = Consulta::with('servicio') // Cargar la relación 'servicio'
                ->select('Servicio_ID', DB::raw('count(*) as total'))
                ->groupBy('Servicio_ID')
                ->orderByDesc('total')
                ->limit(5) // Mostrar solo los 5 más solicitados
                ->get()
                ->mapWithKeys(function ($consulta) {
                    // Verificar si 'servicio' no es null
                    return [$consulta->servicio->nombre_servicio ?? 'Servicio no disponible' => $consulta->total];
                })
                ->toArray();
        } else {
            // Obtener los servicios menos solicitados
            $servicios = Consulta::with('servicio') // Cargar la relación 'servicio'
                ->select('Servicio_ID', DB::raw('count(*) as total'))
                ->groupBy('Servicio_ID')
                ->orderBy('total')
                ->limit(5) // Mostrar solo los 5 menos solicitados
                ->get()
                ->mapWithKeys(function ($consulta) {
                    // Verificar si 'servicio' no es null
                    return [$consulta->servicio->nombre_servicio ?? 'Servicio no disponible' => $consulta->total];
                })
                ->toArray();
        }

        return [
            'datasets' => [
                [
                    'label' => $this->filter === 'mas_solicitados' ? 'Servicios Más Solicitados' : 'Servicios Menos Solicitados',
                    'data' => array_values($servicios),
                    'backgroundColor' => [
                        '#4B8FD6', // Azul claro
                        '#3B79C4', // Azul medio
                        '#2A64B2', // Azul más oscuro
                        '#1A4EA0', // Azul muy oscuro
                        '#0A3899', // Azul aún más oscuro
                    ],
                    'borderColor' => '#2C3E50', // Gris oscuro
                    'borderWidth' => 1,
                    'hoverBackgroundColor' => '#A0A0A0', // Gris claro al pasar el cursor
                    'hoverBorderColor' => '#34495E', // Gris más oscuro al pasar el cursor
                ],
            ],
            'labels' => array_keys($servicios),
            'options' => [
                'scales' => [
                    'yAxes' => [
                        [
                            'ticks' => [
                                'beginAtZero' => true,
                            ],
                        ],
                    ],
                ],
                'legend' => [
                    'display' => true,
                    'position' => 'top',
                ],
            ],
        ];
    }
}
