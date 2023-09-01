import { Brick } from "./Brick.js";

export class Map {

   canvas = document.querySelector('canvas');
   context = this.canvas.getContext('2d');
   block = 20;
   listBricks = [];

   constructor () {
      this.createBricks();
   }

   createBricks () {
      for (let x = 0; x < this.canvas.width / this.block; x++) {
         for (let y = 0 ; y < 8 ; y++) {
            this.listBricks.push(new Brick(x, y, this.block));
         }
      }
   }
   createRect = (x, y, width, height, color) => {
      this.context.fillStyle = color;
      this.context.fillRect(x, y, width, height);
   }
   createBall = (x, y, rayon, color) => {
      this.context.beginPath();
      this.context.arc(x, y, rayon, 0, Math.PI * 2);
      this.context.fillStyle = color;
      this.context.fill();
      this.context.closePath();
   }
}