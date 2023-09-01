export class Brick {

   constructor (x, y, block) {
      this.block = block;
      this.x = x * this.block;
      this.y = y * this.block;
      this.outterBrick = 2;
      this.innerBrick = this.block - this.outterBrick * 2;
   }

   getMapX () {
      return Math.floor(this.x / this.block);
   }

   getMapY () {
      return Math.floor(this.y / this.block);
   }

   getMapXRightSide () {
      return Math.floor((this.x * 0.999 + this.block) / this.block);
   }

   getMapYRightSide () {
      return Math.floor((this.y * 0.999 + this.block) / this.block);
   }
}