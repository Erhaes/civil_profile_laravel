<section class="py-16 bg-light-base text-dark-base dark:bg-dark-base dark:text-light-base section-padding-x">
  <div class="max-w-screen-xl mx-auto">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <div class="lg:col-span-1 space-y-8">
        {{-- Informasi Kontak --}}
        <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-4 md:p-6 shadow-md">
          <h3 class="font-bold text-gray-900 dark:text-sipil-blue-accent mb-2">
            Informasi Kontak
          </h3>
          <div class="space-y-4">
            <div class="flex items-start gap-3"><div class="p-2 bg-sipil-base/10 rounded-md text-sipil-base dark:text-sipil-blue-accent"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 384 512"><path d="M215.7 499.2C267 435 384 279.4 384 192C384 86 298 0 192 0S0 86 0 192c0 87.4 117 243 168.3 307.2c12.3 15.3 35.1 15.3 47.4 0zM192 128a64 64 0 1 1 0 128 64 64 0 1 1 0-128z" /></svg></div><div><h4 class="font-semibold text-gray-800 dark:text-gray-200">Alamat</h4><p class="small-font-size text-gray-600 dark:text-gray-400">Gedung D Lt. 1 Fakultas Teknik, Universitas Jenderal Soedirman Jl. Mayjen Sungkono KM 5, Blater Purbalingga, Jawa Tengah 53371</p></div></div>
            <div class="flex items-start gap-3"><div class="p-2 bg-sipil-base/10 rounded-md text-sipil-base dark:text-sipil-blue-accent"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 512 512"><path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" /></svg></div><div><h4 class="font-semibold text-gray-800 dark:text-gray-200">Telepon</h4><p class="small-font-size text-gray-600 dark:text-gray-400">0813-9313-3408</p></div></div>
            <div class="flex items-start gap-3"><div class="p-2 bg-sipil-base/10 rounded-md text-sipil-base dark:text-sipil-blue-accent"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 512 512"><path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" /></svg></div><div><h4 class="font-semibold text-gray-800 dark:text-gray-200">Email</h4><p class="small-font-size text-gray-600 dark:text-gray-400">laboratoriumsipil.unsoed@gmail.com</p></div></div>
          </div>
        </div>
        {{-- Jam Operasional --}}
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 md:p-6 shadow-md">
          <h3 class="font-bold text-gray-900 dark:text-sipil-blue-accent mb-2">Jam Operasional</h3>
          <div class="space-y-2 text-gray-600 dark:text-gray-400">
            <div class="flex justify-between"><span>Senin - Kamis</span><span class="font-medium text-gray-800 dark:text-gray-200">08:00 - 16:00 WIB</span></div>
            <div class="flex justify-between"><span>Jumat</span><span class="font-medium text-gray-800 dark:text-gray-200">08:00 - 15:00 WIB</span></div>
            <div class="flex justify-between"><span>Sabtu - Minggu</span><span class="font-medium text-gray-800 dark:text-gray-200">Tutup</span></div>
          </div>
        </div>
      </div>
      
      {{-- Formulir Kontak & Peta --}}
      <div class="lg:col-span-2 space-y-8">
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 md:p-6 shadow-md">
          <h3 class="font-bold text-gray-900 dark:text-sipil-blue-accent mb-2">
            Formulir Kontak
          </h3>
          <form id="contact-form" action="{{ route('contact.submit') }}" method="POST" class="space-y-4">
            @csrf
            <div>
              <label for="name" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Nama Lengkap <span class="text-red-base">*</span></label>
              <input type="text" id="name" name="name" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-sipil-base bg-white dark:bg-gray-800" placeholder="Masukkan nama lengkap Anda" required />
            </div>
            <div>
              <label for="email" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Email <span class="text-red-base">*</span></label>
              <input type="email" id="email" name="email" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-sipil-base bg-white dark:bg-gray-800" placeholder="Masukkan alamat email Anda" required />
            </div>
            <div>
              <label for="subject" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Subjek <span class="text-red-base">*</span></label>
              <input type="text" id="subject" name="subject" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-sipil-base bg-white dark:bg-gray-800" placeholder="Masukkan subjek pesan Anda" required />
            </div>
            <div>
              <label for="content" class="block mb-1 text-gray-700 dark:text-gray-300 font-medium">Pesan <span class="text-red-base">*</span></label>
              <textarea id="content" name="content" rows="5" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-sipil-base bg-white dark:bg-gray-800" placeholder="Tulis pesan Anda di sini..." required></textarea>
            </div>
            
            <div id="submit-message" class="hidden"></div>
            
            <button type="submit" class="w-full py-3 px-4 bg-sipil-base text-white font-medium rounded-md hover:bg-sipil-secondary transition duration-300 flex justify-center items-center">
              <span>Kirim Pesan</span>
            </button>
          </form>
        </div>

        {{-- Google Map --}}
        <div class="bg-white dark:bg-gray-900 rounded-lg p-4 md:p-6 shadow-md">
          <h3 class="font-bold text-gray-900 dark:text-sipil-blue-accent mb-2">Lokasi Kami</h3>
          <div class="h-80 rounded-lg overflow-hidden">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.330504287398!2d109.33501537500132!3d-7.428629792582002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e655986a5294e97%3A0x6ed179e2743fcd16!2sGedung%20Laboratorium%20Bersama%20FT%20UNSOED!5e0!3m2!1sid!2sid!4v1750268049029!5m2!1sid!2sid" width="100%" height="100%" style="border: 0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>