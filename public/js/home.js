import { menu_Apparition } from "./functions.js";

// MODALS
let modalLogin = document.getElementById('my-modal-login');
let linkLogin = document.querySelectorAll('#modal-link-login');
let modalRegister = document.getElementById('my-modal-register');
let linkRegister = document.querySelectorAll('#modal-link-register');


// NAVBAR & FOOTER
const navbar = document.getElementById('navbar');
const footer = document.getElementById('footer');

let lastScrollTop = 0;

window.addEventListener('scroll', function () {
   const scrollTop = window.scrollY || this.document.documentElement.scrollTop;

   if (scrollTop > (lastScrollTop)) {
      navbar.style.top = '-45px';
      footer.style.bottom = '0';
   } else {
      navbar.style.top = '0';
      footer.style.bottom = '-30px';
   }
   lastScrollTop = scrollTop;
})


// MENU DEROULANT
const svgList = document.querySelector('.menu1 svg');
const svgExit = document.querySelector('.menu2 svg');
const menuFutur = document.querySelector('.menu-deroulant');
const arrayLiensMenuDeroulant = Array.from(document.querySelectorAll('.menu-deroulant a'));

svgExit.style.display = "none";
menuFutur.style.display = "none";

// SVG LIST
svgList.addEventListener('click', () => {

   svgList.animate([
         {opacity: 0},
         {transform: 'rotate(-180deg)'}
      ],
      {
         duration: 500,
         fill: 'forwards'
      })

   setTimeout(() => {
      svgList.style.display = 'none';
      svgExit.style.display = 'inline';
      menuFutur.style.display = "flex";
   }, 300)
   menuFutur.animate([
         {width: 0, height: 0, opacity: 0},
         {width: '300px', height: '400px', opacity: .9},
      ],
      {
         duration: 500,
         fill: "forwards"
      })

   svgExit.animate([
         {opacity: 0},
         {opacity: 1},
         {transform: 'rotate(-180deg)'}
      ],
      {
         duration: 500,
         fill: 'forwards'
      });

   setTimeout(() => {
      menu_Apparition(arrayLiensMenuDeroulant);
   }, 150)
});

// SVG EXIT
svgExit.addEventListener('click', () => {

   menuExit();

   svgList.animate([
         {opacity: 0},
         {opacity: 1},
         {transform: 'rotate(0deg)'}
      ],
      {
         duration: 500,
         fill: 'forwards'
      });

   arrayLiensMenuDeroulant.forEach(lien => {
      lien.style.opacity = '0';
   })
})

document.addEventListener('click', (event) => {
   event.stopPropagation();
   if (event.target !== menuFutur && menuFutur.style.display === "flex") {
      menuExit();
   }
})


// MODALS
linkLogin.forEach(link => {
   link.addEventListener('click', (event) => {
      event.preventDefault();
      modalLogin.style.display = 'block';
      modalRegister.style.display = 'none';
      setTimeout(() => {
         modalLogin.style.opacity = '1';
      }, 100);
   })
})


linkRegister.forEach(link => {
   link.addEventListener('click', (event) => {
      event.preventDefault();
      modalRegister.style.display = 'block';
      modalLogin.style.display = 'none';
      setTimeout(() => {
         modalRegister.style.opacity = '1';
      }, 100)
   })
})


const menuExit = () => {
   svgExit.animate([
         {opacity: 0},
         {transform: 'rotate(0deg)'}
      ],
      {
         duration: 100,
         fill: 'forwards'
      })

   svgExit.style.display = 'none';
   svgList.style.display = 'inline';
   menuFutur.style.display = "none";

   menuFutur.animate([
         {width: '300px', height: '400px'},
         {width: 0, height: 0},
      ],
      {
         duration: 500,
         fill: "forwards"
      })

   svgList.animate([
         {opacity: 0},
         {opacity: 1},
         {transform: 'rotate(0deg)'}
      ],
      {
         duration: 500,
         fill: 'forwards'
      });

   arrayLiensMenuDeroulant.forEach(lien => {
      lien.style.opacity = '0';
   })
}

let closeModals = document.querySelectorAll('#close-modal');

closeModals.forEach(modal => {
   modal.addEventListener('click', () => {
      modalRegister.style.display = 'none';
      modalRegister.style.opacity = '0';
      modalLogin.style.display = 'none';
      modalLogin.style.opacity = '0';
   })
})