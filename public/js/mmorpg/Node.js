export default class Node {
   constructor (square) {
      this.positionX = square.positionX
      this.positionY = square.positionY
      this.visited = false
      this.square = square
      if (this.square.imgKey == 'TREE') {
         this.isBlocked = true
         this.coeff = 10
      } else if (this.square.imgKey == 'WATER') {
         this.isBlocked = true
         this.coeff = 10
      } else if (this.square.imgKey == 'GRASS') {
         this.isBlocked = false
         this.coeff = 1.5
      } else if (this.square.imgKey == 'BUSH') {
         this.isBlocked = false
         this.coeff = 2.5
      } else if (this.square.imgKey == 'GROUND') {
         this.isBlocked = false
         this.coeff = 1
      }

      this.g = 0
      this.h = 0
      this.f = 0
      this.parent = null
   }

   heuristic (parent, destination) {
      this.parent = parent
      this.g = parent.g + 1
      this.h = (Math.abs(this.positionX - destination.positionX) + Math.abs(this.positionY - destination.positionY)) * this.coeff
      this.f = this.g + this.h
   }
}
