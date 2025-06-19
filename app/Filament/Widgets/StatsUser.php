<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\User;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsUser extends BaseWidget
{
    use HasWidgetShield;
    public static function sort(): int
    {
        return 2; // untuk widget paling atas
    }
    protected function getStats(): array
    {
        // Data chart user 3 bulan terakhir
        $months = collect();
        $counts = collect();
        for ($i = 2; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $label = $date->format('M Y');
            $months->push($label);
            $counts->push(
                User::whereYear('created_at', $date->year)
                    ->whereMonth('created_at', $date->month)
                    ->count()
            );
        }

        // Ambil jumlah user baru bulan ini dan bulan lalu
        $thisMonth = $counts[2] ?? 0;
        $lastMonth = $counts[1] ?? 0;

        $countDesc = User::whereDoesntHave('roles', function ($q) {
            $q->where('name', 'super_admin');
        })->whereMonth('created_at', now()->month)->count();
        $desc = "{$countDesc} user bertambah bulan ini";
        $trendColor = $thisMonth > $lastMonth ? 'success' : 'info';
        $trendIcon = $thisMonth > $lastMonth ? 'heroicon-m-arrow-trending-up' : null;

        $cutiPending = Leave::where('status', 'pending')->count();
        return [
            Stat::make(
                'Total User',
                User::whereDoesntHave('roles', function ($q) {
                    $q->where('name', 'super_admin');
                })->count()
            )
                ->description($desc)
                ->chart($counts->toArray())
                ->color($trendColor)
                ->descriptionIcon($trendIcon),
            Stat::make(
                'Kehadiran',
                Attendance::whereDate('created_at', now()->toDateString())
                    ->distinct('user_id')
                    ->count('user_id')
            )
                ->description('User Hadir Hari Ini')
                ->color('info')
                ->chart([0,Attendance::whereDate('created_at', now()->toDateString())->count()]),
            Stat::make(
                'Permintaan Cuti',
                Leave::where('status', 'pending')->count()
            )
                ->description("Ada {$cutiPending} permintaan cuti yang belum di setujui")
                ->color('warning'),
        ];
    }

}
