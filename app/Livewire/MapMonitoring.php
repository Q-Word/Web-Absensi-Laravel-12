<?php

namespace App\Livewire;

use App\Models\Attendance;
use Carbon\Carbon;
use Livewire\Component;

class MapMonitoring extends Component
{
    public function render()
    {
        // $attendances = Attendance::query()->whereDate('created_at', Carbon::today()->toDateString())->get();
        $attendances = Attendance::with('user')->get();
        // return view('livewire.map-monitoring', compact('attendances'));
        return view('livewire.map-monitoring', [
            'attendances' => $attendances
        ]);
    }
}
