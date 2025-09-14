
<section class="bg-light-base dark:bg-dark-base text-dark-base dark:text-light-base section-padding-x py-16">
  <div class="max-w-screen-xl mx-auto">
    
    {{-- Tampilkan pesan error jika ada --}}
    @if (!empty($facilities['error']))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
        <p>{{ $facilities['error'] }} (Status: {{ $facilities['status'] }})</p>
      </div>
    @endif

    {{-- Tampilkan grid fasilitas jika tidak ada error dan data tersedia --}}
    @if (empty($facilities['error']) && !empty($facilities))
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        @foreach ($facilities as $facility)
          <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow">
            <a href="{{ route('facilities.show', ['slug' => $facility['slug']]) }}" class="block h-48">
              <img
                src="{{ config('services.api.storage_url') }}/{{ $facility['images'][0] ?? '' }}"
                alt="{{ $facility['name'] }}"
                class="object-cover w-full h-full"
                loading="lazy"
              />
            </a>
            <div class="p-5">
              <div class="flex justify-between items-start mb-3">
                <a href="{{ route('facilities.show', ['slug' => $facility['slug']]) }}" class="block">
                  <h3 class="text-lg font-bold text-sipil-base dark:text-sipil-blue-accent line-clamp-2">
                    {{ $facility['name'] }}
                  </h3>
                </a>
                <span class="inline-block bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-md flex-shrink-0">
                  {{ $facility['room'] }}
                </span>
              </div>
              <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm line-clamp-2">
                {{ $facility['description'] }}
              </p>
              <div class="flex items-center text-sm text-gray-500 dark:text-gray-300 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                <span>{{ $facility['code'] }}</span>
                <span class="mx-2">•</span>
                <span>{{ count($facility['tests']) }} Pengujian</span>
                @if (count($facility['packages']) > 0)
                  <span class="mx-2">•</span>
                  <span>{{ count($facility['packages']) }} Paket</span>
                @endif
              </div>
              <a
                href="{{ route('facilities.show', ['slug' => $facility['slug']]) }}"
                class="inline-flex items-center text-sipil-base dark:text-blue-400 font-medium hover:underline"
              >
                Lihat Detail
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" /></svg>
              </a>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8">
        {{ $facilities->links() }}
      </div>

    {{-- Tampilkan pesan jika data kosong --}}
    @elseif (empty($facilities['error']))
      <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <p class="text-gray-500">Tidak ada fasilitas yang tersedia saat ini.</p>
      </div>
    @endif
  </div>
</section>