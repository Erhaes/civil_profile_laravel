{{--
  Halaman Detail Fasilitas.
--}}
@extends('layouts.app')

{{-- Judul dan deskripsi dinamis berdasarkan data fasilitas --}}
@section('title', ($facility['name'] ?? 'Detail Fasilitas') . ' | Lab. Teknik Sipil Unsoed')
@section('description', $facility['description'] ?? 'Detail fasilitas dan layanan yang tersedia di Laboratorium Teknik Sipil Unsoed.')

@section('content')

  @if ($facility)
    {{-- Header Section --}}
    <section class="bg-sipil-base text-light-base section-padding-x pt-28 pb-16">
      <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-col md:flex-row gap-8">
          {{-- Facility Image --}}
          <div class="md:w-1/2">
            <div class="relative w-full h-64 md:h-80 overflow-hidden rounded-lg">
              <img
                src="{{ config('services.api.storage_url') }}/{{ $facility['images'][0] ?? '' }}"
                alt="{{ $facility['name'] }}"
                class="object-cover w-full h-full"
              />
            </div>
          </div>

          {{-- Facility Details --}}
          <div class="md:w-1/2">
            <div class="flex items-center gap-4 mb-4">
              <a href="{{ route('facilities.index') }}" class="text-blue-300 hover:text-white flex items-center text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
                Kembali ke Fasilitas
              </a>
              <span class="inline-block px-3 py-1 text-xs font-medium bg-blue-500 bg-opacity-20 text-blue-100 rounded-full">
                {{ $facility['code'] }}
              </span>
            </div>

            <h1 class="text-3xl font-bold mb-2">{{ $facility['name'] }}</h1>

            <div class="flex items-center text-sm mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
              <span>Ruangan: {{ $facility['room'] }}</span>
            </div>

            <p class="text-light-base/80 mb-6 leading-relaxed">
              {{ $facility['description'] }}
            </p>

            <div class="grid grid-cols-2 gap-4 mb-8">
              <div class="bg-light-base bg-opacity-10 rounded-lg p-4 text-center">
                <div class="text-2xl font-bold text-white mb-1">
                  {{ count($facility['tests'] ?? []) }}
                </div>
                <div class="text-sm text-blue-200">
                  Pengujian Tersedia
                </div>
              </div>
              <div class="bg-light-base bg-opacity-10 rounded-lg p-4 text-center">
                <div class="text-2xl font-bold text-white mb-1">
                  {{ count($facility['packages'] ?? []) }}
                </div>
                <div class="text-sm text-blue-200">Paket Layanan</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    {{-- Tests Detail Section --}}
    @if (!empty($facility['tests']))
      <section class="bg-gradient-to-b from-gray-50 to-white section-padding-x py-8">
        <div class="max-w-screen-xl mx-auto">
          <div class="text-center mb-8">
            <h2 class="text-4xl font-bold text-dark-base mb-4">
              Layanan Pengujian Lengkap
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
              Berbagai layanan pengujian profesional dengan standar kualitas tinggi di {{ $facility['name'] }}
            </p>
          </div>
          <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-8">
            @foreach ($facility['tests'] as $index => $test)
              <div class="group bg-light-base rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-sipil-base/20 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-sipil-base/5 to-blue-500/5 rounded-bl-2xl"></div>
                <div class="relative">
                  <div class="flex items-start justify-between mb-4">
                    <div class="flex-1">
                      <div class="flex items-center gap-2 mb-2">
                        <span class="text-xs font-semibold text-sipil-base bg-sipil-base/10 px-2 py-1 rounded-full">
                          #{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}
                        </span>
                        <span class="text-xs px-2 py-1 rounded-full font-medium {{ $test['is_active'] ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                          {{ $test['is_active'] ? 'Tersedia' : 'Tidak Tersedia' }}
                        </span>
                      </div>
                      <a href="{{ route('tests.show', ['slug' => $test['slug']]) }}">
                        <h3 class="text-xl font-bold text-dark-base mb-2 group-hover:text-sipil-base transition-colors">
                          {{ $test['name'] }}
                        </h3>
                      </a>
                    </div>
                  </div>
                  <p class="text-gray-600 text-sm mb-6 leading-relaxed line-clamp-3">
                    {{ $test['description'] }}
                  </p>
                  <div class="space-y-4 mb-6">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                      <span class="text-sm font-medium text-gray-700">Harga</span>
                      <span class="text-lg font-bold text-sipil-base">
                        Rp {{ number_format($test['price'] ?? 0, 0, ',', '.') }}
                      </span>
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                      <div class="p-3 bg-blue-50 rounded-lg">
                        <div class="text-xs text-gray-500">Min. Unit</div>
                        <div class="text-sm font-semibold text-gray-700">{{ $test['minimum_unit'] }}</div>
                      </div>
                      <div class="p-3 bg-purple-50 rounded-lg">
                        <div class="text-xs text-gray-500">Slot/Hari</div>
                        <div class="text-sm font-semibold text-gray-700">{{ $test['daily_slot'] }}</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    {{-- Packages Detail Section --}}
    @if (!empty($facility['packages']))
      <section class="bg-white section-padding-x py-16">
        <div class="max-w-screen-xl mx-auto">
          <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-dark-base mb-4">
              Paket Layanan Terintegrasi
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
              Solusi paket lengkap dengan harga terjangkau untuk kebutuhan pengujian di {{ $facility['name'] }}
            </p>
          </div>
          <div class="grid md:grid-cols-2 gap-8">
            @foreach ($facility['packages'] as $index => $pkg)
              <div class="group bg-gradient-to-br from-green-50 to-blue-50 rounded-2xl p-8 shadow-sm hover:shadow-xl transition-all duration-300 border border-green-100 hover:border-green-200 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-24 h-24 bg-gradient-to-br from-green-400/10 to-blue-400/10 rounded-bl-3xl"></div>
                <div class="relative">
                  <h3 class="text-2xl font-bold text-dark-base mb-3 group-hover:text-green-700 transition-colors">{{ $pkg['name'] }}</h3>
                  <p class="text-gray-600 text-sm mb-6 leading-relaxed">{{ $pkg['description'] }}</p>
                  <div class="bg-gradient-to-r from-green-500 to-blue-500 rounded-xl p-6 mb-6 text-white">
                    <div class="text-sm opacity-90 mb-1">Harga Paket</div>
                    <div class="text-3xl font-bold">Rp {{ number_format($pkg['price'] ?? 0, 0, ',', '.') }}</div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </section>
    @endif

    {{-- Contact Section --}}
    <section class="bg-gray-50 section-padding-x py-16">
      <div class="max-w-screen-xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-dark-base mb-4">
          Tertarik dengan Layanan Kami?
        </h2>
        <p class="text-gray-600 mb-8">
          Hubungi kami untuk informasi lebih lanjut tentang layanan pengujian dan konsultasi.
        </p>
        <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-sipil-base text-white font-medium rounded-lg hover:bg-sipil-base/90 transition-colors">
          Hubungi Kami
        </a>
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