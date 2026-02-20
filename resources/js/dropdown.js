// Función para inicializar el dropdown de Flowbite
function initFlowbiteDropdown() {
    // Configuración del dropdown para el navbar
    const dropdownNavbarLink = document.getElementById('dropdownNavbarLink');
    const dropdownNavbar = document.getElementById('dropdownNavbar');
    
    if (dropdownNavbarLink && dropdownNavbar) {
        dropdownNavbarLink.addEventListener('click', function(e) {
            e.preventDefault();
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            dropdownNavbar.classList.toggle('hidden');
        });
        
        // Cerrar el dropdown al hacer clic fuera de él
        document.addEventListener('click', function(e) {
            if (!dropdownNavbar.contains(e.target) && e.target !== dropdownNavbarLink) {
                dropdownNavbar.classList.add('hidden');
                dropdownNavbarLink.setAttribute('aria-expanded', 'false');
            }
        });
    }
    
    // Configuración del menú móvil
    const mobileMenuButton = document.querySelector('[data-collapse-toggle="navbar-dropdown"]');
    const mobileMenu = document.getElementById('navbar-dropdown');
    
    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', !isExpanded);
            mobileMenu.classList.toggle('hidden');
        });
    }
}

// Inicializar cuando el DOM esté listo
document.addEventListener('DOMContentLoaded', initFlowbiteDropdown);