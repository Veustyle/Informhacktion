export default class Square {

   constructor (x, y, imgKey) {
      this.positionX = x;
      this.positionY = y;
      this.imgKey = imgKey;
   }

   static getSquare (x, y) {
      return new Square(x, y, 'GRASS')
   }
}