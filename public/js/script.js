document.addEventListener('DOMContentLoaded', () => {
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        
        document.querySelectorAll(".like-section").forEach(button => {
            button.addEventListener("click", function() {
                const tipId = this.id;
                const heartIcon = document.getElementById(`heart${tipId}`);
                const countSpan = document.getElementById(`count${tipId}`);

                fetch("/like", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': token
                    },
                    body: JSON.stringify({ id: tipId })
                })
                .then(response => response.json())
                .then(data => {
                    countSpan.innerText = data.count.toLocaleString();
                    
                    if (data.liked) {
                        heartIcon.style.color = "var(--kombu-green)";
                    } else {
                        heartIcon.style.color = "var(--beige)";
                    }
                })
                .catch(error => console.error('Error:', error));
            });
        });
    });

    // Configuración global de Fancybox
Fancybox.bind("[data-fancybox]", {
  transitionEffect: "zoomIn",
  infinite: true,
  buttons: [
    "zoom",
    "slideshow",
    "fullScreen",
    "download",
    "close"
  ],
  caption: function (fancybox, carousel, slide) {
    return `${slide.caption} <br /> <small>Compartido en EcoGuide</small>`;
  }
});


const categories = document.querySelectorAll('.category');
const container = document.getElementById('tips-container');

categories.forEach(cat => {
    cat.addEventListener('click', function () {

        // Active state
        categories.forEach(c => c.classList.remove('active'));
        this.classList.add('active');

        let categoryId = this.dataset.id;

        // 🔥 1. Animación de salida
        container.classList.add('fade-out');

        setTimeout(() => {

            let url = categoryId === 'all'
                ? '/tips/filter'
                : `/tips/filter?category=${categoryId}`;

            fetch(url)
                .then(res => res.text())
                .then(html => {

                    // 🔥 2. Reemplazar contenido
                    container.innerHTML = html;

                    // 🔥 3. Reset + animación de entrada
                    container.classList.remove('fade-out');
                    container.classList.add('fade-in');

                    // 🔥 4. Quitar clase después (para repetir animación)
                    setTimeout(() => {
                        container.classList.remove('fade-in');
                    }, 400);
                });

        }, 300); // mismo tiempo que transition
    });
});

document.querySelectorAll('.like-section').forEach(section => {
    section.addEventListener('click', function () {

        let tipId = this.id;
        let heart = document.getElementById(`heart${tipId}`);

        // animación
        heart.classList.add('animate');

        setTimeout(() => {
            heart.classList.remove('animate');
        }, 500);

        // toggle visual
        heart.classList.toggle('liked');
    });
});

document.getElementById('avatarUploadInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (!file) return;

    const reader = new FileReader();
    reader.onload = function(e) {
        document.querySelector('.account-avatar img').src = e.target.result;
    };
    reader.readAsDataURL(file);
});

setTimeout(() => {
    const msg = document.querySelector('.success-message');
    if (msg) {
        msg.style.opacity = '0';
        msg.style.transform = 'translateY(-10px)';
        setTimeout(() => msg.remove(), 300);
    }
}, 3000);