<div
  x-data="{
    groupedTeams: {},
    loading: true,
    error: '',
    fetchGroupedTeam: function() {
      this.loading = true;
      fetch('{{ route('api.team-data') }}')
        .then(response => {
            if (!response.ok) throw new Error('Gagal memuat data pejabat struktural.');
            return response.json();
        })
        .then(data => {
            this.groupedTeams = data.grouped_teams;
            this.error = '';
        })
        .catch(error => { this.error = error.message; })
        .finally(() => { this.loading = false; });
    }
  }"
  x-init="fetchGroupedTeam()"
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
    <div class="space-y-8">
      <template x-for="(members, hierarchy) in groupedTeams" :key="hierarchy">
        <div class="w-full">
          <div class="flex flex-wrap justify-center gap-4">
            <template x-for="pejabat in members" :key="pejabat.id">
              <div class="w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5">
                  <div class="bg-white dark:bg-gray-800 border dark:border-gray-700 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow h-full flex flex-col">
                    <div class="aspect-square bg-gray-200 dark:bg-gray-700">
                      <img 
                        :src="pejabat.photo ? '{{ config('services.api.storage_url') }}/' + pejabat.photo : '{{ asset('images/staff/placeholder-profile.jpg') }}'" 
                        :alt="'Foto ' + pejabat.name" 
                        class="w-full h-full object-cover" 
                        loading="lazy"
                      />
                    </div>
                    <div class="p-3 text-center flex-grow flex flex-col justify-center">
                      <h4 class="font-semibold text-base text-gray-800 dark:text-gray-200 line-clamp-1" x-text="pejabat.name"></h4>
                      <p class="text-sm text-sipil-base dark:text-sipil-blue-accent line-clamp-1" x-text="pejabat.position.name"></p>
                    </div>
                  </div>
              </div>
            </template>
          </div>
        </div>
      </template>
    </div>
  </template>
</div>