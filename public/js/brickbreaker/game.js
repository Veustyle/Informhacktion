import { Breaker } from "./Breaker.js";
import { Ball } from "./Ball.js";
import { Map } from "./Map.js";


let map = new Map(20);
let breaker = new Breaker(9, 23, 3, map.block);
let ball = new Ball(9, 22, 10, map.block, 4, breaker, map);

let gameLoop = () => {
   map.createRect(0, 0, map.canvas.width, map.canvas.height, 'black');

   for (let brick of map.listBricks) {
      map.createRect(brick.x + brick.outterBrick, brick.y + brick.outterBrick, brick.innerBrick, brick.innerBrick, 'white');
   }

   map.createRect(breaker.x, breaker.y, map.block * breaker.size, map.block, 'blue');

   map.createBall(ball.x + map.block / 2, ball.y + map.block / 2, ball.rayon, 'green');
   ball.moveProcess();
}
let gameLoopInterval = setInterval(gameLoop, 1000 / 30);


document.addEventListener('keydown', event => {
   event.preventDefault();
   switch (event.key) {
      case 'ArrowUp':
         break;
      case 'ArrowLeft':
         if (breaker.x > 0) {
            breaker.x -= 20;
         }
         break;
      case 'ArrowDown':
         break;
      case 'ArrowRight':
         if (breaker.x < map.canvas.width - breaker.size * map.block) {
            breaker.x += 20;
         }
         break;
      case 's':
         clearInterval(gameLoopInterval);
         break;
   }
})