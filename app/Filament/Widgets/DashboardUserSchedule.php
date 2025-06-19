<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Schedule;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardUserSchedule extends Widget
{
    use HasWidgetShield;
    protected static string $view = 'filament.widgets.dashboard-user-schedule';

    protected function getViewData(): array
    {
        $schedule = Schedule::where('user_id', Auth::user()->id)->first();
        $attendance = Attendance::where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today()->toDateString())
            ->first();

        return [
            'schedule' => $schedule,
            'attendance' => $attendance,
        ];
    }
}
