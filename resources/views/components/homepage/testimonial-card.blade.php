@php
  // Helper function untuk merender bintang rating
  function renderStars($rating) {
      $stars = '';
      for ($i = 1; $i <= 5; $i++) {
          $color = $i <= $rating ? 'text-yellow-400' : 'text-gray-300';
          $stars .= '<svg class="w-4 h-4 ' . $color . '" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>';
      }
      return $stars;
  }
@endphp

<div class="w-[80vw] max-w-sm sm:w-[350px] flex flex-col gap-4 p-4 rounded-lg bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 relative group">
  <svg
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 448 512"
    fill="currentColor"
    class="w-8 absolute text-sipil-base top-4 right-4 opacity-50 group-hover:opacity-100 transition-all duration-300"
  >
    <path d="M448 296c0 66.3-53.7 120-120 120l-8 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l8 0c30.9 0 56-25.1 56-56l0-8-64 0c-35.3 0-64-28.7-64-64l0-64c0-35.3 28.7-64 64-64l64 0c35.3 0 64 28.7 64 64l0 32 0 32 0 72zm-256 0c0 66.3-53.7 120-120 120l-8 0c-17.7 0-32-14.3-32-32s14.3-32 32-32l8 0c30.9 0 56-25.1 56-56l0-8-64 0c-35.3 0-64-28.7-64-64l0-64c0-35.3 28.7-64 64-64l64 0c35.3 0 64 28.7 64 64l0 32 0 32 0 72z" />
  </svg>
  
  {{-- Rating Stars --}}
  <div class="flex items-center gap-1">
    {!! renderStars($review['rating']) !!}
    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
        ({{ $review['rating'] }}/5)
    </span>
  </div>
  
  <p class="text-gray-900 dark:text-gray-100 small-font-size text-wrap">
    {{ $review['content'] }}
  </p>
</div>