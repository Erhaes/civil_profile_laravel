{{--
  Halaman Detail Fasilitas (Versi Baru: Fokus pada Peralatan)
--}}
@extends('layouts.app')

@section('title', ($facility['name'] ?? 'Detail Fasilitas') . ' | Lab. Teknik Sipil Unsoed')
@section('description', $facility['description'] ?? 'Peralatan dan detail fasilitas yang tersedia di Laboratorium Teknik Sipil Unsoed.')

@section('content')

  @if ($facility)
    @php
      // Pastikan 'images' dan 'equipments' selalu berupa array
      $labImages = is_array($facility['images']) ? $facility['images'] : [$facility['images']];
      $mainImage = $labImages[0] ?? null;
      $equipments = $facility['equipments'] ?? [];
    @endphp

    {{-- Header Section: Informasi Utama Laboratorium --}}
    <section class="bg-sipil-base text-light-base section-padding-x pt-28 pb-16">
      <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-col md:flex-row gap-8 md:gap-12 items-center">
          
          {{-- Gambar Laboratorium --}}
          <div class="md:w-5/12 flex-shrink-0">
            <div class="relative w-full aspect-w-4 aspect-h-3 overflow-hidden rounded-lg shadow-lg">
              @if($mainImage)
                <img
                  src="{{ config('services.api.storage_url') }}/{{ $mainImage }}"
                  alt="{{ $facility['name'] }}"
                  class="object-cover w-full h-full"
                />
              @else
                <div class="bg-gray-700 w-full h-full flex items-center justify-center">
                  <span class="text-gray-400">Gambar tidak tersedia</span>
                </div>
              @endif
            </div>
          </div>

          {{-- Detail Laboratorium --}}
          <div class="md:w-7/12">
            <div class="mb-4">
              <a href="{{ route('facilities.index') }}" class="text-blue-300 hover:text-white flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Daftar Fasilitas
              </a>
            </div>
            <span class="inline-block px-3 py-1 text-xs font-medium bg-blue-500 bg-opacity-20 text-blue-100 rounded-full mb-3">
              {{ $facility['code'] }}
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-3">{{ $facility['name'] }}</h1>
            <div class="flex items-center text-sm mb-4 text-blue-200">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
              <span>Lokasi: Ruang {{ $facility['room'] }}</span>
            </div>
            <p class="text-light-base/80 leading-relaxed">
              {{ $facility['description'] }}
            </p>
          </div>

        </div>
      </div>
    </section>

    {{-- Main Content: Daftar Peralatan --}}
    <section class="bg-gray-50 dark:bg-gray-900 section-padding-x py-16">
      <div class="max-w-screen-xl mx-auto">
        <div class="text-center mb-10">
          <h2 class="text-3xl font-bold text-dark-base dark:text-gray-100">Peralatan Laboratorium</h2>
          <p class="text-gray-600 dark:text-gray-400 mt-2 max-w-2xl mx-auto">
            Daftar peralatan yang tersedia di {{ $facility['name'] }} untuk mendukung kegiatan praktikum dan penelitian.
          </p>
        </div>

        @if (!empty($equipments))
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($equipments as $equipment)
              <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden flex flex-col group">
                <div class="relative aspect-w-16 aspect-h-9 overflow-hidden">
                  @if($equipment['image'])
                    <img 
                      src="{{ config('services.api.storage_url') }}/{{ $equipment['image'] }}" 
                      alt="{{ $equipment['name'] }}" 
                      class="object-cover w-full h-full group-hover:scale-105 transition-transform duration-300"
                    />
                  @else
                    <div class="bg-gray-200 w-full h-full flex items-center justify-center">
                        <span class="text-gray-500 text-sm">Gambar tidak tersedia</span>
                    </div>
                  @endif
                </div>
                <div class="p-5 flex-grow flex flex-col">
                  <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                    {{ $equipment['name'] }}
                  </h3>
                  <p class="text-gray-600 dark:text-gray-400 mt-2 text-sm flex-grow">
                    {{ $equipment['description'] }}
                  </p>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-12 bg-white dark:bg-gray-800 rounded-lg shadow-sm">
            <p class="text-gray-500">Belum ada data peralatan untuk laboratorium ini.</p>
          </div>
        @endif
      </div>
    </section>
    
  @else
    {{-- Tampilan jika fasilitas tidak ditemukan --}}
    <section class="py-28 section-padding-x">
      <div class="max-w-screen-xl mx-auto">
        <div class="text-center py-12">
          <h1 class="text-2xl font-bold mb-4">Fasilitas Tidak Ditemukan</h1>
          <p class="text-gray-600 mb-6">Maaf, fasilitas yang Anda cari tidak dapat ditemukan.</p>
          <a href="{{ route('facilities.index') }}" class="inline-block px-4 py-2 bg-sipil-base text-white rounded-md hover:bg-sipil-secondary">
            Kembali ke Daftar Fasilitas
          </a>
        </div>
      </div>
    </section>
  @endif

@endsection