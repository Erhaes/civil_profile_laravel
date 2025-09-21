
@extends('layouts.app')

{{-- Judul khusus untuk halaman ini --}}
@section('title', 'Beranda | Lab. Teknik Sipil Unsoed')

{{-- Deskripsi khusus untuk halaman ini --}}
@section('description', 'Membangun Masa Depan Infrastruktur yang Berkelanjutan. Laboratorium Teknik Sipil Unsoed sebagai pusat pembelajaran praktis dan eksperimental.')

{{-- Konten utama halaman --}}
@section('content')
  
  {{-- 1. Hero Section --}}
  @include('components.homepage.hero')

  {{-- 2. About Section --}}
  @include('components.homepage.about', ['carouselLabs' => $carouselLabs])

  {{-- 3. Facilities Section --}}
  @include('components.homepage.facilities')

  {{-- 4. Accreditation Section --}}
  {{-- @include('components.homepage.accreditation', ['standards' => $standards]) --}}

  {{-- 4. Kalibrasi alat section --}}
  @include('components.homepage.standard')
  
  {{-- 5. Testimonial Section --}}
  @include('components.homepage.testimonial', ['reviews' => $reviews])

  {{-- 6. Call to Action Section --}}
  @include('components.homepage.cta')

@endsection