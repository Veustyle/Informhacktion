document.addEventListener('DOMContentLoaded', () => {
   const likeElements = [].slice.call(document.querySelectorAll('a[data-action="like"]'));

   if (likeElements) {
      likeElements.map(element => {
         element.addEventListener('click', event => {
            event.preventDefault();
            axios.get(element.href).then(response => {
               element.parentElement.querySelector('.nb-likes').innerText = response.data.nbLikes;
               element.parentElement.querySelector('.my-display-none').classList.toggle('my-display-none');
               element.classList.toggle('my-display-none');
            });
         })
      })
   }
});