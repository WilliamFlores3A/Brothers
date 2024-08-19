<?php

namespace App\Filament\Widgets;

use App\Models\Consulta;
use Filament\Widgets\LineChartWidget;
use Filament\Widgets\ChartWidget;
use Filament\Forms\Components\Select;



class ConsultasPorDiaChart extends LineChartWidget
{
    protected static ?string $heading = 'Consultas por Periodo';
    public ?string $filter = 'dia'; // Filtro inicial (día)

    protected function getFilters(): array
    {
        return [
            'dia' => 'Por Día',
            'mes' => 'Por Mes',
        ];
    }

    protected function getData(): array
    {
        if ($this->filter === 'dia') {
            // Obtener consultas por día de la semana
            $consultasPorDia = Consulta::selectRaw('DAYOFWEEK(FechaDelIngreso) as day, COUNT(*) as count')
                ->groupBy('day')
                ->orderBy('day')
                ->pluck('count', 'day')
                ->toArray();

            $diasSemana = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
            $consultas = array_replace(array_fill_keys(range(1, 7), 0), $consultasPorDia);

            return [
                'datasets' => [
                    [
                        'label' => 'Consultas por Día',
                        'data' => array_values($consultas),
                        'borderColor' => '#4B8FD6',
                        'backgroundColor' => 'rgba(255, 178, 0, 0.1)',
                    ],
                ],
                'labels' => $diasSemana,
            ];
        } elseif ($this->filter === 'mes') {
            // Obtener consultas por mes
            $consultasPorMes = Consulta::selectRaw('MONTH(FechaDelIngreso) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('count', 'month')
                ->toArray();

            $meses = ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'];
            $consultas = array_replace(array_fill_keys(range(1, 12), 0), $consultasPorMes);

            return [
                'datasets' => [
                    [
                        'label' => 'Consultas por Mes',
                        'data' => array_values($consultas),
                        'borderColor' => '#4B8FD6',
                        'backgroundColor' => 'rgba(255, 178, 0, 0.1)',
                    ],
                ],
                'labels' => $meses,
            ];
        }


    }

    protected function getFormSchema(): array
    {
        return [
            Select::make('filter')
                ->options($this->getFilters())
                ->default('dia')
                ->reactive()
                ->label('Periodo')
                ->afterStateUpdated(fn ($state) => $this->filter = $state),

           
        ];
    }
}
