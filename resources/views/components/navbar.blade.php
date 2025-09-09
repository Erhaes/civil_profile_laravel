@php
  $navigation = [
      ['title' => 'Beranda', 'path' => route('home')],
      ['title' => 'Profil', 'path' => route('profile')],
      ['title' => 'Fasilitas', 'path' => route('facilities.index')],
      ['title' => 'Pengujian', 'path' => route('tests.index')],
      ['title' => 'Berita', 'path' => route('news.index')],
      ['title' => 'Kontak', 'path' => route('contact')],
      ['title' => 'Unduhan', 'path' => route('downloads')],
      ['title' => 'Reservasi', 'path' => 'https://reservasi.labsipilunsoed.com/'],
  ];
@endphp

<nav
  id="navbar"
  class="section-padding-x fixed top-0 w-full z-[998] bg-light-base/80 text-dark-base normal-font-size transition-all duration-300 py-4 backdrop-blur-md shadow-md dark:text-light-base dark:bg-dark-base/80 dark:shadow-md"
>
  <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto">
    <a href="{{ route('home') }}" class="flex items-center gap-2">
      <img src="{{ asset('unsoed.png') }}" class="w-12" alt="Unsoed Logo" />
      <div class="flex flex-col gap-1">
        <span class="normal-font-size font-bold">Lab. Teknik Sipil</span>
        <span class="extra-small-font-size">
          Universitas Jenderal Soedirman
        </span>
      </div>
    </a>
    <button
      type="button"
      id="navbar-toggle-btn"
      class="xl:hidden text-dark-base dark:text-light-base relative z-[999] focus:outline-none"
    >
      <svg
        xmlns="http://www.w3.org/2000/svg"
        fill="currentColor"
        class="w-8"
        viewBox="0 0 448 512"
      >
        <path d="M0 96C0 78.3 14.3 64 32 64l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 128C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32l384 0c17.7 0 32 14.3 32 32s-14.3 32-32 32L32 288c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32L32 448c-17.7 0-32-14.3-32-32s14.3-32 32-32l384 0c17.7 0 32 14.3 32 32z" />
      </svg>
    </button>
    <div
      id="navbar-menu"
      class="w-full xl:block xl:w-auto hidden"
    >
      <ul class="font-medium flex flex-col p-4 xl:p-0 mt-4 border dark:border-gray-200 border-gray-400 rounded-xl xl:flex-row rtl:space-x-reverse xl:mt-0 xl:border-none gap-2 xl:gap-4">
        @foreach ($navigation as $item)
          <li>
            <a 
              href="{{ $item['path'] }}" 
              class="block py-2 px-3 rounded
                
                @if (request()->is(ltrim(parse_url($item['path'], PHP_URL_PATH), '/')))
                    text-light-base bg-sipil-base
                @else
                    hover:bg-gray-100 dark:hover:bg-gray-700
                @endif
                {{-- Kelas khusus untuk tombol Reservasi --}}
                @if ($item['title'] === 'Reservasi')
                    text-light-base gradient-to-r from-blue-base to-blue-secondary bg-gradient-to-br
                @endif
              "
            >
              {{ $item['title'] }}
            </a>
          </li>
        @endforeach
        {{-- Tombol Dark Mode (Fungsionalitas JS ditambahkan terpisah) --}}
        {{-- <button
          id="theme-toggle"
          type="button"
          class="hidden text-gray-500 dark:text-gray-400 border dark:border-gray-200 border-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none rounded-lg text-sm py-2 px-3 transition-all duration-300 cursor-pointer w-fit"
        >
          ... SVG Ikon Dark/Light Mode ...
        </button> --}}
      </ul>
    </div>
  </div>
</nav>