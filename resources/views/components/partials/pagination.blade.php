
@if ($paginator && $paginator['last_page'] > 1)
    @php
        $totalPages = $paginator['last_page'];
        $currentPage = $paginator['current_page'];
        
        $baseUrl = request()->url(); 
        
        $pages = [];
        if ($totalPages <= 7) {
            for ($i = 1; $i <= $totalPages; $i++) {
                $pages[] = $i;
            }
        } else {
            $pages[] = 1;
            if ($currentPage > 4) $pages[] = '...';
            $start = max(2, $currentPage - 2);
            $end = min($totalPages - 1, $currentPage + 2);
            for ($i = $start; $i <= $end; $i++) {
                $pages[] = $i;
            }
            if ($currentPage < $totalPages - 3) $pages[] = '...';
            $pages[] = $totalPages;
        }
    @endphp

    <div class="flex justify-center mt-8">
        <nav class="flex items-center">
            {{-- Tombol "Sebelumnya" --}}
            <a 
                href="{{ $paginator['prev_page_url'] ? $baseUrl . '?page=' . ($currentPage - 1) : '#' }}"
                class="px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-l-md text-sm hover:bg-gray-50 {{ !$paginator['prev_page_url'] ? 'opacity-50 cursor-not-allowed' : '' }}"
            >
                &laquo; Sebelumnya
            </a>

            {{-- Nomor Halaman --}}
            <div class="hidden md:flex">
                @foreach ($pages as $page)
                    @if ($page === '...')
                        <span class="px-4 py-2 border-t border-b border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-500 text-sm">...</span>
                    @else
                        
                        <a 
                            href="{{ $baseUrl }}?page={{ $page }}"
                            class="px-4 py-2 border-t border-b border-gray-300 dark:border-gray-600 text-sm {{ $currentPage == $page ? 'bg-sipil-base text-white' : 'bg-white dark:bg-gray-700 hover:bg-gray-50' }}"
                        >
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
            </div>
            
            {{-- Indikator Halaman Mobile --}}
            <span class="md:hidden px-4 py-2 border-t border-b border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm">
                Halaman {{ $currentPage }} / {{ $totalPages }}
            </span>

            {{-- Tombol "Berikutnya" --}}
            <a 
                href="{{ $paginator['next_page_url'] ? $baseUrl . '?page=' . ($currentPage + 1) : '#' }}"
                class="px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 rounded-r-md text-sm hover:bg-gray-50 {{ !$paginator['next_page_url'] ? 'opacity-50 cursor-not-allowed' : '' }}"
            >
                Berikutnya &raquo;
            </a>
        </nav>
    </div>
@endif