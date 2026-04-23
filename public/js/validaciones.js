document.querySelector('form').addEventListener('submit', function (e) {

    let valid = true;

    // TITLE
    const title = document.getElementById('title');
    const errorTitle = document.getElementById('error-title');

    if (!title.value.trim()) {
        errorTitle.innerText = 'Title is required';
        errorTitle.style.display = 'block';
        title.classList.add('input-error');
        valid = false;
    } else {
        errorTitle.style.display = 'none';
        title.classList.remove('input-error');
    }

    // DESCRIPTION
    const description = document.getElementById('description');
    const errorDesc = document.getElementById('error-description');

    if (!description.value.trim()) {
        errorDesc.innerText = 'Description is required';
        errorDesc.style.display = 'block';
        description.classList.add('input-error');
        valid = false;
    } else {
        errorDesc.style.display = 'none';
        description.classList.remove('input-error');
    }

    // IMAGE
    const image = document.getElementById('image-upload');
    const errorImage = document.getElementById('error-image-upload');

    if (!image.files.length) {
        errorImage.innerText = 'Image is required';
        errorImage.style.display = 'block';
        valid = false;
    } else {
        errorImage.style.display = 'none';
    }

    // CATEGORY
    const category = document.querySelector('select[name="category_id"]');
    const errorCategory = document.getElementById('error-category_id');

    if (!category.value) {
        errorCategory.innerText = 'Select a category';
        errorCategory.style.display = 'block';
        category.classList.add('input-error');
        valid = false;
    } else {
        errorCategory.style.display = 'none';
        category.classList.remove('input-error');
    }

    // SOLO bloquea si hay errores
    if (!valid) e.preventDefault();
});

document.addEventListener('DOMContentLoaded', () => {

    const input = document.getElementById('image-upload');

    if (!input) return; // seguridad

    input.addEventListener('change', function () {

        const file = this.files[0];
        if (!file) return;

        const reader = new FileReader();

        reader.onload = function (e) {

            let img = document.getElementById('preview-image');

            // 🔥 Si ya existe → actualizar
            if (img) {
                img.src = e.target.result;
            }
            // 🔥 Si no existe → crear
            else {
                const container = document.getElementById('image-label');

                img = document.createElement('img');
                img.id = 'preview-image';
                img.classList.add('preview-image');
                img.src = e.target.result;

                container.appendChild(img);

                const placeholder = document.getElementById('upload-placeholder');
                if (placeholder) placeholder.remove();
            }
        };

        reader.readAsDataURL(file);
    });

});

// SOLO validar si NO hay imagen previa
const hasExistingImage = document.getElementById('preview-image');

if (!image.files.length && !hasExistingImage) {
    errorImage.innerText = 'Image is required';
    errorImage.style.display = 'block';
    valid = false;
} else {
    errorImage.style.display = 'none';
}

