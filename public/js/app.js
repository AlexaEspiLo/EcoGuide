const menuToggle = document.getElementById('menuToggle');
const navMenu = document.querySelector('.nav-center');

if(menuToggle && navMenu){

    menuToggle.addEventListener('click', () => {

        menuToggle.classList.toggle('active');
        navMenu.classList.toggle('show');

    });

    document.addEventListener('click', (e) => {

        if(
            !menuToggle.contains(e.target) &&
            !navMenu.contains(e.target)
        ){
            menuToggle.classList.remove('active');
            navMenu.classList.remove('show');
        }

    });

}

const navSearchBtn = document.getElementById('navSearchBtn');
const navSearchForm = document.getElementById('navSearchForm');
const navSearchInput = document.querySelector('.nav-search-input');

if (navSearchBtn && navSearchForm && navSearchInput) {
    navSearchBtn.addEventListener('click', () => {
        navSearchForm.classList.toggle('show');

        if (navSearchForm.classList.contains('show')) {
            navSearchInput.focus();
        }
    });

    document.addEventListener('click', e => {
        if (
            !navSearchBtn.contains(e.target) &&
            !navSearchForm.contains(e.target)
        ) {
            navSearchForm.classList.remove('show');
        }
    });
}

const accountBtn = document.getElementById('accountBtn');
const accountMenu = document.getElementById('accountMenu');

if (accountBtn && accountMenu) {
    accountBtn.addEventListener('click', () => {
        accountMenu.classList.toggle('show');
    });

    document.addEventListener('click', e => {
        if (
            !accountBtn.contains(e.target) &&
            !accountMenu.contains(e.target)
        ) {
            accountMenu.classList.remove('show');
        }
    });
}