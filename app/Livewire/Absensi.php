<?php

namespace App\Livewire;

use App\Models\Schedule;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Absensi extends Component
{
    public $latitude;
    public $longitude;
    public $insideRadius = null;
    public function render()
    {
        $schedule = Schedule::where('user_id', Auth::user()->id)->first();
        return view('livewire.absensi', [
            'schedule' => $schedule,
            'insideRadius' => $this->insideRadius
        ]);
    }
}
