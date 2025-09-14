<section class="py-16 bg-light-base dark:bg-dark-base text-dark-base dark:text-light-base section-padding-x">
  <div class="max-w-screen-xl mx-auto">
    
    {{-- Tampilkan pesan error jika ada --}}
    @if (!empty($downloads['error']))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
        <p>{{ $downloads['error'] }} (Status: {{ $downloads['status'] }})</p>
      </div>
    @endif

    {{-- Tampilkan tabel jika tidak ada error dan data tersedia --}}
    @if (empty($downloads['error']) && !empty($downloads))
      <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden extra-small-font-size">
        <div class="overflow-x-auto">
          <table class="w-full">
            <thead>
              <tr class="bg-sipil-base text-white">
                <th class="px-4 py-2 md:px-6 md:py-3 text-left w-12">No</th>
                <th class="px-4 py-2 md:px-6 md:py-3 text-left">Judul</th>
                <th class="px-4 py-2 md:px-6 md:py-3 text-left">Keterangan</th>
                <th class="px-4 py-2 md:px-6 md:py-3 text-center">Aksi</th>
              </tr>
            </thead>
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
              @foreach ($downloads as $index => $download)
                <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                  <td class="px-4 py-2 md:px-6 md:py-3 whitespace-nowrap">
                    {{ $downloads['from'] + $index+1 }}
                  </td>
                  <td class="px-4 py-2 md:px-6 md:py-3">
                    <div class="font-medium text-sipil-base dark:text-sipil-blue-accent">
                      {{ $download['title'] }}
                    </div>
                    <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                      Tanggal: {{ \Carbon\Carbon::parse($download['created_at'])->translatedFormat('j F Y') }}
                    </div>
                  </td>
                  <td class="px-4 py-2 md:px-6 md:py-3">
                    <p class="text-gray-600 dark:text-gray-400 line-clamp-2 extra-small-font-size">
                      {{ $download['description'] }}
                    </p>
                  </td>
                  <td class="px-4 py-2 md:px-6 md:py-3 text-center whitespace-nowrap">
                    <a
                      href="{{ config('services.api.storage_url') }}/{{ $download['file'] }}"
                      class="inline-flex items-center gap-1 bg-sipil-base text-white py-2 px-4 rounded-md hover:bg-sipil-secondary transition-colors duration-200"
                      download
                      target="_blank"
                    >
                      <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 512 512"><path d="M288 32c0-17.7-14.3-32-32-32s-32 14.3-32 32V274.7l-73.4-73.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3l128 128c12.5 12.5 32.8 12.5 45.3 0l128-128c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L288 274.7V32zM64 352c-35.3 0-64 28.7-64 64v32c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V416c0-35.3-28.7-64-64-64H346.5l-45.3 45.3c-25 25-65.5 25-90.5 0L165.5 352H64z" /></svg>
                      Unduh
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

        {{-- Render komponen paginasi --}}
        <div class="mt-8">
          {{ $downloads->links() }}
        </div>
      </div>

    {{-- Tampilkan pesan jika data kosong --}}
    @elseif (empty($downloads['error']))
      <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <p class="text-gray-500">Tidak ada dokumen yang tersedia untuk diunduh saat ini.</p>
      </div>
    @endif
  </div>
</section>