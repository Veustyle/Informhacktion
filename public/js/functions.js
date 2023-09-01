// LIENS MENU APPARITION
export function menu_Apparition (arrayLiens) {
   for (let i = 0 ; i < arrayLiens.length ; i++) {
      setTimeout(() => {
         arrayLiens[i].style.opacity = '1'
      }, 200 * (i + 1))
   }
}

// TYPED
export function my_Typed (HTMLElement, phrase) {
   for (let i = 0 ; i < phrase.length ; i++) {
      setTimeout(() => {
         HTMLElement.append(phrase[i])
      }, 60 * (i + 1))
   }
}
export async function my_Typed2 (arrayLiens, arrayPhrasesTyped) {
   for (let i = 0 ; i < arrayLiens.length ; i++) {
      setTimeout(() => {
         my_Typed(arrayLiens[i], arrayPhrasesTyped[i]);
      }, 1200 * (i + 1))
   }
}