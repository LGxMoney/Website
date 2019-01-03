 <!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>Garrett Money</title>
        <link rel="stylesheet" href="G_feature_page.css">
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

<img alt="profile picture" id="orderProfile"  src="imgs/displayOrders.JPG">

<div class="description"> 
<h1>Painting Orders</h1>
<h3></h3>
</div>

<div class="sidepad"></div>

<div class="sidebox"></div>

<?php

// function definitions first
function doGetAll() {

    $connection = new PDO("mysql:host=mysql.truman.edu;dbname=gam3281CS315", "gam3281", "iojiehah");
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //sorts by contacts' last names
    $statement = $connection->prepare("SELECT name, state, width, height, source, comment FROM PaintingOrders");

    $statement->execute();

    //creates and fills our table
    echo <<<END
    <h2>Contact Table </h2>

    <table id="orders">
    <th>Name</th>
    <th>State</th>
    <th>Source</th>
    <th>Comments</th>
    <th>Width</th>
    <th>Height</th>
END;
   
    while ( $row = $statement->Fetch(PDO::FETCH_ASSOC))
{
//print all the data into the table directly
    print "<tr>
           <td>{$row['name']}</td>
           <td>{$row['state']}</td>
           <td>{$row['source']}</td>
           <td>{$row['comment']}</td>
           <td>{$row['width']}</td>
           <td>{$row['height']}</td>
           
           </tr>";
      }
    print "</table>";
}

doGetAll();



