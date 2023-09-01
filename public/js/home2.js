import { my_Typed2 } from "./functions.js";

// TEXTE QUI S'ÉCRIT TOUT SEUL
const phrasesTyped = [
   'HTML, CSS (+Bootstrap)',
   'PHP (+Symfony), SQL',
   'Javascript (+ReactJS)',
   'Outils : Git, Composer, Webpack, PHPStorm',
]
const arrayLiensTyped = Array.from(document.querySelectorAll('.typed-div p'));
my_Typed2(arrayLiensTyped, phrasesTyped);


// EFFETS APPARITION
const observer = new IntersectionObserver(entries => {
   entries.forEach(entry => {
      if(entry.isIntersecting) {
         entry.target.style.transform = 'translateX(0px)';
      } else {
         entry.target.style.transform = 'translateX(-200px)';

      }
   })
})
observer.observe(document.querySelector('h2'));
observer.observe(document.querySelector('#langages'));

const observer2 = new IntersectionObserver(entries => {
   entries.forEach(entry => {
      if(entry.isIntersecting) {
         entry.target.style.transform = 'translateX(0px)';
      } else {
         entry.target.style.transform = 'translateX(200px)';

      }
   })
})
observer2.observe(document.querySelector('h1'));
observer2.observe(document.querySelector('#formation'));



// COMPTEUR LIVE
Array.from(document.querySelectorAll('.counter-value')).forEach(counter => {
   let timeouts = []
   let limite = parseInt(counter.getAttribute('data-count'))
   const endTime = 1000; // 1000 millisecondes = 1 seconde
   const increment = limite / endTime; // le nombre à incrémenter à chaque intervalle de temps

   for (let i = 0 ; i <= limite ; i += increment) {
      const timeout = setTimeout(() => {

         counter.innerHTML = Math.floor(i);

         if (i >= limite) {
           for (let j = 0; j < timeouts.length; j++) {
             clearTimeout(timeouts[j]);
           }
         }
      }, i / increment * 10);
      timeouts.push(timeout);
    }
})