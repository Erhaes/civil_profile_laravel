{{--
  Halaman Daftar Fasilitas.
--}}
@extends('layouts.app')

{{-- Judul khusus untuk halaman ini --}}
@section('title', 'Fasilitas | Lab. Teknik Sipil Unsoed')

{{-- Deskripsi khusus untuk halaman ini --}}
@section('description', 'Jelajahi berbagai fasilitas dan laboratorium modern yang tersedia di Program Studi Teknik Sipil Unsoed untuk mendukung kegiatan akademik dan penelitian.')

{{-- Konten utama halaman --}}
@section('content')

  {{-- 1. Facility Header --}}
  @include('components.facility.header')

  {{-- 2. Facility Main Content (Grid & Pagination) --}}
  @include('components.facility.main', ['apiData' => $apiData])

@endsection