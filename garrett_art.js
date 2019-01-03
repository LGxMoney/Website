/*This function takes a painting and modifies it's price and opacity
*This function currently toggles off the price depending on a hover-over
*I found it fun to run your mouse over them quickly. Since the price is in the
*middle, it can call the function twice in one swipe
*I may change this eventually but I was having a lot of fun with it for now
*/

function changeVisibility(painting)
{
 
   var priceID = painting + "p";
   var painting = document.getElementById(painting);
   price = document.getElementById(priceID);
   
   //if it has changed bring it back to normal
   if(painting.style.opacity == "0.5")
   {
      painting.style.opacity = 1;
      price.style.display = "none";
   }
   //if it hasn't been changed, change it
   else
   { 
      painting.style.opacity = 0.5;
      price.style.display = "block";
   }
}


