<div class="container mx-auto justify-center max-w-4xl my-auto h-screen content-center">
  <div class=" p-6 bg-[#F5F5F5] border border-gray-200 rounded-lg dark:bg-[#1B1B1B] dark:border-gray-700 shadow-[0px_10px_1px_rgba(221,_221,_221,_1),_0_10px_20px_rgba(204,_204,_204,_1)]">
    <div class="flex p-3 justify-between">
      <div class="flex gap-2 items-center">
        <flux:avatar size="lg" name="{{ Auth::user()->name }}" />
        <div class="flex-col">
          <flux:heading>{{ Auth::user()->name }}</flux:heading>
          <flux:text>{{ Auth::user()->roles[0]['name'] }}</flux:text>
        </div>
      </div>
      <div class="content-center">
        <flux:switch x-data x-model="$flux.dark" label="Dark mode"  />
      </div>
    </div>
    <flux:separator class="my-2" />
    <div class="flex md:flex-row flex-col w-[100%]">
      <div class="bg-teal-500 w-full">
        <div id="map" class= "h-96" wire:ignore>
  
        </div>
        {{-- Alert --}}
        @if ($insideRadius === null)
          <div class="bg-yellow-50 border border-s-4 border-yellow-200 text-sm text-yellow-800 p-4 dark:bg-yellow-950 dark:border-yellow-900 dark:text-yellow-500" role="alert" tabindex="-1" aria-labelledby="hs-with-description-label">
            <div class="flex">
              <div class="shrink-0">
                <svg class="shrink-0 size-4 mt-0.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"></path>
                  <path d="M12 9v4"></path>
                  <path d="M12 17h.01"></path>
                </svg>
              </div>
              <div class="ms-4">
                <h3 id="hs-with-description-label" class="text-sm font-semibold">
                  Silahkan Submit Lokasi Anda
                </h3>
                <div class="mt-1 text-sm text-yellow-700">
                  Pastikan Anda Berada di Lingkungan Kantor.
                </div>
              </div>
            </div>
          </div>
        @elseif ($insideRadius === true)
          <div class="bg-teal-50 border-s-4 border-teal-500 p-4 dark:bg-teal-800/30" role="alert" tabindex="-1" aria-labelledby="hs-bordered-success-style-label">
            <div class="flex">
              <div class="shrink-0">
                <!-- Icon -->
                <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-teal-100 bg-teal-200 text-teal-800 dark:border-teal-900 dark:bg-teal-800 dark:text-teal-400">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22c5.523 0 10-4.477 10-10S17.523 2 12 2 2 6.477 2 12s4.477 10 10 10z"></path>
                    <path d="m9 12 2 2 4-4"></path>
                  </svg>
                </span>
                <!-- End Icon -->
              </div>
              <div class="ms-3">
                <h3 id="hs-bordered-success-style-label" class="text-gray-800 font-semibold dark:text-white">
                  Lokasi Valid.
                </h3>
                <p class="text-sm text-gray-700 dark:text-neutral-100">
                  Anda Berada di Lingkungan Kantor. Silahkan Melanjutkan Proses absensi.
                </p>
              </div>
            </div>
          </div>
        @elseif ($insideRadius === false)
          <div class="bg-red-50 border-s-4 border-red-500 p-4 dark:bg-red-800" role="alert" tabindex="-1" aria-labelledby="hs-bordered-red-style-label">
            <div class="flex">
              <div class="shrink-0">
                <!-- Icon -->
                <span class="inline-flex justify-center items-center size-8 rounded-full border-4 border-red-100 bg-red-200 text-red-800 dark:border-red-900 dark:bg-red-800 dark:text-red-400">
                  <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 6 6 18"></path>
                    <path d="m6 6 12 12"></path>
                  </svg>
                </span>
                <!-- End Icon -->
              </div>
              <div class="ms-3">
                <h3 id="hs-bordered-red-style-label" class="text-gray-800 font-semibold dark:text-white">
                  Error!
                </h3>
                <p class="text-sm text-gray-700 dark:text-neutral-200">
                  Anda Berada di Luar Radius Absensi!.
                </p>
              </div>
            </div>
          </div>
        @endif
        {{-- <p>grid 2</p> --}}
      </div>
      <flux:separator class="mx-2 my-2" vertical />
      <div class="flex flex-col justify-between p-2 w-full">
        <div class="grid mb-3 gap-2">
          <div class="flex flex-col text-gray-800 px-2 py-3 bg-slate-200 rounded dark:bg-[#282828] dark:text-[#F5F5F5]">
            <!-- Component Start -->
            <div class="inline-block px-1.5 font-bold text-lg dark:text-white">Detail</div>
            <flux:separator class="mb-2 mt-1" />
            <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-1 w-full max-w-6xl rounded">
                <!-- Tile 1 -->
                <div class="flex items-center bg-white rounded pb-2 dark:bg-[#363636]">
                    <div class="flex flex-shrink-0 items-center justify-center h-8 w-8 rounded ml-2 mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 21h19.5m-18-18v18m10.5-18v18m6-13.5V21M6.75 6.75h.75m-.75 3h.75m-.75 3h.75m3-6h.75m-.75 3h.75m-.75 3h.75M6.75 21v-3.375c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21M3 3h12m-.75 4.5H21m-3.75 3.75h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Zm0 3h.008v.008h-.008v-.008Z" />
                      </svg>                    
                    </div>
                    <div class="flex-grow flex flex-col ml-4 items-start">
                        <span class="text-base font-bold">Office</span>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule->office->name }}</span>
                        </div>
                    </div>
                </div>
                <!-- Tile 2 -->
                <div class="flex items-center bg-white rounded pb-2 dark:bg-[#363636]">
                    <div class="flex flex-shrink-0 items-center justify-center h-8 w-8 rounded ml-2 mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                      </svg>                    
                    </div>
                    <div class="flex-grow flex flex-col ml-4">
                        <span class="text-base font-bold">Shift</span>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule->shift->name }}</span>
                        </div>
                    </div>
                </div>
                <!-- Tile 3 -->
                <div class="flex items-center bg-white rounded pb-2 dark:bg-[#363636]">
                    <div class="flex flex-shrink-0 items-center justify-center h-8 w-8 rounded ml-2 mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>                      
                    </div>
                    <div class="flex-grow flex flex-col ml-4 items-start">
                        <span class="text-base font-bold">Waktu Datang</span>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule->shift->start_time }}</span>
                        </div>
                    </div>
                </div>
                <!-- Tile 4 -->
                <div class="flex items-center bg-white rounded pb-2 dark:bg-[#363636]">
                    <div class="flex flex-shrink-0 items-center justify-center h-8 w-8 rounded ml-2 mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                      </svg>  
                    </div>
                    <div class="flex-grow flex flex-col ml-4">
                        <span class="text-base font-bold">Waktu Pulang</span>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $schedule->shift->end_time }}</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
          <div class="flex flex-col text-gray-800 px-2 py-3 bg-slate-200 rounded dark:bg-[#282828] dark:text-[#F5F5F5]">
            <!-- Component Start -->
            <div class="inline-block px-1.5 font-bold text-lg dark:text-white">Absensi</div>
            <flux:separator class="mb-2 mt-1" />
            <div class="grid lg:grid-cols-2 md:grid-cols-2 gap-1 w-full max-w-6xl rounded">
                <!-- Tile 1 -->
                <div class="flex items-center bg-white rounded pb-2 dark:bg-[#363636]">
                    <div class="flex flex-shrink-0 items-center justify-center h-8 w-8 rounded ml-2 mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                      </svg>                                         
                    </div>
                    <div class="flex-grow flex flex-col ml-4 items-start">
                        <span class="text-base font-bold">Absensi Datang</span>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $attendance? $attendance->start_time : '-' }}</span>
                        </div>
                    </div>
                </div>
                <!-- Tile 2 -->
                <div class="flex items-center bg-white rounded pb-2 dark:bg-[#363636]">
                    <div class="flex flex-shrink-0 items-center justify-center h-8 w-8 rounded ml-2 mt-2">
                      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                      </svg>                                        
                    </div>
                    <div class="flex-grow flex flex-col ml-4">
                        <span class="text-base font-bold">Absensi Pulang</span>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-500 text-xs dark:text-[#c4c4c4]">{{ $attendance? $attendance->end_time : '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="flex gap-2 flex-col sm:flex-row">
          <form wire:submit='store' enctype="multipart/form-data" class="flex gap-2 w-full">
            <flux:button type="button" icon="map-pin" id="btnTagLocation" class="w-full bg-amber-500! hover:bg-amber-400!">Submit Lokasi</flux:button>
            @if ($insideRadius)
            <flux:button type="button" wire:click="store" icon="check-badge" class="w-full bg-green-500! hover:bg-green-400!">Submit Absensi</flux:button>
            @endif
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- In work, do what you enjoy. --}}

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
  <script>
    let map;
    let lat;
    let lng;
    const office = [{{ $schedule->office->latitude }}, {{$schedule->office->longitude}}];
    const radius = {{ $schedule->office->radius }};
    let component;
    let marker;

    document.addEventListener('livewire:initialized', function() {
      component = @this;
      map = L.map('map').setView([{{ $schedule->office->latitude }}, {{$schedule->office->longitude}}], 13);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          maxZoom: 19,
          attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);
     
      const circle = L.circle(office, {
        color: 'red',
        fillColor: '#f03',
        fillOpacity: 0.5,
        radius: radius
      }).addTo(map);
    });
    function tagLocation(){
      if (navigator.geolocation){
        navigator.geolocation.getCurrentPosition(function(position) {
          lat = position.coords.latitude;
          lng = position.coords.longitude;

          if (marker){
            map.removeLayer(marker);
          };

          marker = L.marker([lat, lng]).addTo(map);
          map.setView([lat, lng], 13);
          console.log('set');

          if (isWithinRadius(lat, lng, office, radius)){
            component.set('insideRadius', true);
            component.set('latitude', lat);
            component.set('longitude', lng);
          } else {
            component.set('insideRadius', false);
            // alert('Luar Radius');
          }
        });
      } else {
        alert('Tidak bisa mendapatkan informasi lokasi');
        console.log('Tes');
        
      };
    };
    function attachTagLocationListener() {
      // Cari button berdasarkan text
      const btns = document.querySelectorAll('button');
      btns.forEach(btn => {
        if (btn.textContent.trim() === 'Submit Lokasi') {
          btn.removeEventListener('click', tagLocation);
          btn.addEventListener('click', tagLocation);
        }
      });
    }
    document.addEventListener('DOMContentLoaded', attachTagLocationListener);
    // Jika pakai Livewire, pasang ulang setelah render
    document.addEventListener('livewire:load', () => {
      Livewire.hook('message.processed', () => {
        attachTagLocationListener();
      });
    });

    function isWithinRadius(lat, lng, center, radius) {
      const is_wfa = {{ $schedule->is_wfa }};
      if (is_wfa){
        return true;
      } else{
        let distance = map.distance([lat, lng], center);
        return distance <= radius;
      }
    }
  </script>
</div>
