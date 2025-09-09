{{--
  Halaman Kontak.
--}}
@extends('layouts.app')

{{-- Judul --}}
@section('title', 'Kontak | Lab. Teknik Sipil Unsoed')

{{-- Deskripsi --}}
@section('description', 'Hubungi kami untuk pertanyaan, layanan pengujian, atau informasi lebih lanjut. Temukan alamat, telepon, email, dan formulir kontak kami di sini.')

{{-- Konten utama halaman --}}
@section('content')

  {{-- 1. Contact Header --}}
  @include('components.contact.header')

  {{-- 2. Contact Main Content (Info & Form) --}}
  @include('components.contact.main')

@endsection