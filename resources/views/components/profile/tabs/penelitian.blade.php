
<div
  x-data="{
    apiData: null,
    loading: true,
    error: '',
    currentPage: 1,
    itemsPerPage: 8,
    searchTerm: '',
    
    fetchResearch: function() {
      this.loading = true;
      const params = new URLSearchParams({
        page: this.currentPage,
        per_page: this.itemsPerPage,
        search: this.searchTerm.trim()
      });

      fetch(`{{ config('services.api.base_url') }}/research?${params.toString()}`)
        .then(response => {
          if (!response.ok) throw new Error('Gagal memuat data penelitian.');
          return response.json();
        })
        .then(data => {
          this.apiData = data;
          this.error = '';
        })
        .catch(error => {
          this.error = error.message;
          console.error('Fetch research error:', error);
        })
        .finally(() => this.loading = false);
    },

    handlePageChange: function(page) {
        if (page < 1 || page > this.apiData.last_page) return;
        this.currentPage = page;
        this.fetchResearch();
        window.scrollTo({ top: 0, behavior: 'smooth' });
    },

    generatePageNumbers: function() {
        if (!this.apiData) return [];
        const totalPages = this.apiData.last_page;
        const current = this.apiData.current_page;
        let pages = [];
        const maxVisible = 7;

        if (totalPages <= maxVisible) {
            for (let i = 1; i <= totalPages; i++) pages.push(i);
        } else {
            pages.push(1);
            if (current > 4) pages.push('...');
            let start = Math.max(2, current - 2);
            let end = Math.min(totalPages - 1, current + 2);
            for (let i = start; i <= end; i++) pages.push(i);
            if (current < totalPages - 3) pages.push('...');
            pages.push(totalPages);
        }
        return pages;
    },

    formatAuthors: function(authors) {
        if (!authors || authors.length === 0) return 'Tidak ada penulis';
        if (authors.length === 1) return authors[0];
        if (authors.length === 2) return authors.join(' dan ');
        return `${authors.slice(0, -1).join(', ')} dan ${authors[authors.length - 1]}`;
    }
  }"
  x-init="fetchResearch()"
  x-on:input.debounce.500ms="currentPage = 1; fetchResearch()"
>
  <div class="space-y-6">
    {{-- Search Input --}}
    <div class="relative">
      <input
        type="text"
        x-model="searchTerm"
        placeholder="Cari penelitian berdasarkan judul, penulis, atau kata kunci..."
        class="w-full pl-10 pr-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-1 focus:ring-sipil-base bg-white dark:bg-gray-800"
      />
      <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
        </svg>
      </div>
    </div>
    
    {{-- Loading State --}}
    <template x-if="loading">
      <div class="flex justify-center items-center h-64">
        <div class="text-center">
          <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-sipil-base mx-auto mb-4"></div>
          <p class="text-gray-500 dark:text-gray-400">Memuat data penelitian...</p>
        </div>
      </div>
    </template>
  
    {{-- Error State --}}
    <template x-if="error">
      <div class="text-center text-red-500 py-12">
        <p x-text="error"></p>
        <button @click="fetchResearch()" class="mt-4 px-4 py-2 bg-sipil-base text-white rounded-md hover:bg-sipil-secondary">
          Coba Lagi
        </button>
      </div>
    </template>
    
    {{-- Content --}}
    <template x-if="!loading && !error && apiData">
      <div>
        {{-- Research Table --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
          <div class="overflow-x-auto">
            <table class="w-full">
              <thead>
                <tr class="bg-sipil-base text-white">
                  <th class="px-4 py-3 text-left w-12">No</th>
                  <th class="px-4 py-3 text-left">Judul & Penulis</th>
                  <th class="px-4 py-3 text-left">Abstrak</th>
                  <th class="px-4 py-3 text-left">Kata Kunci</th>
                  <th class="px-4 py-3 text-center">Publikasi</th>
                  <th class="px-4 py-3 text-center">Aksi</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                <template x-if="apiData.data.length > 0">
                  <template x-for="(item, index) in apiData.data" :key="item.id">
                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-700">
                      <td class="px-4 py-3 whitespace-nowrap" x-text="apiData.from + index"></td>
                      <td class="px-4 py-3">
                        <div class="font-medium text-sipil-base" x-text="item.title"></div>
                        <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">
                          <div x-text="'Penulis: ' + formatAuthors(item.author)"></div>
                          <div x-text="'Tahun: ' + item.year"></div>
                        </div>
                      </td>
                      <td class="px-4 py-3">
                        <p class="text-gray-600 dark:text-gray-300 line-clamp-3 text-sm" x-text="item.abstract"></p>
                      </td>
                      <td class="px-4 py-3">
                        <div class="flex flex-wrap gap-1">
                          <template x-for="(keyword, idx) in item.keywords" :key="idx">
                            <span class="inline-block px-2 py-1 bg-gray-100 dark:bg-gray-600 text-xs rounded-full" x-text="keyword"></span>
                          </template>
                        </div>
                      </td>
                      <td class="px-4 py-3 text-center">
                        <span class="text-gray-600 dark:text-gray-300 text-sm line-clamp-2" x-text="item.publication"></span>
                      </td>
                      <td class="px-4 py-3 text-center whitespace-nowrap">
                        <a :href="item.link" class="inline-flex items-center gap-1 bg-sipil-base text-white py-2 px-4 rounded-md hover:bg-sipil-secondary transition-colors duration-200" target="_blank" rel="noopener noreferrer">
                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                          Lihat
                        </a>
                      </td>
                    </tr>
                  </template>
                </template>
                <template x-if="apiData.data.length === 0">
                    <tr>
                      <td colSpan="6" class="px-6 py-12 text-center">
                        <p class="text-gray-500">Tidak ada penelitian yang ditemukan.</p>
                      </td>
                    </tr>
                </template>
              </tbody>
            </table>
          </div>

          {{-- Pagination --}}
          <template x-if="apiData.last_page > 1">
            <div class="px-6 py-3 bg-gray-50 dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
              <button @click="handlePageChange(currentPage - 1)" :disabled="currentPage === 1" class="px-4 py-2 text-sm bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Sebelumnya
              </button>
              <div class="hidden md:flex items-center gap-1">
                <template x-for="(page, index) in generatePageNumbers()" :key="index">
                  <button
                    @click="typeof page === 'number' && handlePageChange(page)"
                    :disabled="page === '...'"
                    :class="{
                      'bg-sipil-base text-white': currentPage === page,
                      'cursor-default': page === '...',
                      'bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 hover:bg-gray-50': currentPage !== page && page !== '...'
                    }"
                    class="px-3 py-1 text-sm rounded-md"
                    x-text="page"
                  ></button>
                </template>
              </div>
              <button @click="handlePageChange(currentPage + 1)" :disabled="currentPage === apiData.last_page" class="px-4 py-2 text-sm bg-white dark:bg-gray-600 border border-gray-300 dark:border-gray-500 rounded-md hover:bg-gray-50 disabled:opacity-50 disabled:cursor-not-allowed">
                Selanjutnya
              </button>
            </div>
          </template>
        </div>
        
        <div class="text-center text-sm text-gray-600 dark:text-gray-400 mt-4">
          Menampilkan <span x-text="apiData.from || 0"></span> - <span x-text="apiData.to || 0"></span> dari <span x-text="apiData.total || 0"></span> penelitian
        </div>
      </div>
    </template>
  </div>
</div>