import Canvas from "./Canvas.js";
import TileManager from "./TileManager.js";
import Square from "./Square.js";
import Character from "./Character.js";
import Grid from "./Grid.js";

export default class Map {

   listSquare = [];

   async loadMap (file) {
      this.canvas = new Canvas(document.querySelector('#static-canvas'));
      this.canvas2 = new Canvas(document.querySelector('#char-canvas'));

      let tilesNamesMap = ['TREE', 'GRASS', 'WATER', 'BUSH', 'GROUND']
      let tilesNamesChar = ['BOTTOM0', 'LEFT0', 'RIGHT0', 'TOP0', 'BOTTOM1', 'LEFT1', 'RIGHT1', 'TOP1', 'BOTTOM2', 'LEFT2', 'RIGHT2', "TOP2"]

      await TileManager.tilesCut('decor3', 5, 1, tilesNamesMap);
      await TileManager.tilesCut('personnage', 3, 4, tilesNamesChar);

      let datas = await fetch(`/js/mmorpg/${file}.json`);
      let map = await datas.json();
      Object.assign(this, map);

      this.canvas.setGrid(this.size);
      this.canvas2.setGrid(this.size);
      this.grid = new Grid(this.listSquare, this.size)


      for (let i = 0 ; i < this.listSquare.length ; i++) {
         this.listSquare[i] = new Square(this.listSquare[i].x, this.listSquare[i].y, this.listSquare[i].imgKey)
      }
      for (let square of this.listSquare) {
         this.canvas.draw(TileManager.getTile('decor3', square.imgKey), square);
      }

      let char = new Character(6, 6)
      this.canvas2.draw(TileManager.getTile('personnage', "BOTTOM0"), char)
      this.addListeners(char)
   }

   addListeners (char) {
      let charAnimation = 0
      document.addEventListener("keydown", (event) => {
         event.preventDefault();
         this.canvas2.context.clearRect(0,0, this.canvas2.canvas.width, this.canvas2.canvas.height)
         charAnimation++
         if (charAnimation > 2) {
            charAnimation = 0
         }
         if (event.key == "ArrowDown") {
            char.positionY++
            if (char.positionY > (this.size.height - 1)) {
               char.positionY = 0
            }
            this.canvas2.draw(TileManager.getTile('personnage', "BOTTOM"+charAnimation), char)
         }
         if (event.key == "ArrowUp") {
            char.positionY--
            if (char.positionY < 0) {
               char.positionY = (this.size.height - 1)
            }
            this.canvas2.draw(TileManager.getTile('personnage', "TOP"+charAnimation), char)
         }
         if (event.key == "ArrowLeft") {
            char.positionX--
            if (char.positionX < 0) {
               char.positionX = (this.size.width - 1)
            }
            this.canvas2.draw(TileManager.getTile('personnage', "LEFT"+charAnimation), char);
         }
         if (event.key == "ArrowRight") {
            char.positionX++
            if (char.positionX > this.size.width - 1) {
               char.positionX = 0
            }
            this.canvas2.draw(TileManager.getTile('personnage', "RIGHT"+charAnimation), char);
         }
      })

      this.canvas2.canvas.addEventListener('click', event => {
         let destX = Math.floor((event.x) / window.innerWidth * this.size.width)
         let destY = Math.floor((event.y - 120) / this.canvas2.canvas.height * this.size.height)

         let origin = this.listSquare.filter(square => square.positionX == char.positionX && square.positionY == char.positionY)[0]
         let destination = this.listSquare.filter(square => square.positionX == destX && square.positionY == destY)[0]

         let path = this.grid.getPath(origin, destination)

         for (let i = 1 ; i < path.length ; i++) {
            setTimeout(() => {
               this.canvas2.context.clearRect(0,0, this.canvas2.canvas.width, this.canvas2.canvas.height)

               let lastX = char.positionX
               let lastY = char.positionY

               char.positionX = path[i].positionX
               char.positionY = path[i].positionY
               let position = ""
               if (char.positionX < lastX) {
                  position = 'LEFT'
               } else if (char.positionX > lastX) {
                  position = 'RIGHT'
               } else if (char.positionY < lastY) {
                  position = 'TOP'
               } else if (char.positionY > lastY) {
                  position = 'BOTTOM'
               }
               this.canvas2.drawFramed(char, 10, position)
            }, 960 * (i-1))
         }
      })
   }
}