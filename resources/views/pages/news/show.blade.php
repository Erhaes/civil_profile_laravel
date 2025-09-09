{{--
  Halaman Detail Berita.
--}}
@extends('layouts.app')

{{-- Judul dan deskripsi dinamis berdasarkan data berita --}}
@section('title', ($newsItem['title'] ?? 'Detail Berita') . ' | Lab. Teknik Sipil Unsoed')
@section('description', Str::limit(strip_tags($newsItem['content'] ?? 'Berita dari Laboratorium Teknik Sipil Unsoed.'), 160))

@section('content')

  @if ($newsItem)
    @php
      // Helper function
      function formatDateDetail($dateString) {
          $date = \Carbon\Carbon::parse($dateString);
          return $date->translatedFormat('l, j F Y • H:i'); // e.g., Kamis, 21 Agustus 2025 • 15:30
      }
      function getImageUrl($path) {
          if (!$path) return asset('images/news/eco-construction.jpg'); // Fallback
          return config('services.api.storage_url') . '/' . $path;
      }
    @endphp

    {{-- Breadcrumb --}}
    <section class="py-6 bg-gray-50 dark:bg-gray-800 section-padding-x mt-20">
      <div class="max-w-4xl mx-auto">
        <nav class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-300">
          <a href="{{ route('home') }}" class="hover:text-sipil-base">Beranda</a>
          <span>/</span>
          <a href="{{ route('news.index') }}" class="hover:text-sipil-base">Berita</a>
          <span>/</span>
          <span class="text-gray-900 dark:text-gray-100 truncate">{{ $newsItem['title'] }}</span>
        </nav>
      </div>
    </section>

    {{-- News Content --}}
    <section class="py-8 section-padding-x">
      <div class="max-w-4xl mx-auto">
        <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
          {{-- Header --}}
          <div class="p-6 md:p-8">
            <div class="mb-4">
              <span class="inline-block bg-sipil-base text-white px-3 py-1 rounded-full text-sm font-medium">
                {{ $newsItem['news_category']['name'] }}
              </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-gray-100 mb-4 leading-tight">
              {{ $newsItem['title'] }}
            </h1>
            <div class="flex items-center text-gray-500 dark:text-gray-400 text-sm pb-6 border-b border-gray-200 dark:border-gray-700">
              <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
              <span>{{ formatDateDetail($newsItem['created_at']) }}</span>
              <span class="mx-2">•</span>
              <span>Oleh: {{ $newsItem['author']['name'] }}</span>
            </div>
          </div>

          {{-- Featured Image --}}
          <div class="relative h-64 md:h-96">
            <img src="{{ getImageUrl($newsItem['thumbnail']) }}" alt="{{ $newsItem['title'] }}" class="object-cover w-full h-full" />
          </div>

          {{-- Content --}}
          <div class="p-6 md:p-8">
            <div class="prose prose-lg max-w-none text-gray-700 dark:text-gray-300 leading-relaxed">
              {!! $newsItem['content'] !!}
            </div>
          </div>
        </article>
      </div>
    </section>

  @else
    {{-- Tampilan jika berita tidak ditemukan --}}
    <section class="py-28 section-padding-x">
      <div class="max-w-4xl mx-auto">
        <div class="text-center py-12">
          <h1 class="text-2xl font-bold mb-4">Berita Tidak Ditemukan</h1>
          <p class="text-gray-600 mb-6">Maaf, berita yang Anda cari tidak dapat ditemukan.</p>
          <a href="{{ route('news.index') }}" class="inline-block px-4 py-2 bg-sipil-base text-white rounded-md hover:bg-sipil-secondary">
            Kembali ke Daftar Berita
          </a>
        </div>
      </div>
    </section>
  @endif
@endsection