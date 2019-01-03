/**
*This function takes a source, header, and arrow
*It uses the source to change the header, arrow, and body.
*Takes a double click to actually cause change
*/
function dropDown(item, head, arrow)
{ 
  //Variables to grab from our document
  var currentHead = document.getElementById(head);
  var currentItem = document.getElementById(item);
  var currentArrow = document.getElementById(arrow);
  //test if the item is hidding or not
  //if it's not equal to none make it
    if(currentItem.style.display == "none")
    {  //show if it wasn't shown
       currentItem.style.display = "block";
       currentItem.style.opacity = "100%";
    }
    else
    {  //hide otherwise
       currentItem.style.display = "none";
       currentItem.style.opacity = "0%";
    }
    if(currentHead.style.width == "23%")
    {  //grow the head and flip the arrow
       currentHead.style.width = "85%";
       currentArrow.style = "transform: rotate(180deg);";
    }
    else
    {  //shrink the head and flip the arrow
       currentHead.style.width = "23%";
       currentArrow.style = "transform: rotate(0deg);";
    }

}

//Arrays to store our image paths
var cases = [];
   cases[0] = 'hardware/Prints/BBB.JPG';
   cases[1] = 'hardware/Prints/BBB2.JPG';
   cases[2] = 'hardware/Prints/gearcase.JPG';
   var i = 0;

var instruments = [];
   instruments [0] = 'imgs/prints/ocarina.JPG';
   instruments [1] = 'imgs/prints/reedpipes.JPG';
   instruments [2] = 'imgs/prints/ukelele.JPG';
   var j = 0;

var acc = [];
   acc [0] = 'hardware/Prints/watch4.JPG';
   acc [1] = 'hardware/Prints/doordec.JPG';
   acc [2] = 'hardware/Prints/doorstop.JPG';
   acc [3] = 'hardware/Prints/bagcloser.JPG';
   var k = 0;

var fun = [];
   fun [0] = 'hardware/Prints/yoda.JPG';
   fun [1] = 'imgs/prints/raider.jpg';
   fun [2] = 'imgs/prints/cylon.jpeg';
   fun [3] = 'imgs/prints/boba.jpg';
   var l = 0;
/*
*Takes the source of input, the direction we are going
*and the array we are grabbing from
*/
function changePicture(source, direction, array)
{
   //test if it's the first array: case array
   if(array == 0)
   {  //if we are moving right
      if(direction == 1)
      {//test for boundaries and reset to 0 if we go over
         if(i < cases.length - 1)
           i++;
         else 
           i = 0;
      }//if we are moving left
      else
      {
         if(i > 0)
           i--;
         else
           i = cases.length -1;
      } //change the picture once we know which one we want to display
      document.getElementById(source).setAttribute("src", cases[i]);
    //get out of the function
    return;
   }
   //test the same cases above but with a different array - instruments
   if(array == 1)
   {  
      if(direction == 1)
      {
         if(j < instruments.length - 1)
           j++;
         else 
           j = 0;
      }
      else
      {
         if(j > 0)
           j--;
         else
           j = instruments.length -1;
      }    
      document.getElementById(source).setAttribute("src", instruments[j]);
      return;
   }
   //test the same cases above but with a different array - accessories
   if(array == 2)
   {  
      if(direction == 1)
      {
         if(k < acc.length - 1)
           k++;
         else 
           k = 0;
      }
      else
      {
         if(k > 0)
           k--;
         else
           k = acc.length -1;
      }    
      document.getElementById(source).setAttribute("src", acc[k]);
      return;
   }
   //test the same cases aboce but with a different array - fun
   if(array == 3)
   {  
      if(direction == 1)
      {
         if(l < fun.length - 1)
           l++;
         else 
           l = 0;
      }
      else
      {
         if(l > 0)
           l--;
         else
           l = fun.length -1;
      }    
      document.getElementById(source).setAttribute("src", fun[l]);
      return;
   }
}

