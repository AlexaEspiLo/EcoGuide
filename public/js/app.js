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