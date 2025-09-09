
@extends('layouts.app')

{{-- Judul khusus untuk halaman ini --}}
@section('title', 'Profil | Lab. Teknik Sipil Unsoed')

{{-- Deskripsi khusus untuk halaman ini --}}
@section('description', 'Profil Laboratorium Teknik Sipil Unsoed, mencakup struktur organisasi, penelitian, dan standar laboratorium yang kami miliki.')

{{-- Konten utama halaman --}}
@section('content')
  
  {{-- 1. Profile Header --}}
  @include('components.profile.header')

  {{-- 2. Profile Main Content (with Tabs) --}}
  @include('components.profile.main')

@endsection

{{-- 
  Menambahkan skrip Alpine.js ke stack 'scripts' di layout.
  Ini memastikan Alpine.js dimuat dan dapat mengelola interaktivitas tab.
--}}
@push('scripts')
  <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endpush