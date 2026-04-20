document.querySelector('form').addEventListener('submit', function(e){
    let valid = true;

    const fields = [
        { id: 'title', message: '¡Ups! The title is necesary'},
        {id: 'description', message: 'Ou, the description is missing.'},
        {id: 'imagen-upload', isFile: true, message: 'Please, selec your image'}
    ];
     
    fields.forEach(field => {
        const input = document.getElementsByName(field.id.replace('error-', ''))[0] || document.getElementById(field.id);
        const errorSpan = document.getElementById('error-' + (field.isFile ? 'image' : field.id));

        if(!input.value || (field.isFile && input.files.length === 0)) {
            e.preventDefault();
            errorSpan.innerText = field.message;
            errorSpan.style.display = 'block';
            input.classList.add('input-error');
            valid = false;
        } else {
            errorSpan.style.display = 'none';
            input.classList.remove('input-error');
        }
    });
});