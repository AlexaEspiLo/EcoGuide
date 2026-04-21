
    document.addEventListener('DOMContentLoaded', function () {
        var openBtn = document.getElementById('openAvatarModal');
        var closeBtn = document.getElementById('closeAvatarModal');
        var modal = document.getElementById('avatarUploadModal');

        if (openBtn && closeBtn && modal) {
            openBtn.addEventListener('click', function () {
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
            });

            closeBtn.addEventListener('click', function () {
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
            });

            modal.addEventListener('click', function (event) {
                if (event.target === modal) {
                    modal.classList.remove('open');
                    modal.setAttribute('aria-hidden', 'true');
                }
            });
        }
    });
