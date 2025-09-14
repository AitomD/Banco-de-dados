
    document.addEventListener("DOMContentLoaded", function () {
        const dropdownBtn = document.getElementById('dropdownMenuButtonDesktop');
        const dropdownMenu = dropdownBtn?.nextElementSibling;

        if (dropdownBtn && dropdownMenu) {
            dropdownMenu.classList.add('custom-dropdown'); // Aplica estilo personalizado

            dropdownBtn.addEventListener('click', function (e) {
                e.stopPropagation(); // Impede conflito com o listener global
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function (e) {
                if (!dropdownBtn.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        }
    });
