{{--
  File ini membutuhkan variabel $standards yang dikirim dari PageController.
  Variabel ini berisi data standar/sertifikasi yang diambil dari API.
--}}
<section
  id="akreditasi"
  class="section-padding-x pt-12 pb-12 text-dark-base dark:text-light-base bg-light-base dark:bg-dark-base scroll-mt-12"
>
  <div class="mx-auto max-w-screen-xl">
    <div class="text-center mb-8 max-w-3xl mx-auto">
      <p class="px-2 py-0.5 mb-2 rounded-md text-blue-base bg-blue-tertiary font-semibold w-fit mx-auto">
        Akreditasi dan Sertifikasi
      </p>
      <h2 class="font-bold mb-2">
        Laboratorium Teknik Sipil Unsoed Memenuhi Standar Nasional dan
        Internasional
      </h2>
    </div>

    @if (!empty($standards))
      {{--
        Container ini dibuat scrollable secara horizontal pada layar kecil.
        Class `scrollbar-hide` adalah class kustom dari CSS Anda.
      --}}
      <div class="flex flex-nowrap overflow-x-auto gap-4 py-4 scrollbar-hide">
        @foreach($standards as $item)
          <div class="flex-none w-72 bg-white rounded-lg shadow-md border border-gray-200 dark:border-gray-700 dark:bg-gray-800">
            <div class="w-full h-40 rounded-t-lg flex items-center justify-center overflow-hidden p-4 bg-gray-100 dark:bg-gray-700">
              <img
                src="{{ config('services.api.storage_url') . '/' . ($item['foto'] ?? 'images/accreditations/iso-certification.jpg') }}"
                alt="{{ $item['nama'] }}"
                class="object-contain max-h-full"
                loading="lazy"
              />
            </div>
            <div class="p-4">
              <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-1 line-clamp-1">
                {{ $item['nama'] }}
              </h3>
              <p class="text-sm text-gray-600 dark:text-gray-400 mb-2 line-clamp-2 h-10">
                {{ $item['deskripsi'] }}
              </p>
              @if (!empty($item['file']))
                <a
                  href="{{ config('services.api.storage_url') . '/' . $item['file'] }}"
                  class="text-blue-600 dark:text-blue-400 text-sm font-medium flex items-center hover:underline"
                  target="_blank"
                  rel="noopener noreferrer"
                >
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-4 w-4 mr-1"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                  >
                    <path
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"
                    />
                  </svg>
                  Unduh Sertifikat
                </a>
              @endif
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center text-gray-500 py-12">
        <p>Tidak ada data sertifikasi yang tersedia saat ini.</p>
      </div>
    @endif
  </div>
</section>