<div class="container mx-auto justify-center max-w-4xl my-auto h-screen content-center">
  <div class=" p-6 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-[#393939] dark:border-gray-700">
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
        <div class="grid mb-3">
          <flux:heading size="lg">Office: {{ $schedule->office->name }}</flux:heading>
          <flux:heading size="lg">Shift: {{ $schedule->shift->name }}</flux:heading>
          <flux:text color="amber">({{ $schedule->shift->start_time }} - {{ $schedule->shift->end_time }})</flux:text>
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
            cxomponent.set('latitude', lat);
            cxomponent.set('longitude', lng);
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
