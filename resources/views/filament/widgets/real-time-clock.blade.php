{{-- filepath: resources/views/filament/widgets/real-time-clock.blade.php --}}
<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col gap-2">
            <div class="block text-base font-semibold leading-6 text-gray-950 dark:text-white">Absensi</div>
            <div class="clock-container p-8 text-center text-gray-950 dark:text-white" style="margin: 32px 0">
                <!-- Date Display -->
                <div class="date text-2xl mb-2 font-bold" id="clock-date">
                    {{ $date }}
                </div>
                
                <!-- Time Display -->
                <div class="time text-5xl font-bold" id="clock-time">
                    {{ $time }}
                </div>
                
                <!-- Timezone Info -->
                <div class="mt-4 text-sm opacity-75" id="clock-tz">
                    Timezone: {{ $timezone }}
                </div>
            </div>
            <div class="block">
                <div class="flex flex-col items-center justify-center text-white">
                    <a href="{{ $allowSubmit&&!$todayIsWeekend ? url('/absensi'): '#' }}" class="flex w-fit py-2 px-4 mt-6 rounded-lg gap-2" style="background: {{ !$allowSubmit||$todayIsWeekend ? 'oklch(44.6% 0.03 256.802)' : ($isLate ? '#dc3545' : '#007bff') }}">
                        <div class="flex shrink items-center justify-center h-6 w-6 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>  
                        </div>
                        <span class="font-semibold">
                            Absen Sekarang
                            @if ($todayIsWeekend)
                                <span class="ml-2 text-xs font-medium">(hari libur)</span>
                            @elseif($isLate&&$allowSubmit)
                                <span class="ml-2 text-xs font-medium">(anda akan dicatat terlambat)</span>
                            @endif
                        </span>
                    </a>
                    @if(!$allowSubmit)
                        <p class="block text-xs" style="color: #dc3545">*Belum bisa melakukan absensi</p>
                    @endif
                <div>
            </div>
        </div>
        <script>
            // Simple JS to update time every second (client-side)
            function updateClock() {
                const now = new Date();
                const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
                document.getElementById('clock-date').innerText = now.toLocaleDateString('id-ID', dateOptions);
                document.getElementById('clock-time').innerText = now.toLocaleTimeString('id-ID');
            }
            setInterval(updateClock, 1000);
            updateClock();
        </script>
    </x-filament::section>
</x-filament-widgets::widget>