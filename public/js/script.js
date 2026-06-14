window.addEventListener('load', () => {
    const heroImage = document.getElementById('hero-home');
    const heroContent = document.getElementById('hero-content');
    const tipsSection = document.getElementById('tipsSection');

    if (!heroImage || !heroContent || !tipsSection) return;

    if (sessionStorage.getItem('homeHeroSeen') === 'true') {
        heroImage.style.display = 'none';
        heroContent.style.display = 'none';

        window.scrollTo({
            top: tipsSection.offsetTop - 90,
            behavior: 'auto'
        });

        return;
    }

    setTimeout(() => {
        heroImage.classList.add('hero-fade-out');
        heroContent.classList.add('hero-fade-out');

        setTimeout(() => {
            heroImage.style.display = 'none';
            heroContent.style.display = 'none';

            sessionStorage.setItem('homeHeroSeen', 'true');

            window.scrollTo({
                top: tipsSection.offsetTop - 90,
                behavior: 'smooth'
            });
        }, 800);

    }, 2000);
});

const logoutForm = document.getElementById('logoutForm');

if (logoutForm) {
    logoutForm.addEventListener('submit', () => {
        sessionStorage.removeItem('homeHeroSeen');
    });
}
document.addEventListener('DOMContentLoaded', () => {
    const tokenMeta = document.querySelector('meta[name="csrf-token"]');
    const token = tokenMeta ? tokenMeta.getAttribute('content') : '';

    /* Fancybox */
    if (typeof Fancybox !== 'undefined') {
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
                return `${slide.caption ?? ''} <br /> <small>Compartido en EcoGuide</small>`;
            },
            on: {
                reveal: () => {
                    document.getElementById('tipModal')?.classList.remove('show');
                }
            }
        });
    }

    /* Likes */
    document.addEventListener('click', function (e) {
        const section = e.target.closest('.like-section');

        if (!section) return;

        const tipId = section.id;
        const heart = document.getElementById(`heart${tipId}`);
        const countSpan = document.getElementById(`count${tipId}`);

        if (heart) {
            heart.classList.add('animate');

            setTimeout(() => {
                heart.classList.remove('animate');
            }, 500);
        }

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
                if (countSpan) {
                    countSpan.innerText = data.count.toLocaleString();
                }

                if (heart) {
                    heart.classList.toggle('liked', data.liked);
                    heart.style.color = data.liked
                        ? "var(--kombu-green)"
                        : "var(--beige)";
                }
            })
            .catch(error => console.error('Error:', error));
    });

    /* Avatar preview */
    const avatarInput = document.getElementById('avatarUploadInput');

    if (avatarInput) {
        avatarInput.addEventListener('change', function (e) {
            const file = e.target.files[0];

            if (!file) return;

            const reader = new FileReader();

            reader.onload = function (e) {
                const avatarImg = document.querySelector('.account-avatar img');

                if (avatarImg) {
                    avatarImg.src = e.target.result;
                }
            };

            reader.readAsDataURL(file);
        });
    }

    /* Success message */
    setTimeout(() => {
        const msg = document.querySelector('.success-message');

        if (msg) {
            msg.style.opacity = '0';
            msg.style.transform = 'translateY(-10px)';

            setTimeout(() => msg.remove(), 300);
        }
    }, 3000);

    /* Image upload preview */
    const input = document.getElementById('image-upload');
    const fileName = document.getElementById('file-name');
    const label = document.getElementById('image-label');

    if (input && fileName && label) {
        input.addEventListener('change', function () {
            const file = this.files[0];

            if (!file) return;

            fileName.innerText = file.name;

            const reader = new FileReader();

            reader.onload = e => {
                label.style.backgroundImage = `url(${e.target.result})`;
                label.style.backgroundSize = 'cover';
                label.style.backgroundPosition = 'center';
            };

            reader.readAsDataURL(file);
        });
    }

    /* Filters + Sort */
    const categories = document.querySelectorAll('.category');
    const container = document.getElementById('tips-container');

    let currentCategory = 'all';
    let currentSort = '';

    function loadTips() {
        if (!container) return;

        let url = '/tips/filter?';

        if (currentCategory !== 'all') {
            url += `category=${currentCategory}&`;
        }

        if (currentSort !== '') {
            url += `sort=${currentSort}`;
        }

        container.classList.add('fade-out');

        setTimeout(() => {
            fetch(url)
                .then(res => res.text())
                .then(html => {
                    container.innerHTML = html;

                    container.classList.remove('fade-out');
                    container.classList.add('fade-in');

                    setTimeout(() => {
                        container.classList.remove('fade-in');
                    }, 400);
                })
                .catch(error => console.error('Error:', error));
        }, 300);
    }

    categories.forEach(cat => {
        cat.addEventListener('click', function () {
            categories.forEach(c => c.classList.remove('active'));

            this.classList.add('active');

            currentCategory = this.dataset.id;

            loadTips();
        });
    });

    const customSelect = document.getElementById('sortSelect');

    if (customSelect) {
        const selectedOption = customSelect.querySelector('.selected-option');
        const options = customSelect.querySelectorAll('.option');

        if (selectedOption) {
            selectedOption.addEventListener('click', () => {
                customSelect.classList.toggle('active');
            });
        }

        options.forEach(option => {
            option.addEventListener('click', () => {
                options.forEach(op => op.classList.remove('selected'));

                option.classList.add('selected');

                selectedOption.textContent = option.textContent;
                currentSort = option.dataset.value;

                customSelect.classList.remove('active');

                loadTips();
            });
        });

        document.addEventListener('click', e => {
            if (!customSelect.contains(e.target)) {
                customSelect.classList.remove('active');
            }
        });
    }

    /* Delete modal */
    let formToDelete = null;

    const deleteModal = document.getElementById('deleteModal');
    const confirmBtn = document.getElementById('confirmDelete');
    const cancelBtn = document.getElementById('cancelDelete');

    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            formToDelete = this;

            if (deleteModal) {
                deleteModal.style.display = 'flex';
            }
        });
    });

    confirmBtn?.addEventListener('click', () => {
        if (formToDelete) {
            formToDelete.submit();
        }
    });

    cancelBtn?.addEventListener('click', () => {
        if (deleteModal) {
            deleteModal.style.display = 'none';
        }
    });

    deleteModal?.addEventListener('click', e => {
        if (e.target === deleteModal) {
            deleteModal.style.display = 'none';
        }
    });

    /* Load more */
    let page = 2;

    document
        .getElementById('load-more-btn')
        ?.addEventListener('click', function () {
            fetch(`/tips/load?page=${page}`)
                .then(res => res.json())
                .then(data => {
                    document
                        .getElementById('tips-container')
                        ?.insertAdjacentHTML('beforeend', data.html);

                    page++;

                    if (!data.hasMore) {
                        this.remove();
                    }
                })
                .catch(error => console.error('Error:', error));
        });

    /* Tip modal */
    const tipModal = document.getElementById('tipModal');
    const closeTipModal = document.querySelector('.tip-modal-close');

    document.addEventListener('click', function (e) {
        const btn = e.target.closest('.open-tip-modal');

        if (!btn || !tipModal) return;

        document.getElementById('modalTitle').textContent = btn.dataset.title;
        document.getElementById('modalDescription').textContent = btn.dataset.description;
        document.getElementById('modalAuthor').textContent = btn.dataset.author;
        document.getElementById('author-avatar').src = btn.dataset.avatar;

        const modalAuthorLink = document.getElementById('modalAuthorLink');

        if (modalAuthorLink) {
            modalAuthorLink.href = btn.dataset.authorUrl;
        }

        const modalImage = document.getElementById('modalImage');
        const modalImageLink = document.getElementById('modalImageLink');

        if (btn.dataset.image) {
            modalImage.src = btn.dataset.image;
            modalImageLink.href = btn.dataset.image;
            modalImageLink.style.display = 'block';
        } else {
            modalImage.src = '';
            modalImageLink.href = '';
            modalImageLink.style.display = 'none';
        }

        tipModal.classList.add('show');
    });

    if (closeTipModal && tipModal) {
        closeTipModal.addEventListener('click', () => {
            tipModal.classList.remove('show');
        });

        tipModal.addEventListener('click', e => {
            if (e.target === tipModal) {
                tipModal.classList.remove('show');
            }
        });
    }
});

const categoriesContainer =
    document.getElementById('categoriesContainer');

document
    .getElementById('scrollRight')
    ?.addEventListener('click', () => {

        categoriesContainer.scrollBy({
            left: 250,
            behavior: 'smooth'
        });

    });

document
    .getElementById('scrollLeft')
    ?.addEventListener('click', () => {

        categoriesContainer.scrollBy({
            left: -250,
            behavior: 'smooth'
        });

    });

