{{--
  Versi E-commerce: Tanpa penggandaan data, tanpa animasi.
--}}
<section
  id="testimoni"
  class="section-padding-x pt-12 pb-12 dark:text-light-base text-light-base bg-dark-base"
>
  <div class="mx-auto max-w-screen-xl">
    <div class="flex flex-col lg:flex-row justify-between gap-8">
      <div class="max-w-xl flex-shrink-0">
        <p class="text-sipil-base">Testimoni Pengujian</p>
        <h2 class="font-bold mb-2">Apa Kata Mereka?</h2>
        <p class="text-gray-500 dark:text-gray-300 mb-4">
          Laboratorium Teknik Sipil Unsoed selalu berupaya memberikan hasil pengujian yang akurat dan didukung tim ahli yang siap menjadi mitra kesuksesan teknis Anda.
        </p>
        <a href="https://reservasi.labsipilunsoed.com/" target="_blank" rel="noopener noreferrer" class="text-light-base gradient-to-r from-sipil-base to-sipil-secondary bg-gradient-to-br px-4 py-2 md:px-6 md:py-3 rounded-xl font-semibold small-font-size">
          Reservasi Sekarang Juga!
        </a>
      </div>

      {{-- **PERBAIKAN UTAMA: Menggunakan Grid untuk scrolling horizontal yang lebih andal --}}
      <div class="w-full lg:w-auto overflow-hidden">
        @if (!empty($reviews))
          <div class="grid grid-flow-col auto-cols-max lg:grid-flow-row lg:auto-rows-max grid-rows-1 lg:grid-cols-2 gap-4 pb-4 overflow-x-auto scrollbar-hide">
            @foreach($reviews as $review)
              @include('components.homepage.testimonial-card', ['review' => $review])
            @endforeach
          </div>
        @else
          <div class="flex-grow flex items-center justify-center text-center text-gray-500 h-full">
            <p>Tidak ada testimonial yang tersedia saat ini.</p>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>