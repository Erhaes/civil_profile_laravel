<section class="py-8 bg-light-base text-dark-base dark:bg-dark-base dark:text-light-base section-padding-x">
  <div class="max-w-screen-xl mx-auto">
    {{--
      Sistem Tab ini akan dikontrol oleh JavaScript (misalnya, Alpine.js)
      untuk menangani perpindahan antar tab tanpa me-reload halaman.
      Untuk implementasi Laravel murni, kita akan memuat data untuk tab pertama
      secara default. Data untuk tab lain akan diambil via AJAX.
    --}}
    <div x-data="{ activeTab: 'struktur' }">
      {{-- Navigasi Tab --}}
      <div class="flex overflow-x-auto scrollbar-hide py-2 space-x-4 mb-8 border-b border-gray-200 dark:border-gray-700">
        <button
          @click="activeTab = 'struktur'"
          :class="{ 'border-sipil-base text-sipil-base': activeTab === 'struktur', 'border-transparent text-gray-500 hover:text-gray-700': activeTab !== 'struktur' }"
          class="py-2 px-4 font-medium border-b-2 transition-colors whitespace-nowrap"
        >
          Struktur Organisasi
        </button>
        <button
          @click="activeTab = 'penelitian'"
          :class="{ 'border-sipil-base text-sipil-base': activeTab === 'penelitian', 'border-transparent text-gray-500 hover:text-gray-700': activeTab !== 'penelitian' }"
          class="py-2 px-4 font-medium border-b-2 transition-colors whitespace-nowrap"
        >
          Penelitian
        </button>
        <button
          @click="activeTab = 'sertifikasi'"
          :class="{ 'border-sipil-base text-sipil-base': activeTab === 'sertifikasi', 'border-transparent text-gray-500 hover:text-gray-700': activeTab !== 'sertifikasi' }"
          class="py-2 px-4 font-medium border-b-2 transition-colors whitespace-nowrap"
        >
          Standar Laboratorium
        </button>
      </div>

      {{-- Konten Tab --}}
      <div class="bg-white dark:bg-gray-900 p-2 md:p-4 rounded-lg">
        {{-- 1. Konten Tab Struktur Organisasi --}}
        <div x-show="activeTab === 'struktur'" x-cloak>
          @include('components.profile.tabs.struktur')
        </div>

        {{-- 2. Konten Tab Penelitian --}}
        <div x-show="activeTab === 'penelitian'" x-cloak>
          @include('components.profile.tabs.penelitian')
        </div>

        {{-- 3. Konten Tab Standar Laboratorium (Sertifikasi) --}}
        <div x-show="activeTab === 'sertifikasi'" x-cloak>
          @include('components.profile.tabs.sertifikasi')
        </div>
      </div>
    </div>
  </div>
</section>