@php
  // Helper function untuk mengekstrak ID video dari berbagai format URL YouTube.
  function getYoutubeId($url) {
      preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $url, $match);
      return $match[1] ?? null;
  }
@endphp

<section
  id="hero"
  class="bg-light-base text-dark-base dark:bg-dark-base dark:text-light-base section-padding-x pt-24 lg:pt-32 pb-12 scroll-mt-12"
>
  <div class="max-w-screen-xl mx-auto flex gap-8 flex-col xl:flex-row justify-between items-center relative">
    
    {{-- Kiri --}}
    <div class="xl:w-1/2 flex-shrink-0">
      <div class="text-dark-base dark:text-light-base rounded-lg mb-4">
        <span class="gradient-to-r text-light-base from-sipil-base to-sipil-secondary bg-gradient-to-br flex items-center gap-2 mb-2 w-fit py-1 px-3 rounded-md">
          <p class="extra-small-font-size">Laboratorium Teknik Sipil Unsoed</p>
        </span>
        <h1 class="font-bold mb-2 md:text-left">
          Membangun Masa Depan Infrastruktur yang Berkelanjutan
        </h1>
        <p class="mb-4 text-justify">
          Laboratorium Teknik Sipil Unsoed berfungsi sebagai pusat
          pembelajaran praktis dan eksperimental yang dipergunakan oleh
          civitas akademika dan pelayanan untuk mitra dari
          luar Laboratorium Teknik Sipil Unsoed yang mencakup &nbsp;
          <span class="text-dark-1000 font-bold">bidang Struktur dan Bahan Bangunan, Mekanika Tanah dan Hidraulika,
          Transportasi, Mekanika Keairan dan Teknik Lingkungan.</span>
        </p>
        <div class="flex flex-wrap gap-2">
          <a href="https://reservasi.labsipilunsoed.com/" target="_blank" rel="noopener noreferrer" class="rounded-md bg-blue-base text-light-base py-2 px-4 font-semibold hover:bg-blue-quaternary hover:text-blue-base transition duration-300 small-font-size">
            Reservasi Laboratorium
          </a>
        </div>
      </div>
    </div>
    
    {{-- Carousel --}}
    <div class="xl:w-1/2 w-full">
      <div class="swiper homepage-hero-swiper rounded-lg shadow-2xl">
        <div class="swiper-wrapper">
          
          {{-- Gambar Lab --}}
          <div class="swiper-slide">
            <div class="aspect-video bg-black">
              <img
                src="{{ asset('images/backgrounds/gedung-lab.jpg') }}"
                alt="Gedung D Laboratorium Fakultas Teknik Unsoed"
                class="w-full h-full object-cover"
              />
            </div>
          </div>

          {{-- Embed Youtube --}}
          @foreach ($youtubeLinks as $link)
            @php
              $videoId = getYoutubeId($link['link']);
            @endphp
            @if ($videoId)
              <div class="swiper-slide" x-data="{ showPlayer: false }">
                <div class="relative aspect-video bg-black cursor-pointer" @click="showPlayer = true; $dispatch('stopHeroCarousel')">
                  <div x-show="!showPlayer" class="w-full h-full">
                    <img src="https://img.youtube.com/vi/{{ $videoId }}/default.jpg" alt="{{ $link['title'] ?? 'Video Youtube' }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-40">
                      <div class="w-16 h-16 bg-red-600/80 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <svg class="w-8 h-8 text-white ml-1" viewBox="0 0 24 24" fill="currentColor"><path d="M8 5v14l11-7z"></path></svg>
                      </div>
                    </div>
                  </div>
                  {{-- Tampilan Iframe Player (terlihat setelah thumbnail diklik) --}}
                  <div x-show="showPlayer" x-cloak class="w-full h-full">
                    <iframe 
                      class="w-full h-full"
                      src="https://www.youtube.com/embed/{{ $videoId }}?autoplay=1" 
                      frameborder="0" 
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                      allowfullscreen>
                    </iframe>
                  </div>
                </div>
              </div>
            @endif
          @endforeach

        </div>
        {{-- Tombol Navigasi dan Paginasi Swiper --}}
        <div class="swiper-button-next text-white"></div>
        <div class="swiper-button-prev text-white"></div>
        <div class="swiper-pagination"></div>
      </div>
    </div>

  </div>
</section>