
<section
  id="about"
  class="bg-light-base text-dark-base dark:bg-dark-base dark:text-light-base section-padding-x py-20 scroll-mt-12 relative"
>
  <div class="max-w-screen-xl mx-auto">
    {{-- Section Header --}}
    <div class="text-center mb-12">
      <span class="gradient-to-r text-light-base from-sipil-base to-sipil-secondary bg-gradient-to-br flex items-center gap-2 mb-2 w-fit py-1 px-3 rounded-md mx-auto">
        <svg
          class="w-4"
          fill="currentColor"
          xmlns="http://www.w.org/2000/svg"
          viewBox="0 0 512 512"
        >
          <path d="M256 0c4.6 0 9.2 1 13.4 2.9L457.7 82.8c22 9.3 38.4 31 38.3 57.2c-.5 99.2-41.3 280.7-213.6 363c-16.7 8-36.1 8-52.8 0C57.3 420.7 16.5 239.2 16 140c-.1-26.2 16.3-47.9 38.3-57.2L242.7 2.9C246.8 1 251.4 0 256 0z" />
        </svg>
        <h2 class="extra-small-font-size">Visi dan Misi</h2>
      </span>
      <h2 class="font-bold">
        Visi dan Misi Laboratorium Teknik Sipil Unsoed
      </h2>
      <p class="max-w-3xl mx-auto">
        Laboratorium bidang Teknik Sipil Universitas Jenderal Soedirman didirikan
        untuk menjawab kebutuhan akan tenaga profesional di bidang teknik
        sipil yang kompeten dan berintegritas.
      </p>
    </div>

    {{-- About Content --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
      {{-- Left Column - Image Carousel --}}
      <div class="relative rounded-lg overflow-hidden h-full">
        @if (!empty($carouselLabs))
          {{-- Kita akan menggunakan library Swiper.js untuk fungsionalitas carousel --}}
          {{-- Pastikan untuk menginstal Swiper.js via npm dan mengimpornya di app.js --}}
          <div class="swiper homepage-about-swiper rounded-lg shadow-lg">
            <div class="swiper-wrapper">
              @foreach($carouselLabs as $lab)
                @php
                  // API kadang mengembalikan string JSON, kadang hanya nama file
                  $images = json_decode($lab['images'], true) ?? [$lab['images']];
                @endphp
                @foreach($images as $image)
                  <div class="swiper-slide">
                    <div class="relative aspect-video">
                      <img
                        src="{{ config('services.api.storage_url') . '/' . $image }}"
                        alt="{{ $lab['name'] }}"
                        class="w-full h-full object-cover"
                        loading="lazy"
                      />
                      <div class="absolute top-4 left-4 bg-sipil-base text-light-base py-1 px-3 rounded-md shadow-md small-font-size font-medium">
                        {{ $lab['name'] }}
                      </div>
                    </div>
                  </div>
                @endforeach
              @endforeach
            </div>
            {{-- Pagination and Navigation buttons for Swiper --}}
            <div class="swiper-pagination"></div>
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
          </div>
        @else
          {{-- Fallback jika API gagal atau tidak ada data --}}
          <div class="rounded-lg shadow-lg w-full h-64 bg-gray-200 flex items-center justify-center">
            <p class="text-gray-500">Data laboratorium tidak tersedia.</p>
          </div>
        @endif
      </div>

      {{-- Right Column - Text Content --}}
      <div class="space-y-6">
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 shadow-sm">
          <h3 class="font-bold mb-3 text-sipil-base dark:text-sipil-blue-accent">
            Visi
          </h3>
          <p class="">
            Menjadi laboratorium Teknik Sipil yang bermutu dan maju untuk
            mendukung kegiatan akademik, penelitian dan industri konstruksi
            sehingga dapat berkontribusi bagi pembangunan bangsa dan negara.
          </p>
        </div>

        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 shadow-sm">
          <h3 class="font-bold mb-3 text-sipil-base dark:text-sipil-blue-accent">
            Misi
          </h3>
          <ul class="list-disc list-outside pl-4 space-y-2">
            <li>Memberikan pelayanan praktikum kepada mahasiswa</li>
            <li>
              Memberikan pelayanan penelitian kepada dosen dan mahasiswa
            </li>
            <li>
              Memberi pelayanan pengujian kepada kontraktor dan konsultan
            </li>
          </ul>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 pt-4">
          <a
            href="{{ route('facilities.index') }}"
            class="rounded-md bg-blue-base text-light-base py-2 px-4 font-semibold text-center hover:bg-blue-quaternary hover:text-blue-base transition duration-300 small-font-size"
          >
            Lihat Fasilitas
          </a>
          <a
            href="{{ route('tests.index') }}"
            class="rounded-md border border-blue-base text-blue-base py-2 px-4 font-semibold text-center hover:bg-blue-quaternary transition duration-300 small-font-size"
          >
            Lihat Pengujian
          </a>
        </div>
      </div>
    </div>
  </div>
</section>