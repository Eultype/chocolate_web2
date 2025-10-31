document.addEventListener('DOMContentLoaded', () => {
    // Seuils pour déclencher différentes animations/effets
    const scrollThresholdSVG = 0;
    const scrollThresholdNavbar = window.innerHeight * 0.95;

    // Effet Parallax
    const parallaxItems = document.querySelectorAll('[data-parallax-speed]');
    let initialPositions = [];
    parallaxItems.forEach(item => {
        initialPositions.push(item.getBoundingClientRect().top + window.scrollY);
    });

    // Gestion du menu latéral
    const sideMenu = document.getElementById('side-menu');
    const menuOverlay = document.getElementById('menu-overlay');
    const menuBtn = document.getElementById('menu-burger-btn');
    const closeMenuBtn = document.getElementById('close-menu-btn');
    const menuLinks = sideMenu ? sideMenu.querySelectorAll('a') : [];

    const openMenu = () => {
        if (sideMenu && menuOverlay) {
            sideMenu.style.transform = 'translate(0)';
            menuOverlay.style.opacity = '1';
            menuOverlay.style.pointerEvents = 'auto';
            document.body.style.overflow = 'hidden';
        }
    };

    const closeMenu = () => {
        if (sideMenu && menuOverlay) {
            sideMenu.style.transform = 'translateX(100%)';
            menuOverlay.style.opacity = '0';
            document.body.style.overflow = '';
            setTimeout(() => {
                menuOverlay.style.pointerEvents = 'none';
            }, 500);
        }
    };

    if (menuBtn) {
        menuBtn.addEventListener('click', openMenu);
    }
    if (closeMenuBtn) {
        closeMenuBtn.addEventListener('click', closeMenu);
    }
    if (menuOverlay) {
        menuOverlay.addEventListener('click', closeMenu);
    }
    menuLinks.forEach(link => {
        link.addEventListener('click', closeMenu);
    });

    // Gestions scrol & Parallax
    window.addEventListener('scroll', () => {
        const scrollY = window.scrollY;

        // Animation déclenchée par le scroll (SVG + classe body + séparateur)
        if (scrollY > scrollThresholdSVG) {
            document.body.classList.add('animation-triggered');
            const separator = document.querySelector('#separator-lines');
            if (separator) separator.style.opacity = 0;
        } else {
            document.body.classList.remove('animation-triggered');
            const separator = document.querySelector('#separator-lines');
            if (separator) {
                setTimeout(() => {
                    separator.style.opacity = 1;
                }, 1000);
            }
        }

        // Parallax
        parallaxItems.forEach((item, index) => {
            const speed = parseFloat(item.getAttribute('data-parallax-speed')) || 1.0;
            if (scrollY > scrollThresholdNavbar) {
                const translateY = (scrollY - scrollThresholdNavbar) * (1 - speed);
                item.style.transform = `translateY(${translateY}px) translateZ(0)`;
            } else {
                item.style.transform = 'none';
            }
        });
    });
});