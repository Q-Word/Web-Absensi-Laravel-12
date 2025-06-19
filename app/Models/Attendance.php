<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attendance extends Model
{
    protected $fillable = [
        'user_id',
        'schedule_latitude',
        'schedule_longitude',
        'schedule_start_time',
        'schedule_end_time',
        'start_latitude',
        'start_longitude',
        'start_time',
        'end_latitude',
        'end_longitude',
        'end_time',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statusHadir()
    {
        $scheduleStartTime = Carbon::parse($this->schedule_start_time);
        $scheduleEndTime = Carbon::parse($this->schedule_end_time);
        $startTime = Carbon::parse($this->start_time);

        $toleransiDatang = $scheduleStartTime->subMinutes(30);

        if ($startTime->greaterThan($scheduleEndTime)) {
            return 'Tidak Hadir';
        } else if ($startTime->between($toleransiDatang, $scheduleStartTime)) {
            return 'Tepat Waktu';
        } else if ($startTime->greaterThan($toleransiDatang)) {
            return 'Terlambat';
        }
    }
    public function workDuration(){
        $startTime = Carbon::parse($this->start_time);
        $endTime = Carbon::parse($this->end_time);
        
        // atasi kalau telat absen pulang
        $now = Carbon::now();
        $scheduleEndTime = Carbon::parse($this->schedule_end_time);
        if ($endTime->lessThan($now)) {
            $endTime = $scheduleEndTime;
        }

        $duration = $startTime->diff($endTime);
        $hours = $duration->h;
        $minutes = $duration->i;
        return $hours . ' Jam ' . $minutes . ' Menit ';
    }
}
