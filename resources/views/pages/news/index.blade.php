{{--
  Halaman Daftar Berita.
--}}
@extends('layouts.app')

{{-- Judul khusus untuk halaman ini --}}
@section('title', 'Berita | Lab. Teknik Sipil Unsoed')

{{-- Deskripsi khusus untuk halaman ini --}}
@section('description', 'Berita dan informasi terbaru seputar kegiatan, prestasi, dan perkembangan di Program Studi Teknik Sipil Universitas Jenderal Soedirman.')

{{-- Konten utama halaman --}}
@section('content')

  {{-- 1. News Header --}}
  @include('components.news.header')

  {{-- 2. News Main Content (Grid & Pagination) --}}
  @include('components.news.main', ['news' => $news])

@endsection