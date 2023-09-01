export class Ball  {

   constructor (x, y, rayon, block, speed, breaker, map) {
      this.breaker = breaker;
      this.map = map;
      this.speed = speed;
      this.block = block;
      this.x = x * this.block;
      this.y = y * this.block;
      this.rayon = rayon;
      this.direction = 'TOP-LEFT';
   }

   moveProcess () {
      this.trajectoire();

      switch (this.direction) {
         case 'TOP-LEFT':
            this.y -= this.speed;
            this.x -= this.speed;
            break;
         case 'TOP-RIGHT':
            this.y -= this.speed;
            this.x += this.speed;
            break;
         case 'BOTTOM-LEFT':
            this.y += this.speed;
            this.x -= this.speed;
            break;
         case 'BOTTOM-RIGHT':
            this.y += this.speed;
            this.x += this.speed;
            break;
      }


   }

   trajectoire () {
      if (this.checkCollisions()) {
         switch (this.direction) {
            case 'TOP-RIGHT':
               if (this.x >= this.map.canvas.width - this.block) {
                  this.direction = 'TOP-LEFT';
               } else {
                  this.direction = 'BOTTOM-RIGHT';
               }
               break;
            case 'TOP-LEFT':
               if (this.x <= 0) {
                  this.direction = 'TOP-RIGHT';
               } else {
                  this.direction = 'BOTTOM-LEFT';
               }
               break;
            case 'BOTTOM-RIGHT':
               if (this.x >= this.map.canvas.width - this.block) {
                  this.direction = 'BOTTOM-LEFT';
               } else {
                  this.direction = 'TOP-RIGHT';
               }
               break;
            case 'BOTTOM-LEFT':
               if (this.x <= 0) {
                  this.direction = 'BOTTOM-RIGHT';
               } else {
                  this.direction = 'TOP-LEFT';
               }
               break;
         }
      }

   }
   checkCollisions() {
      if (this.getMapX() === this.breaker.getMapX() - 1 && this.getMapY() === this.breaker.getMapY() - 1 || this.getMapX() === this.breaker.getMapX() && this.getMapY() === this.breaker.getMapY() - 1 || this.getMapX() === this.breaker.getMapX() + 1 && this.getMapY() === this.breaker.getMapY() - 1 || this.getMapX() === this.breaker.getMapX() + 2 && this.getMapY() === this.breaker.getMapY() - 1) {
         return true;
      }
      for (let brick of this.map.listBricks) {
         if (this.getMapX() === brick.getMapX() && this.getMapY() === brick.getMapY()) {
            let brik = this.map.listBricks.find(b => b.getMapX() === this.getMapX() && b.getMapY() === this.getMapY());
            this.map.listBricks = this.map.listBricks.filter(b => b !== brik);
            return true;
         }
      }
      if (this.x < 0 || this.x > this.map.canvas.width - this.block || this. y < 22 || this.y > this.map.canvas.height - this.block) {
         return true;
      }
      return false;
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