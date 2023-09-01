import TileManager from "./TileManager.js";

export default class Canvas {

   constructor (element) {
      this.canvas = element
      this.context = this.canvas.getContext('2d');

      this.canvas.width = this.canvas.offsetWidth;
      this.canvas.height = this.canvas.offsetHeight;
   }

   setGrid (mapSize) {
      this.tailleCaseX = this.canvas.width / mapSize.width;
      this.tailleCaseY = this.canvas.height / mapSize.height;
   }

   draw (image, square) {
      this.context.drawImage(image, 0, 0, image.width, image.height, square.positionX * this.tailleCaseX, square.positionY * this.tailleCaseY, this.tailleCaseX, this.tailleCaseY);
   }
   drawFramed(square, frames, position) {
      let calculX = square.positionX * this.tailleCaseX;
      let calculY = square.positionY * this.tailleCaseY;
      let charAnimation = 0

      for (let i = frames; i > 1; i--) {
         charAnimation++
         if (charAnimation > 2) {
            charAnimation = 0
         }
         let image = TileManager.getTile('personnage', position+charAnimation);

         const drawFrame = (compteur) => {
            setTimeout(() => {
               if (position === "TOP") {
                  calculY = square.positionY * this.tailleCaseY + (i / frames * this.tailleCaseY);
               } else if (position === "BOTTOM") {
                  calculY = square.positionY * this.tailleCaseY - (i / frames * this.tailleCaseY);
               } else if (position === "LEFT") {
                  calculX = square.positionX * this.tailleCaseX + (i / frames * this.tailleCaseX);
               } else if (position === "RIGHT") {
                  calculX = square.positionX * this.tailleCaseX - (i / frames * this.tailleCaseX);
               }
               this.context.clearRect(0, 0, this.canvas.width, this.canvas.height);
               this.context.drawImage(image, 0, 0, image.width, image.height, calculX, calculY, this.tailleCaseX, this.tailleCaseY);
            }, 110 * compteur);
         }
         drawFrame(frames - i)
      }
   }
}