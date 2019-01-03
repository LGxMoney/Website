<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>Garrett Money</title>
        <link rel="stylesheet" href="G_feature_page.css">
        <script src="garrett_javascript.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Abel%7cNews+Cycle%7cPlayball%7cPoiret+One%7cQuicksand" rel="stylesheet">
    </head>
<body>
<div class="logo"> 
	<a href="garrett_home.html">
	    <img id="logo" alt="G$" src="imgs/modernlogo.PNG">
	</a>
</div>
<nav>
	<ul>

	    <li><a href="garrett_art.html">art</a></li>
	    <li><a href="garrett_tech.html">technology</a></li>
	    <li><a class ="active" href="garrett_business.html">business</a></li>
	    <li><a href="garrett_contact.html">contact</a></li>
	</ul>
</nav>
<div class="bar">  </div>
<img alt="profile picture" class="profile" src="imgs/thanks.JPG">

<div class="description">
    <h1>THANK YOU!!!</h1>
    <h3>Your order has been submitted to Garrett Money!</h3>
     <p>To see what other people have ordered, click <a href="\/ice.truman.edu/~gam3281/showPaintOrders.php">here</a></p>
</div>

<div class="sidepad"></div>
<div class="sidebox"></div>
    
<div id="form_results"> 
   <?php
//Data to store the form results using POST
     $name =  htmlspecialchars($_POST['name']);
     $email =  htmlspecialchars($_POST['email']);
     $phone =  htmlspecialchars($_POST['phone']);
     $city =  htmlspecialchars($_POST['city']);
     $state =  htmlspecialchars($_POST['state']);
     $zip =  htmlspecialchars($_POST['zip']);
     $address =  htmlspecialchars($_POST['address']);
     $width =  htmlspecialchars($_POST['width']);
     $height =  htmlspecialchars($_POST['height']);
     $source =  htmlspecialchars($_POST['source']);
     $comment =  htmlspecialchars($_POST['comment']);
     $valid = true;
//ensures all alpha characters with potentially two names
     if(preg_match("/[A-z]+ ?[A-z]+/",$name)) 
     {}
     else
     {   
        $errors .= "name, ";
        $valid = false;
     }
//ensures the format of an email with @ in the middle and a .tag at the end
     if(preg_match("/.+\@{1}.+\.{1}(com|net|org|gov|edu)$/", $email))
     {}
     else
     {
        $errors .= "email, ";
        $valid = false;
     }
//ensures (,),-, are accounted for depending on format entered
     if(preg_match("/([0-9]|\-|\(|\)| ){10,}/", $phone))
     {}
     else
     {
        $errors .= "phone, ";
        $valid = false;
     }
//Normal alphabetical word but with a potential . for things like St. Louis
     if(preg_match("/[A-z]+\.?\s?[A-z]+/", $city))
     {}
     else
     {
        $errors .= "city, ";
        $valid = false;
     }
//5 digits
     if(preg_match("/[0-9]{5}/", $zip))
     {}
     else
     {
        $errors .= "zip, ";
        $valid = false;
     }
//2 digits
     if(preg_match("/[0-9]{1,2}/", $width))
     {}
     else
     {  
        $errors .= "width, ";
        $valid = false;
     }
//2 digits
     if(preg_match("/[0-9]{1,2}/", $height))
     {}
     else
     {
        $errors .= "height, ";
        $valid = false;
     }
//if source is checked or not
     if(!isset($source))
     { 
       $valid = false;
       $errors .= " source.";
     } 
//if everything essential is there, process the form with no issues
    if($valid == true)
    {
      insertIntoDatabase();
      echo "<h2> Form Results </h2>";
      echo "<table  id=\"order_details\"><td><h3>Contact Information</h3>";
      echo "<p> Name: ";
      echo $name;
      echo "<br> Email: ";
      echo $email;
//format the phone number better
      echo "<br>Phone: ("; 
      echo substr($phone, 0, 3);
      echo ")"; 
      echo substr($phone, 3, 3);
      echo "-";
      echo substr($phone, 6, 4);
      echo "<br> Location: <br>";
//display address as one location
      echo $address;
      echo "<br>";
      echo $city;
      echo ", "; 
      echo $state; 
      echo " ";
      echo $zip;
      echo "<br></p></td>";
      }
      else 
      {
         echo "<h2> ERROR </h2> <p>The form was submitted incorrectly, please resubmit the following fields with the correct format: </p>";
         echo $errors;
      }
//check radio if source was local
      if($source == "gallery")
      {//variables to store if found a match or not
        $target = $_POST['gallery_link'];
        $target = "painting/" . $target . ".jpg";
       
        $found = "none";
        $files = glob("painting/*");
//search painting directory to find if the title matches any
        foreach($files as $potential)
        {
           if($target == $potential)
           { 
             $found = $potential;
           }
        } 
        echo "<td><h3>Order Details </h3>";
        echo "You have selected $found! <br>";
//if you found a painting match, display it!
        if($found != "none")
        {
              echo "<img alt=\"Selected image\" 
              width=\"300px\" 
              height=\"250px\" id=\"found_img\" 
              src=\"$found\">";
        }
     }
//create link out of entered text
     if($source == "ross")
     {
        $ross_link = $_POST['html_link'];
        echo "<td><h3>Order Details </h3>";
        echo "You have selected an online video: <a href=\"$ross_link\">URL</a>"; 

     }
     if($source == "landscape")
     {  
       $img_link = $_POST['links'];
       echo "<td><h3>Order Details </h3>";
       echo "You have selected an image: <a href=\"$img_link\">URL</a>";
     }
//ensure width and height are positive non-zeroes
    if($width > 0 && $height > 0)
    {    $total = $width * $height * .25;
         echo "<br> You specified your dimensions to be 
         $width\" wide by $height\" tall <br>";
         echo "This brings the total cost to: \$$total <br>";
         echo "Your order will be shipped to you free 
          of charge within the next two weeks!";
    }
    else
    { 
         echo "There cannot be a negative dimension in this realm!";
    }
    $comment = htmlspecialchars($comment);
    print "<p><strong>Additional specifications</strong>: $comment </p>";

   function insertIntoDatabase()
   {
 
     $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
     $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
     $phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
     $city = filter_var($_POST['city'], FILTER_SANITIZE_STRING);
     $state = filter_var($_POST['state'], FILTER_SANITIZE_STRING);
     $zip = filter_var($_POST['zip'], FILTER_SANITIZE_STRING);
     $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
     $width = filter_var($_POST['width'], FILTER_SANITIZE_STRING);
     $height = filter_var($_POST['height'], FILTER_SANITIZE_STRING);
     $source = filter_var($_POST['source'], FILTER_SANITIZE_STRING);
     $comment = filter_var($_POST['comment'], FILTER_SANITIZE_STRING);

     if($source == "gallery")
     {
       $source = $_POST['gallery_link'];
     }
     if($source == "ross")
     {
       $source = $_POST['html_link'];
     }
     if($source == "landscape")
     {
       $source = $_POST['links'];
     }


     try 
    {
       //establish connections
       $connection = new PDO("mysql:host=mysql.truman.edu;dbname=gam3281CS315", "gam3281", "iojiehah");
       $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       // prepare sql and bind parameters
       $statement = $connection->prepare("INSERT INTO PaintingOrders (name, email, phone, city, state, zip, address, width, height, source, comment)
    VALUES (:name, :email, :phone, :city, :state, :zip, :address, :width, :height, :source, :comment)");

       $statement->bindParam(':name', $name);
       $statement->bindParam(':email', $email);
       $statement->bindParam(':phone', $phone);
       $statement->bindParam(':city', $city);
       $statement->bindParam(':state', $state);
       $statement->bindParam(':zip', $zip);
       $statement->bindParam(':address', $address);
       $statement->bindParam(':width', $width);
       $statement->bindParam(':height', $height);
       $statement->bindParam(':source', $source);
       $statement->bindParam(':comment', $comment);

    $statement->execute();
}
catch(PDOException $error)
    {
     echo "Something went wrong: " . $error->getMessage();
    }

// end the DB connection.
$connection = null;
    
   }
    ?>

</div>
</body>
</html>

            
            
