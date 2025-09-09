{{--
  File ini membutuhkan variabel $reviews yang dikirim dari PageController.
  Logika animasi scrolling akan ditambahkan di file JavaScript terpisah.
--}}
<section
  id="testimoni"
  class="section-padding-x pt-12 pb-12 dark:text-light-base text-light-base bg-dark-base lg:min-h-[512px] overflow-hidden scroll-mt-12"
>
  <div class="mx-auto max-w-screen-xl flex flex-col lg:flex-row justify-between gap-8">
    <div class="max-w-xl">
      <p class="text-sipil-base">Testimoni Pengujian</p>
      <h2 class="font-bold mb-2">
        Apa Kata Mereka?
      </h2>
      <p class="text-gray-500 dark:text-gray-300 mb-4">
        Laboratorium Teknik Sipil Unsoed selalu berupaya memberikan hasil pengujian yang akurat dan didukung tim ahli yang siap menjadi mitra kesuksesan teknis Anda.
      </p>
      <a
        href="https://reservasi.labsipilunsoed.com/"
        target="_blank"
        rel="noopener noreferrer"
        class="text-light-base gradient-to-r from-sipil-base to-sipil-secondary bg-gradient-to-br px-4 py-2 md:px-6 md:py-3 rounded-xl font-semibold small-font-size"
      >
        Reservasi Sekarang Juga!
      </a>
    </div>

    @if (!empty($reviews))
      @php
        // Bagi array reviews menjadi dua kolom
        $midpoint = (int) ceil(count($reviews) / 2);
        $reviews1 = array_slice($reviews, 0, $midpoint);
        $reviews2 = array_slice($reviews, $midpoint);
      @endphp
      <div id="testimonial-container" class="flex flex-col lg:flex-row gap-4 lg:max-h-[400px] w-full overflow-hidden">
        {{-- Kolom Pertama --}}
        <div class="testimonial-column flex flex-row lg:flex-col gap-4 w-full lg:w-auto" data-direction="up">
            @foreach($reviews1 as $review)
                @include('components.homepage.testimonial-card', ['review' => $review])
            @endforeach
        </div>
        {{-- Kolom Kedua --}}
        <div class="testimonial-column flex flex-row lg:flex-col gap-4 w-full lg:w-auto" data-direction="down">
            @foreach($reviews2 as $review)
                @include('components.homepage.testimonial-card', ['review' => $review])
            @endforeach
        </div>
      </div>
    @else
      <div class="flex-grow flex items-center justify-center text-center text-gray-500">
        <p>Tidak ada testimonial yang tersedia saat ini.</p>
      </div>
    @endif
  </div>
</section>