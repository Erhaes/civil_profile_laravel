{{--
  Halaman Unduhan.
--}}
@extends('layouts.app')

{{-- Judul--}}
@section('title', 'Unduhan | Lab. Teknik Sipil Unsoed')

{{-- Deskripsi--}}
@section('description', 'Pusat unduhan dokumen resmi, formulir, template, dan pedoman praktikum Laboratorium Teknik Sipil Unsoed.')

{{-- Konten utama halaman --}}
@section('content')

  {{-- 1. Download Header --}}
  @include('components.download.header')

  {{-- 2. Download Main Content (Table & Pagination) --}}
  @include('components.download.main', ['apiData' => $apiData])

  {{-- 3. Download FAQ / Panduan --}}
  @include('components.download.faq')

@endsection