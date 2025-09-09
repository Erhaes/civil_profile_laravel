
document.addEventListener('DOMContentLoaded', () => {
    const contactForm = document.getElementById('contact-form');

    // Hanya jalankan jika formulir kontak ada di halaman saat ini
    if (!contactForm) {
        return;
    }

    const submitButton = contactForm.querySelector('button[type="submit"]');
    const messageContainer = document.getElementById('submit-message');

    contactForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const originalButtonText = submitButton.querySelector('span').textContent;
        
        // Nonaktifkan tombol dan tampilkan status loading
        submitButton.disabled = true;
        submitButton.innerHTML = `
            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
              <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
              <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            <span>Mengirim...</span>
        `;
        
        // Sembunyikan pesan sebelumnya
        messageContainer.classList.add('hidden');
        messageContainer.textContent = '';

        // Ambil data formulir
        const formData = new FormData(contactForm);
        const data = Object.fromEntries(formData.entries());

        // mengirim data
        window.axios.post(contactForm.action, data)
            .then(response => {
                // Tampilkan pesan sukses
                messageContainer.className = 'p-4 rounded-md bg-green-100 text-green-800';
                messageContainer.textContent = response.data.message;
                messageContainer.classList.remove('hidden');
                
                // Reset formulir
                contactForm.reset();
            })
            .catch(error => {
                // Tampilkan pesan error
                let errorMessage = 'Terjadi kesalahan. Silakan coba lagi nanti.';
                if (error.response && error.response.data && error.response.data.message) {
                    errorMessage = error.response.data.message;
                }
                
                messageContainer.className = 'p-4 rounded-md bg-red-100 text-red-800';
                messageContainer.textContent = errorMessage;
                messageContainer.classList.remove('hidden');
            })
            .finally(() => {
                // Kembalikan tombol ke keadaan semula
                submitButton.disabled = false;
                submitButton.innerHTML = `<span>${originalButtonText}</span>`;
            });
    });
});