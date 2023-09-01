import Node from "./Node.js";
export default class Grid {

   constructor (listSquares, size) {
      this.listSquares = listSquares
      this.size = size
   }

   getPath(squareOrigin, squareDestination) {
      let origin = new Node(squareOrigin);
      let destination = new Node(squareDestination);

      this.openList = [origin]
      this.closeList = []
      this.path = []

      let hierarchiqueNode = this.searchPath(origin, destination)
      while (hierarchiqueNode !== null) {
         this.path.push(hierarchiqueNode.square)
         hierarchiqueNode = hierarchiqueNode.parent
      }
      return this.path.reverse();
   }

   searchPath(currentNode, destination) {
      if (destination.isBlocked) {
         return null;
      }
      if (currentNode.positionX === destination.positionX && currentNode.positionY === destination.positionY) {
         this.closeList = []
         this.openList = []
         return currentNode;
      }

      if (!this.closeList.some(node => node.positionX === currentNode.positionX && node.positionY === currentNode.positionY)) {
         this.closeList.push(currentNode)
      }

      this.openList = this.openList.filter(node1 => !this.closeList.some(node => node.positionX === node1.positionX && node.positionY === node1.positionY))

      this.pushOpenList(currentNode, destination);
      let checkNode = this.getBestNode()

      if (checkNode !== null) {
         return this.searchPath(checkNode, destination)
      } else {
         this.closeList = []
         return null;
      }
   }

   getBestNode () {
      this.openList = this.openList.sort((a,b) => a.f - b.f)

      if (this.openList.length > 0) {
         return this.openList[0]
      } else {
         return null;
      }
   }
   pushOpenList(parent, destination) {
      if (parent.positionX > 0 && !this.closeList.some(node => node.positionX === parent.positionX - 1 && node.positionY === parent.positionY)) {
         let nodeLeft = new Node(
            this.listSquares.find(square => (square.positionX === parent.square.positionX - 1) && (square.positionY === parent.square.positionY))
         );
         if (!nodeLeft.isBlocked) {
            nodeLeft.heuristic(parent, destination);
            this.openList.push(nodeLeft);
         }
      }
      if (parent.positionX < this.size.width - 1 && !this.closeList.some(node => node.positionX === parent.positionX + 1 && node.positionY === parent.positionY)) {
         let nodeRight = new Node(
            this.listSquares.find(square => (square.positionX === parent.square.positionX + 1) && (square.positionY === parent.square.positionY))
         );
         if (!nodeRight.isBlocked) {
            nodeRight.heuristic(parent, destination);
            this.openList.push(nodeRight);
         }
      }
      if (parent.positionY > 0 && !this.closeList.some(node => node.positionX === parent.positionX && node.positionY === parent.positionY - 1)) {
         let nodeTop = new Node(
            this.listSquares.find(square => (square.positionX === parent.square.positionX) && (square.positionY === parent.square.positionY - 1))
         );
         if (!nodeTop.isBlocked) {
            nodeTop.heuristic(parent, destination);
            this.openList.push(nodeTop);
         }
      }
      if (parent.positionY < this.size.height - 1 && !this.closeList.some(node => node.positionX === parent.positionX && node.positionY === parent.positionY + 1)) {
         let nodeBottom = new Node(
            this.listSquares.find(square => (square.positionX === parent.square.positionX) && (square.positionY === parent.square.positionY + 1))
         );
         if (!nodeBottom.isBlocked) {
            nodeBottom.heuristic(parent, destination);
            this.openList.push(nodeBottom);
         }
      }
      return this.openList;
   }
}