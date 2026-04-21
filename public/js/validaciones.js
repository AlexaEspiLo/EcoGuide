document.querySelector('form').addEventListener('submit', function(e) {
    let allValid = true;

    const fields = [
        { id: 'title', message: '¡Ups! The title is necessary.' },
        { id: 'description', message: 'Ou, the description is missing.' },
        { id: 'image-upload', isFile: true, message: 'Please, select your image.' }
    ];

    fields.forEach(field => {
        const input = document.getElementById(field.id);
        const errorSpan = document.getElementById('error-' + field.id);
        const visualElement = field.isFile ? document.getElementById('image-label') : input;

        let isInvalid = false;
        if (field.isFile) {
            isInvalid = !input || input.files.length === 0;
        } else {
            isInvalid = !input || input.value.trim() === "";
        }

        if (isInvalid) {
            e.preventDefault();
            allValid = false;
            if (errorSpan) {
                errorSpan.innerText = field.message;
                errorSpan.style.display = 'block';
            }
            if (visualElement) visualElement.classList.add('input-error');
        } else {
            if (errorSpan) errorSpan.style.display = 'none';
            if (visualElement) visualElement.classList.remove('input-error');
        }
    });

    // Categoría
    const categoryGroup = document.getElementById('category-group');
    const categories = document.getElementsByName('category_id');
    const categoryError = document.getElementById('error-category_id');
    let categorySelected = false;

    categories.forEach(radio => { //revisa si hay seleccionados
        if (radio.checked) categorySelected = true;
    });

    if (!categorySelected) {
        e.preventDefault();
        allValid = false;
        if (categoryError) {
            categoryError.style.display = 'block';
            categoryError.innerText = 'Please, select a category.';
        }
        if (categoryGroup) categoryGroup.classList.add('group-error');
    } else {
        if (categoryError) categoryError.style.display = 'none';
        if (categoryGroup) categoryGroup.classList.remove('group-error');
    }
});