
@extends('layouts.app')

{{-- Judul khusus untuk halaman ini --}}
@section('title', 'Pengujian | Lab. Teknik Sipil Unsoed')

{{-- Deskripsi khusus untuk halaman ini --}}
@section('description', 'Temukan berbagai layanan pengujian yang kami tawarkan, didukung oleh fasilitas modern dan tenaga ahli profesional di Laboratorium Teknik Sipil Unsoed.')

{{-- Konten utama halaman --}}
@section('content')

  {{-- 1. Tests Header --}}
  @include('components.tests.header')

  {{-- 2. Tests Main Content (Grid & Pagination) --}}
  @include('components.tests.main', ['tests' => $tests])

@endsection