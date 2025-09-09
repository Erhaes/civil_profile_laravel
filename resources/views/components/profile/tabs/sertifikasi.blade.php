{{--
  Konten untuk tab Standar Laboratorium (Sertifikasi).
  Sama seperti tab struktur, ini menggunakan Alpine.js untuk mengambil
  data secara dinamis saat tab ini aktif.
--}}
<div
  x-data="{
    standards: [],
    loading: true,
    error: '',
    fetchStandards: function() {
      this.loading = true;
      fetch('{{ config('services.api.base_url') }}/standards')
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal memuat data standar laboratorium.');
            }
            return response.json();
        })
        .then(data => {
            this.standards = data.data;
            this.error = '';
        })
        .catch(error => {
            this.error = error.message;
            console.error('Fetch standards error:', error);
        })
        .finally(() => {
            this.loading = false;
        });
    }
  }"
  x-init="fetchStandards()"
>
  {{-- Loading State --}}
  <template x-if="loading">
    <div class="flex justify-center items-center h-64">
      <div class="text-center">
        <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-sipil-base mx-auto mb-4"></div>
        <p class="text-gray-500 dark:text-gray-400">Memuat data standar laboratorium...</p>
      </div>
    </div>
  </template>

  {{-- Error State --}}
  <template x-if="error">
    <div class="text-center text-red-500 py-12">
      <p x-text="error"></p>
      <button @click="fetchStandards()" class="mt-4 px-4 py-2 bg-sipil-base text-white rounded-md hover:bg-sipil-secondary">
        Coba Lagi
      </button>
    </div>
  </template>

  {{-- Content --}}
  <template x-if="!loading && !error">
    <div x-show="standards.length > 0" class="grid grid-cols-1 md:grid-cols-2 gap-6">
      <template x-for="standard in standards" :key="standard.id">
        <div class="flex bg-gray-50 dark:bg-gray-800 rounded-lg overflow-hidden shadow-sm p-4">
          <div class="w-16 h-16 bg-white rounded-md flex-shrink-0 flex items-center justify-center border dark:border-gray-700 overflow-hidden">
            <img 
              :src="standard.foto ? '{{ config('services.api.storage_url') }}/' + standard.foto : '{{ asset('images/accreditations/iso-certification.jpg') }}'" 
              :alt="standard.nama" 
              class="w-full h-full object-cover"
              loading="lazy"
            />
          </div>
          <div class="ml-4 flex-1">
            <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200" x-text="standard.nama"></h3>
            <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm" x-text="standard.deskripsi"></p>
            <template x-if="standard.file">
              <a
                :href="'{{ config('services.api.storage_url') }}/' + standard.file"
                class="inline-flex items-center mt-3 text-sipil-base dark:text-blue-400 text-sm font-medium hover:text-sipil-secondary dark:hover:text-blue-300"
                target="_blank"
                rel="noopener noreferrer"
              >
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                Unduh Dokumen
              </a>
            </template>
          </div>
        </div>
      </template>
    </div>
  </template>

  {{-- Empty State --}}
  <template x-if="!loading && !error && standards.length === 0">
    <div class="text-center text-gray-500 py-12">
        <p>Tidak ada data standar laboratorium yang tersedia.</p>
    </div>
  </template>
</div>