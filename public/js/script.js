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

                    countSpan.classList.remove('bump');
                    void countSpan.offsetWidth;
                    countSpan.classList.add('bump');
                }

                if (heart) {
                    heart.classList.toggle('liked', data.liked);

                    heart.classList.remove('animate');
                    void heart.offsetWidth;
                    heart.classList.add('animate');

                    setTimeout(() => {
                        heart.classList.remove('animate');
                    }, 550);
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

let currentTipId = null;

const tipModal = document.getElementById('tipModal');
const modalTitle = document.getElementById('modalTitle');
const modalDescription = document.getElementById('modalDescription');
const modalImage = document.getElementById('modalImage');
const modalAuthor = document.getElementById('modalAuthor');
const authorAvatar = document.getElementById('author-avatar');
const modalComments = document.getElementById('modalComments');
const commentForm = document.getElementById('commentForm');
const commentContent = document.getElementById('commentContent');
const modalCommentsCount = document.getElementById('modalCommentsCount');

document.querySelectorAll('.open-tip-modal').forEach(button => {
    button.addEventListener('click', e => {
        e.preventDefault();

        currentTipId = button.dataset.tipId;

        modalTitle.textContent = button.dataset.title;
        modalDescription.textContent = button.dataset.description;
        modalAuthor.textContent = button.dataset.author;
        authorAvatar.src = button.dataset.authorAvatar;

        if (button.dataset.image) {
            modalImage.src = button.dataset.image;
            modalImage.style.display = 'block';
        } else {
            modalImage.style.display = 'none';
        }
        if (modalCommentsCount) {
            modalCommentsCount.textContent = button.dataset.commentsCount || 0;
        }

        tipModal.classList.add('show');

        loadComments(currentTipId);
    });
});

function loadComments(tipId) {
    modalComments.innerHTML = '<p class="comments-loading">Loading comments...</p>';

    fetch(`/tips/${tipId}/comments`)
        .then(response => response.json())
        .then(comments => {
            modalComments.innerHTML = '';

            if (comments.length === 0) {
                modalComments.innerHTML = '<p class="no-comments">No comments yet.</p>';
                return;
            }

            comments.forEach(comment => {
                modalComments.insertAdjacentHTML('beforeend', `
                    <div class="comment-item" data-comment-id="${comment.id}">
                        <img src="${comment.user_avatar}" class="comment-avatar" alt="User">

                        <div class="comment-body">
                            <div class="comment-header">
                                <strong>${comment.user_name}</strong>
                                <span>${comment.created_at}</span>
                            </div>

                            <p>${comment.content}</p>

                            ${comment.can_delete ? `
                                <div class="delete-comment-div">
                                <button class="delete-comment-btn" data-comment-id="${comment.id}">
                                    Delete
                                </button>
                                </div>
                            ` : ''}
                        </div>
                    </div>
                `);
            });
        });
}

if (commentForm) {
    commentForm.addEventListener('submit', e => {
        e.preventDefault();

        const content = commentContent.value.trim();

        if (!currentTipId || content === '') return;

        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute('content');

        fetch(`/tips/${currentTipId}/comments`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                content: content
            })
        })
            .then(async response => {
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error(errorText);
                    throw new Error('Error adding comment');
                }

                return response.json();
            })
            .then(() => {
                commentContent.value = '';
                loadComments(currentTipId);
            })
            .catch(error => {
                console.error(error);
                alert('The comment could not be posted.');
            });
    });
}

document.addEventListener('click', e => {
    if (e.target.classList.contains('delete-comment-btn')) {
        const commentId = e.target.dataset.commentId;

        fetch(`/comments/${commentId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute('content')
            }
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error deleting comment');
                }

                loadComments(currentTipId);
            });
    }
});
document.querySelectorAll('.emoji-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        commentContent.value += btn.textContent;
        commentContent.focus();
    });
});

document.addEventListener('click', async function (e) {
    const shareBtn = e.target.closest('.share-section');

    if (!shareBtn) return;

    e.preventDefault();
    e.stopPropagation();

    const title = shareBtn.getAttribute('data-title') || 'EcoGuide Tip';
    const description = shareBtn.getAttribute('data-description') || '';
    const url = shareBtn.getAttribute('data-url') || window.location.href;

    const shareData = {
        title: title,
        text: `${description}\n\nShared from EcoGuide`,
        url: url
    };

    try {
        if (navigator.share && navigator.canShare && navigator.canShare(shareData)) {
            await navigator.share(shareData);
            return;
        }

        if (navigator.share) {
            await navigator.share({
                title: title,
                text: shareData.text,
                url: url
            });
            return;
        }

        const textToCopy = `${title}\n\n${description}\n\n${url}`;

        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(textToCopy);
        } else {
            const textarea = document.createElement('textarea');
            textarea.value = textToCopy;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        }

        alert('Tip copied to clipboard.');

    } catch (error) {
        console.error('Share error:', error);
    }
});

document.addEventListener('click', function (e) {

    const commentBtn = e.target.closest('.open-comments-modal');

    if (!commentBtn) return;

    const tipId = commentBtn.dataset.tipId;

    // Buscar el botón See Tip de esa misma card
    const seeTipBtn = commentBtn
        .closest('.cards')
        .querySelector('.open-tip-modal');

    if (!seeTipBtn) return;

    // Abrir modal existente
    seeTipBtn.click();

    // Esperar a que termine de cargarse
    setTimeout(() => {

        const commentsSection =
            document.querySelector('.comments-section');

        if (commentsSection) {

            commentsSection.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });

        }

        const textarea =
            document.querySelector('#commentContent');

        if (textarea) {
            textarea.focus();
        }

    }, 300);

});