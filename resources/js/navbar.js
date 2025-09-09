/**
 * Navbar Toggle Functionality
 *
 * This script handles the click event for the mobile navigation toggle button.
 */
document.addEventListener('DOMContentLoaded', () => {
    // Tombol hamburger untuk membuka menu
    const toggleButton = document.getElementById('navbar-toggle-btn');
    
    // Container menu yang akan ditampilkan/disembunyikan
    const menuContainer = document.getElementById('navbar-menu');

    if (toggleButton && menuContainer) {
        toggleButton.addEventListener('click', () => {
            // Toggle class 'hidden' pada container menu
            menuContainer.classList.toggle('hidden');
        });
    }

    // Fungsionalitas Dark Mode
    /*
    const themeToggleBtn = document.getElementById('theme-toggle');
    if (themeToggleBtn) {
        themeToggleBtn.addEventListener('click', () => {
            document.documentElement.classList.toggle('dark');
        });
    }
    */
});