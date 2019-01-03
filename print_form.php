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
     <p>To see what other people have ordered, click <a href="\/ice.truman.edu/~gam3281/showPrintOrders.php">here</a></p>
</div>
<div class="sidepad"></div>
<div class="sidebox"></div>

<div id="form_results"> 
   <?php
     //variables to store form data
     $name =  htmlspecialchars($_POST['name']);
     $email =  htmlspecialchars($_POST['email']);
     $phone =  htmlspecialchars($_POST['phone']);
     $city =  htmlspecialchars($_POST['city']);
     $state =  htmlspecialchars($_POST['state']);
     $zip =  htmlspecialchars($_POST['zip']);
     $address =  htmlspecialchars($_POST['address']);
     $length =  htmlspecialchars($_POST['length']);
     $width =  htmlspecialchars($_POST['width']);
     $height =  htmlspecialchars($_POST['height']);
     $source =  htmlspecialchars($_POST['source']);
     $comment1 =  htmlspecialchars($_POST['comment1']);
     $plastic =  htmlspecialchars($_POST['plastic']);
     $valid = true;

//regex to test for two names of alpha characters
     if(preg_match("/[A-z]+ ?[A-z]+/",$name)) 
     {}
     else
     {  //this keeps a running total of all error fields
        $errors .= "name, ";
        $valid = false;
     }
//ensures the email has 1 @, then a .<insert branch>
     if(preg_match("/\w+\@\w+\.{1}(com|net|org|gov|edu)$/", $email))
     {}
     else
     {
        $errors .= "email, ";
        $valid = false;
     }
//ensures the phone number could have slashes, dashes, and numbers. Between 10 and 14 long
     if(preg_match("/([0-9]|\-|\(|\)| ){10,}/", $phone))
     {}
     else
     {
        $errors .= "phone, ";
        $valid = false;
     }
//Just letters but accounts for cities with a .
     if(preg_match("/[A-z]+\.?\s?[A-z]+/", $city))
     {}
     else
     {
        $errors .= "city, ";
        $valid = false;
     }
//ensures a 5 digit number
     if(preg_match("/[0-9]{5}/", $zip))
     {}
     else
     {
        $errors .= "zip, ";
        $valid = false;
     }
//ensures 1-2 digit numbers
     if(preg_match("/[0-9]{1,2}/", $width))
     {}
     else
     {  
        $errors .= "width, ";
        $valid = false;
     }
//ensures 1-2 digit numbers
     if(preg_match("/[0-9]{1,2}/", $height))
     {}
     else
     {
        $errors .= "height, ";
        $valid = false;
     }

//ensures 1-2 digit numbers
     if(preg_match("/[0-9]{1,2}/", $length))
     {}
     else
     {
        $errors .= "length, ";
        $valid = false;
     }

//checks to make sure something has been checked
     if(!isset($source))
     { 
       $valid = false;
       $errors .= " source.";
     } 
//if everything essential is there, print out the form
    if($valid == true)
    {
      insertIntoDatabase();
      echo "<h2> Form Results </h2>";
      echo "<table  id=\"order_details\"><td><h3>Contact Information</h3>";
      echo "<p> Name: ";
      echo $name;
      echo "<br> Email: ";
      echo $email;
      echo "<br>Phone: ("; 
      echo substr($phone, 0, 3);
      echo ")"; 
      echo substr($phone, 3, 3);
      echo "-";
      echo substr($phone, 6, 4);
      echo "<br> Location: <br>";
      $address = htmlspecialchars($address);
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
      {    echo "<h2> ERROR </h2> <p>The form was submitted incorrectly, please resubmit the following fields with the correct format: </p>";
         echo $errors;
      }
//print if radio button on source was from site
     if($source == "tech")
     {
        $item = $_POST['tech1'];
        $item = htmlspecialchars($item);
        echo "<td><h3>Order Details </h3>";
        echo "You selected something from the site called $item";
     }

//if radio button on source was from thingiverse process link
     if($source == "thing")
     {
        $link = $_POST['link'];
        $link = htmlspecialchars($link);
        echo "<td><h3>Order Details </h3>";
        echo "You have selected a link from thingiverse <a href=\"$link\">URL</a>"; 
     }
//process link given
     if($source == "g_imgs")
     {  
        $g_img = $_POST['g_img'];
        $g_img = htmlspecialchars($g_img);
        echo "<td><h3>Order Details </h3>";
        echo "You have selected a google image: <a href=\"$g_img\">URL</a>";
     }
//print results of plastic types
      echo "<br> You picked $plastic plastic";

//test boundaries of dimensions
    if($width > 0 && $width < 250 && $height > 0 && $height < 250 && $length > 0 && $length < 250)
    {    //calculate total based off of volume
         $total = $length * $width * $height * .01;
         echo "<br> <br> You specified your dimensions to be $length mm long $width mm wide by $height mm tall!<br><br>";
         echo "This brings the total cost to: \$$total <br>";
         echo "Your order will be shipped to you free of charge within the next two weeks!";
    }
    else
    { 
       echo "Incorrect dimensions! Out of bounds!";
    }

    
//print out comment1
    $comment1 = htmlspecialchars($comment1);
    print "<p><strong>Additional specifications</strong>: $comment1 </p>";

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
     $length = filter_var($_POST['length'], FILTER_SANITIZE_STRING);
     $plastic = filter_var($_POST['plastic'], FILTER_SANITIZE_STRING);
     $source = filter_var($_POST['source'], FILTER_SANITIZE_STRING);
     $comment = filter_var($_POST['comment1'], FILTER_SANITIZE_STRING);
 
     if($source == "tech")
     {
       $source = $_POST['tech1'];
     }
     if($source == "thing")
     {
       $source = $_POST['link'];
     }
     if($source == "g_imgs")
     {
       $source = $_POST['g_img'];
     }

     try 
    {
       //establish connections
       $connection = new PDO("mysql:host=mysql.truman.edu;dbname=gam3281CS315", "gam3281", "iojiehah");
       $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
       // prepare sql and bind parameters
       $statement = $connection->prepare("INSERT INTO PrintOrders (name, email, phone, city, state, zip, address, width, height, length, plastic, source, comment)
    VALUES (:name, :email, :phone, :city, :state, :zip, :address, :width, :height, :length, :plastic, :source, :comment)");

       $statement->bindParam(':name', $name);
       $statement->bindParam(':email', $email);
       $statement->bindParam(':phone', $phone);
       $statement->bindParam(':city', $city);
       $statement->bindParam(':state', $state);
       $statement->bindParam(':zip', $zip);
       $statement->bindParam(':address', $address);
       $statement->bindParam(':width', $width);
       $statement->bindParam(':height', $height);
       $statement->bindParam(':length', $length);
       $statement->bindParam(':plastic', $plastic);
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

            
            
