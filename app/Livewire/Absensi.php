<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Leave;
use App\Models\Schedule;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Absensi extends Component
{
    public $latitude;
    public $longitude;
    public $insideRadius = null;

    public $showLeaveModal = false;
    public $isOnLeave = false;
    public function render()
    {
        $schedule = Schedule::where('user_id', Auth::user()->id)->first();
        $attendance = Attendance::where('user_id', Auth::user()->id)
            ->whereDate('created_at', Carbon::today()->toDateString())
            ->first();
        
        // penyesuaian cuti
        $today = Carbon::now()->format('Y-m-d');
        $approvedLeave = Leave::where('user_id', Auth::user()->id)
            ->where('status', 'approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->exists();
    
        $this->isOnLeave = $approvedLeave;
        $this->showLeaveModal = $approvedLeave;

        // penyesuaian weeken
        $todayIsWeekend = Carbon::now()->isWeekend();
        return view('livewire.absensi', [
            'schedule' => $schedule,
            'insideRadius' => $this->insideRadius,
            'attendance' => $attendance,
            'isOnLeave' => $this->isOnLeave,
            'showLeaveModal' => $this->showLeaveModal,
            'todayIsWeekend' => $todayIsWeekend
        ]);
    }

    // modal peringatan cuti
    public function closeLeaveModal()
    {
        $this->showLeaveModal = false;
    }

    public function store()
    {
        $this->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $schedule = Schedule::where('user_id', Auth::user()->id)->first();

        $today = Carbon::now()->format('Y-m-d');
        $approvedLeave = Leave::where('user_id', Auth::user()->id)
            ->where('status', 'approved')
            ->whereDate('start_date', '<=', $today)
            ->whereDate('end_date', '>=', $today)
            ->exists();
        if ($approvedLeave) {
            // 
        }

        if ($schedule) {
            $attendance = Attendance::where('user_id', Auth::user()->id)
                ->whereDate('created_at', Carbon::today()->toDateString())
                ->first();
            if (!$attendance) {
                $attendance = Attendance::create([
                    'user_id' => Auth::user()->id,
                    'schedule_latitude' => $schedule->office->latitude,
                    'schedule_longitude' => $schedule->office->longitude,
                    'schedule_start_time' => $schedule->shift->start_time,
                    'schedule_end_time' => $schedule->shift->end_time,
                    'start_latitude' => $this->latitude,
                    'start_longitude' => $this->longitude,
                    'start_time' => Carbon::now()->toTimeString(),
                ]);
            } else {
                $attendance->update([
                    'end_latitude' => $this->latitude,
                    'end_longitude' => $this->longitude,
                    'end_time' => Carbon::now()->toTimeString()
                ]);
            }

            return redirect()->route('absensi', [
                'schedule' => $schedule,
                'insideRadius' => false
            ]);
        }
    }

    public function toDashboard()
    {
        return redirect()->route('dashboard');
    }

    public function outFromAttendance()
    {
        return redirect()->route('logout');
    }
}
