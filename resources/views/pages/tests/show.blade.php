{{--
  Halaman Detail Pengujian.
--}}
@extends('layouts.app')

{{-- Judul dan deskripsi dinamis berdasarkan data pengujian --}}
@section('title', ($test['name'] ?? 'Detail Pengujian') . ' | Lab. Teknik Sipil Unsoed')
@section('description', Str::limit($test['description'] ?? 'Detail layanan pengujian yang tersedia di Laboratorium Teknik Sipil Unsoed.', 160))

@section('content')
  
  <div x-data="{ imageIndex: 0 }">
    @if ($test)
      {{-- Header Section --}}
      <section class="bg-sipil-base text-light-base section-padding-x pt-28 pb-12">
        <div class="max-w-screen-xl mx-auto">
          <div class="flex flex-col md:flex-row gap-8">
            {{-- Test Image Gallery --}}
            <div class="md:w-1/2">
              <div class="relative w-full h-72 md:h-96 lg:h-[480px] overflow-hidden rounded-lg">
                <template x-for="(image, index) in @json($test['images'])" :key="index">
                  <img 
                    x-show="imageIndex === index" 
                    :src="'{{ config('services.api.storage_url') }}/' + image" 
                    alt="{{ $test['name'] }}" 
                    class="w-full h-full object-cover"
                    x-cloak
                  />
                </template>
                <div class="absolute top-4 right-4">
                  @if ($test['is_active'])
                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-sm font-medium">Tersedia</span>
                  @else
                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-medium">Tidak Tersedia</span>
                  @endif
                </div>
                <div class="absolute bottom-4 left-4">
                  <span class="bg-black/70 text-white px-3 py-1 rounded-full text-sm font-medium">
                    Rp {{ number_format($test['price'], 0, ',', '.') }}
                  </span>
                </div>
              </div>

              {{-- Thumbnail Gallery --}}
              @if (count($test['images']) > 1)
                <div class="flex mt-4 gap-2 overflow-x-auto pb-2">
                  @foreach($test['images'] as $index => $imagePath)
                    <div
                      @click="imageIndex = {{ $index }}"
                      :class="{ 'border-blue-300': imageIndex === {{ $index }}, 'border-gray-300 hover:border-blue-200': imageIndex !== {{ $index }} }"
                      class="relative w-20 h-20 flex-shrink-0 rounded-md overflow-hidden border-2 cursor-pointer transition-all"
                    >
                      <img src="{{ config('services.api.storage_url') }}/{{ $imagePath }}" alt="{{ $test['name'] }} - gambar {{ $index + 1 }}" class="w-full h-full object-cover" />
                    </div>
                  @endforeach
                </div>
              @endif
            </div>

            {{-- Test Information --}}
            <div class="md:w-1/2">
              <a href="{{ route('tests.index') }}" class="text-blue-300 hover:text-white flex items-center text-sm mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar Pengujian
              </a>
              <h1 class="text-3xl font-bold mb-2">{{ $test['name'] }}</h1>
              <div class="mb-4">
                <span class="inline-block bg-blue-600 text-white px-3 py-1 rounded-full text-xs font-medium">{{ $test['category']['name'] }}</span>
              </div>
              <p class="text-light-base/80 mb-6 leading-relaxed">{{ $test['description'] }}</p>
              <div class="space-y-4">
                <div class="flex items-center"><svg class="w-5 h-5 mr-3 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg><div><p class="text-sm text-blue-300">Laboratorium</p><p class="font-medium">{{ $test['laboratory']['name'] }}</p></div></div>
                <div class="flex items-center"><svg class="w-5 h-5 mr-3 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1" /></svg><div><p class="text-sm text-blue-300">Harga</p><p class="font-medium text-lg">Rp {{ number_format($test['price'], 0, ',', '.') }}</p></div></div>
                <div class="flex items-center"><svg class="w-5 h-5 mr-3 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg><div><p class="text-sm text-blue-300">Minimum Pengujian</p><p class="font-medium">{{ $test['minimum_unit'] }} Sampel</p></div></div>
                <div class="flex items-center"><svg class="w-5 h-5 mr-3 text-blue-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg><div><p class="text-sm text-blue-300">Kapasitas Harian</p><p class="font-medium">{{ $test['daily_slot'] }} Slot</p></div></div>
              </div>
            </div>
          </div>
        </div>
      </section>

      {{-- Packages Section --}}
      @if (!empty($test['packages']))
        <section class="py-16 bg-light-base text-dark-base section-padding-x">
          <div class="max-w-screen-xl mx-auto">
            <h2 class="text-2xl font-bold mb-8">Paket Pengujian Terkait</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              @foreach ($test['packages'] as $pkg)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                  <div class="relative h-48"><img src="{{ config('services.api.storage_url') }}/{{ $pkg['images'][0] ?? '' }}" alt="{{ $pkg['name'] }}" class="object-cover w-full h-full" /><div class="absolute bottom-2 right-2"><span class="bg-black/70 text-white px-2 py-1 rounded text-sm">Rp {{ number_format($pkg['price'], 0, ',', '.') }}</span></div></div>
                  <div class="p-4"><h3 class="font-bold text-lg mb-2">{{ $pkg['name'] }}</h3><p class="text-gray-600 text-sm mb-4 line-clamp-2">{{ $pkg['description'] }}</p></div>
                </div>
              @endforeach
            </div>
          </div>
        </section>
      @endif

    @else
      {{-- Tampilan jika pengujian tidak ditemukan --}}
      <section class="py-28 section-padding-x">
        <div class="max-w-screen-xl mx-auto">
          <div class="text-center py-12">
            <h1 class="text-2xl font-bold mb-4">Pengujian Tidak Ditemukan</h1>
            <p class="text-gray-600 mb-6">Maaf, pengujian yang Anda cari tidak dapat ditemukan.</p>
            <a href="{{ route('tests.index') }}" class="inline-block px-4 py-2 bg-sipil-base text-white rounded-md hover:bg-sipil-secondary">
              Kembali ke Daftar Pengujian
            </a>
          </div>
        </div>
      </section>
    @endif
  </div>
@endsection

@push('scripts')
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush