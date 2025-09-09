
@php
  $newsItems = $apiData['data'] ?? [];

  // Helper function untuk membersihkan HTML
  function stripHtml($html) {
      return strip_tags($html);
  }

  // Helper function untuk memformat tanggal
  function formatDate($dateString) {
      return \Carbon\Carbon::parse($dateString)->translatedFormat('j F Y');
  }

  // Helper function untuk mendapatkan URL gambar
  function getImageUrl($path) {
      if (!$path) return asset('images/news/eco-construction.jpg'); // Fallback image
      return config('services.api.storage_url') . '/' . $path;
  }
@endphp

<section class="bg-light-base dark:bg-dark-base text-dark-base dark:text-light-base section-padding-x py-16">
  <div class="max-w-screen-xl mx-auto">
    
    {{-- Tampilkan pesan error jika ada --}}
    @if (!empty($apiData['error']))
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-center">
        <p>{{ $apiData['error'] }} (Status: {{ $apiData['status'] }})</p>
      </div>
    @endif

    {{-- Tampilkan grid berita jika tidak ada error dan data tersedia --}}
    @if (empty($apiData['error']) && !empty($newsItems))
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach ($newsItems as $item)
          <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-shadow h-full flex flex-col">
            <div class="relative">
              <a href="{{ route('news.show', ['slug' => $item['slug']]) }}">
                <img
                  src="{{ getImageUrl($item['thumbnail']) }}"
                  alt="{{ $item['title'] }}"
                  class="object-cover w-full h-48"
                  loading="lazy"
                />
              </a>
              <div class="absolute top-2 left-2">
                <span class="bg-sipil-base text-white text-xs px-3 py-1 rounded-full">
                  {{ $item['news_category']['name'] }}
                </span>
              </div>
            </div>
            <div class="p-5 flex-grow flex flex-col">
              <div class="flex items-center mb-3 text-sm text-gray-500 dark:text-gray-400">
                <span>{{ formatDate($item['created_at']) }}</span>
              </div>
              <a href="{{ route('news.show', ['slug' => $item['slug']]) }}" class="block mb-2">
                <h3 class="text-lg font-bold text-sipil-base dark:text-sipil-blue-accent mb-2 line-clamp-2">
                  {{ $item['title'] }}
                </h3>
              </a>
              <p class="text-gray-600 dark:text-gray-400 mb-4 flex-grow text-sm line-clamp-2">
                {{ stripHtml($item['content']) }}
              </p>
              <a
                href="{{ route('news.show', ['slug' => $item['slug']]) }}"
                class="inline-flex items-center text-sipil-base dark:text-blue-400 font-medium hover:underline mt-auto"
              >
                Baca Selengkapnya
                <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
              </a>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Render komponen paginasi --}}
      @include('components.partials.pagination', ['paginator' => $apiData])

    {{-- Tampilkan pesan jika data kosong --}}
    @elseif (empty($apiData['error']))
      <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
        <p class="text-gray-500">Tidak ada berita yang tersedia saat ini.</p>
      </div>
    @endif
  </div>
</section>