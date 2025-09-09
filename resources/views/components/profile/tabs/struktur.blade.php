
<div
  x-data="{
    team: [],
    loading: true,
    error: '',
    fetchTeam: function() {
      this.loading = true;
      fetch('{{ config('services.api.base_url') }}/team')
        .then(response => {
            if (!response.ok) {
                throw new Error('Gagal memuat data pejabat struktural.');
            }
            return response.json();
        })
        .then(data => {
            this.team = data.data;
            this.error = '';
        })
        .catch(error => {
            this.error = error.message;
            console.error('Fetch team error:', error);
        })
        .finally(() => {
            this.loading = false;
        });
    }
  }"
  x-init="fetchTeam()"
>
  <div class="mb-8">
    <div class="bg-gray-100 dark:bg-gray-800 p-4 rounded flex justify-center">
      <div class="w-full max-w-3xl h-auto bg-white border rounded-lg flex items-center justify-center">
        <img src="{{ asset('images/staff/struktur-organisasi.png') }}" class="w-full h-full" alt="Struktur Organisasi Laboratorium Teknik Sipil Unsoed" />
      </div>
    </div>
  </div>

  <h3 class="text-xl font-semibold mb-4 text-gray-700 dark:text-gray-200">
    Pejabat Struktural
  </h3>

  {{-- Loading State --}}
  <template x-if="loading">
    <p class="text-gray-500 dark:text-gray-400">Memuat data pejabat...</p>
  </template>

  {{-- Error State --}}
  <template x-if="error">
    <p class="text-red-500" x-text="error"></p>
  </template>
  
  {{-- Content --}}
  <template x-if="!loading && !error">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <template x-for="pejabat in team" :key="pejabat.id">
        <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
          <div class="aspect-square bg-gray-200 dark:bg-gray-700">
            <img 
              :src="pejabat.photo ? '{{ config('services.api.storage_url') }}/' + pejabat.photo : '{{ asset('images/staff/placeholder-profile.jpg') }}'" 
              :alt="'Foto ' + pejabat.name" 
              class="w-full h-full object-cover" 
              loading="lazy"
            />
          </div>
          <div class="p-4">
            <h4 class="font-semibold text-lg text-gray-800 dark:text-gray-200" x-text="pejabat.name"></h4>
            <p class="text-sipil-base" x-text="pejabat.position.name"></p>
          </div>
        </div>
      </template>
    </div>
  </template>
</div>