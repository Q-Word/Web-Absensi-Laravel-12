<?php

namespace App\Filament\Widgets;

use App\Models\Attendance;
use App\Models\Schedule;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class RealTimeClock extends Widget
{
    use HasWidgetShield;
    protected static string $view = 'filament.widgets.real-time-clock';

    public $date;
    public $time;
    public $timezone = 'Asia/Makassar';

    public function mount()
    {
        $this->updateTime();
    }

    public function updateTime()
    {
        $now = Carbon::now($this->timezone);
        $this->date = $now->isoFormat('dddd, D MMMM Y');
        $this->time = $now->format('H:i:s');
        $this->timezone = $now->timezoneName;
    }

    protected function getViewData(): array
    {
        $schedule = Schedule::where('user_id', Auth::user()->id)->first();
        $attendance = Attendance::where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today()->toDateString())
            ->first();
        $start_time = Carbon::parse($schedule ? $schedule->shift->start_time : '');
        $end_time = Carbon::parse($schedule? $schedule->shift->end_time: '');
        $toleransiDatang = $start_time->subMinutes(30);
        $now = Carbon::now($this->timezone);
        $isLate = $now->greaterThan($toleransiDatang);
        return [
            'date' => $this->date,
            'time' => $this->time,
            'timezone' => $this->timezone,
            'schedule' => $schedule,
            'attendance' => $attendance,
            'toleransiDatang' => $toleransiDatang,
            'endtime' => $end_time,
            'isLate' => $isLate,
        ];
    }
}
