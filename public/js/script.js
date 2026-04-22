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