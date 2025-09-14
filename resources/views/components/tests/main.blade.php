<section class="bg-light-base dark:bg-dark-base text-dark-base dark:text-light-base section-padding-x py-16">
  <div class="max-w-screen-xl mx-auto">
    
    {{-- Tampilkan pesan error jika ada --}}
    @if (!empty($tests['error']))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
        <p>{{ $tests['error'] }} (Status: {{ $tests['status'] }})</p>
      </div>
    @endif

    {{-- Tampilkan grid pengujian jika tidak ada error dan data tersedia --}}
    @if (empty($tests['error']) && !empty($tests))
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($tests as $test)
          <div class="group bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow {{ !$test['is_active'] ? 'opacity-70' : '' }}">
            <div class="relative h-48">
              <a href="{{ route('tests.show', ['slug' => $test['slug']]) }}">
                <img
                  src="{{ config('services.api.storage_url') }}/{{ $test['images'][0] ?? '' }}"
                  alt="{{ $test['name'] }}"
                  class="object-cover w-full h-full"
                  loading="lazy"
                />
              </a>
              @if (!$test['is_active'])
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                  <span class="px-3 py-1 bg-red-500 text-white text-sm font-medium rounded-full">
                    Tidak Tersedia
                  </span>
                </div>
              @endif
            </div>
            <div class="p-5">
              <div class="flex justify-between items-start mb-3">
                <h2 class="text-lg font-bold text-sipil-base dark:text-sipil-blue-accent">
                  <a href="{{ route('tests.show', ['slug' => $test['slug']]) }}">{{ $test['name'] }}</a>
                </h2>
                @if ($test['is_active'])
                  <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">
                    Tersedia
                  </span>
                @endif
              </div>
              <p class="text-gray-600 dark:text-gray-400 mb-4 text-sm line-clamp-2">
                {{ $test['description'] }}
              </p>
              <div class="flex flex-col gap-2 mb-4 text-sm">
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                  <span>{{ $test['laboratory']['name'] }}</span>
                </div>
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" /></svg>
                  <span>Min. {{ $test['minimum_unit'] }} sampel</span>
                </div>
                <div class="flex items-center gap-1 text-gray-600 dark:text-gray-300">
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                  <span>{{ $test['daily_slot'] }} slot per hari</span>
                </div>
              </div>
              <a
                href="{{ route('tests.show', ['slug' => $test['slug']]) }}"
                class="inline-flex items-center px-4 py-2 bg-sipil-base text-white rounded-md hover:bg-sipil-secondary transition-colors {{ !$test['is_active'] ? 'opacity-50 cursor-not-allowed pointer-events-none' : '' }}"
              >
                <span>Detail Pengujian</span>
              </a>
            </div>
          </div>
        @endforeach
      </div>

      <div class="mt-8">
        {{ $tests->links() }}
      </div>

    {{-- Tampilkan pesan jika data kosong --}}
    @elseif (empty($tests['error']))
      <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <p class="text-gray-500">Tidak ada layanan pengujian yang tersedia saat ini.</p>
      </div>
    @endif
  </div>
</section>