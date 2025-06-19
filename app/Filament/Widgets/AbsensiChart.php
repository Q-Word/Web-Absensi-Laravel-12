<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\ChartWidget;

class AbsensiChart extends ChartWidget
{
    use HasWidgetShield;
    // protected static ?string $heading = 'Chart';

    protected static ?string $maxHeight = '300px';

    protected function getData(): array
    {
        $filter = $this->getFilters();

        $query = \App\Models\Attendance::query();

        if ($filter === 'daily') {
            $query->whereDate('created_at', now()->toDateString());
        } elseif ($filter === 'monthly') {
            $query->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year);
        } elseif ($filter === 'yearly') {
            $query->whereYear('created_at', now()->year);
        }

        $attendances = $query->get();

        $tepatWaktu = $attendances->filter(fn($a) => $a->statusHadir() === 'Tepat Waktu')->count();
        $terlambat = $attendances->filter(fn($a) => $a->statusHadir() === 'Terlambat')->count();
        $tidakHadir = $attendances->filter(fn($a) => $a->statusHadir() === 'Tidak Hadir')->count();

        return [
            'labels' => ['Tepat Waktu', 'Terlambat', 'Tidak Hadir'],
            'datasets' => [
                [
                    'label' => 'Status Kehadiran',
                    'data' => [$tepatWaktu, $terlambat, $tidakHadir],
                    'backgroundColor' => [
                        'rgba(54, 162, 235)',
                        'rgba(255, 206, 86)',
                        'rgba(255, 99, 132)',
                    ],
                ],
            ],
        ];
    }
    protected function getFilters(): ?array
    {
        return [
            'daily' => 'Harian',
            'monthly' => 'Bulanan',
            'yearly' => 'Tahunan',
        ];
    }

    protected function getType(): string
    {
        return 'polarArea';
    }
}
