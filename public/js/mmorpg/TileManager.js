export default class TileManager {

   static listFile = {};

   static async tilesCut (file, nombreElementX, nombreElementY, tilesNames) {

      let result = await fetch(`../../img/mmorpg/${file}.png`);
      TileManager.listFile[file] = {full: await createImageBitmap(await result.blob()), listItems: {}};
      let tailleImgX = TileManager.listFile[file].full.width / nombreElementX;
      let tailleImgY = TileManager.listFile[file].full.height / nombreElementY;

      let arrayPosition = 0;
      for (let x = 0 ; x < nombreElementX ; x++) {
         for (let y = 0 ; y < nombreElementY ; y++) {
            let temp = tilesNames[arrayPosition]
            arrayPosition++
            TileManager.listFile[file].listItems[temp] = await createImageBitmap(TileManager.listFile[file].full, tailleImgX * x, tailleImgY * y, tailleImgX, tailleImgY)
         }
      }
   }

   static getTile(file, tileName) {
      return TileManager.listFile[file]?.listItems[tileName];
   }
}