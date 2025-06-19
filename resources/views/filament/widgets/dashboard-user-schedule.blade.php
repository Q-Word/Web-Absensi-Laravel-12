<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex flex-col justify-between w-full">
            <div class="flex flex-col text-gray-800 bg-slate-200 rounded dark:bg-[#282828] dark:text-[#F5F5F5]">
                <!-- Component Start -->
                <div class="inline-block fi-ta-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">Detail</div>
                <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-1 p-2 w-full max-w-6xl rounded-xl dark:bg-[#282828]">
                    <!-- Tile 1 -->
                    <div class="flex items-center py-2 rounded pb-2 gap-2">
                        <div class="flex flex-shrink-0 items-center justify-center h-10 w-10 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="size-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                              </svg>
                               
                        </div>
                        <div class="flex-grow flex flex-col ml-4">
                            <span class="text-sm font-bold">Office</span>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule? $schedule->office->name : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Tile 2 -->
                    <div class="flex items-center py-2 rounded pb-2 gap-2">
                        <div class="flex flex-shrink-0 items-center justify-center h-10 w-10 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor" class="size-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                </svg>  
                        </div>
                        <div class="flex-grow flex flex-col ml-4">
                            <span class="text-sm font-bold">Shift</span>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule? $schedule->shift->name: '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Tile 3 -->
                    <div class="flex items-center py-2 rounded pb-2 gap-2">
                        <div class="flex flex-shrink-0 items-center justify-center h-10 w-10 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>  
                        </div>
                        <div class="flex-grow flex flex-col ml-4">
                            <span class="text-sm font-bold">Waktu Datang</span>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule? $schedule->shift->start_time: '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Tile 4 -->
                    <div class="flex items-center py-2 rounded pb-2 gap-2">
                        <div class="flex flex-shrink-0 items-center justify-center h-10 w-10 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="size-12">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>  
                        </div>
                        <div class="flex-grow flex flex-col ml-4">
                            <span class="text-sm font-bold">Waktu Pulang</span>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule? $schedule->shift->end_time: '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="inline-block fi-ta-header-heading text-base font-semibold leading-6 text-gray-950 dark:text-white">Absensi</div>
                <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-1 p-2 w-full max-w-6xl rounded">
                    <!-- Tile 1 -->
                    <div class="flex items-center py-2 rounded pb-2 gap-2">
                        <div class="flex flex-shrink-0 items-center justify-center h-10 w-10 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                            </svg> 
                               
                        </div>
                        <div class="flex-grow flex flex-col ml-4">
                            <span class="text-sm font-bold">Absensi Datang</span>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $attendance? $attendance->start_time : '-' }}</span>
                            </div>
                        </div>
                    </div>
                    <!-- Tile 2 -->
                    <div class="flex items-center py-2 rounded pb-2 gap-2">
                        <div class="flex flex-shrink-0 items-center justify-center h-10 w-10 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                            </svg> 
                        </div>
                        <div class="flex-grow flex flex-col ml-4">
                            <span class="text-sm font-bold">Absensi Pulang</span>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $attendance && $attendance->end_time ? $attendance->end_time : '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
