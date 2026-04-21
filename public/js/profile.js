function showTab(tabId, element) {
    // 1. Ocultar todos los contenidos de las pestañas
    const contents = document.querySelectorAll('.tab-content');
    contents.forEach(content => {
        content.style.display = 'none';
    });

    // 2. Quitar la clase 'active' de todas las pestañas
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => {
        tab.classList.remove('active');
    });

    // 3. Mostrar el contenido de la pestaña seleccionada
    document.getElementById(tabId).style.display = 'block';

    // 4. Añadir la clase 'active' al botón presionado
    element.classList.add('active');
}