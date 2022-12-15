<!DOCTYPE html><!--  This site was created in Webflow. https://www.webflow.com  -->
<!--  Last Published: Tue Dec 13 2022 05:11:18 GMT+0000 (Coordinated Universal Time)  -->
<html data-wf-page="6398043ebd7f15dc0019f183" data-wf-site="639800bbbf0f8b9ef7c40436">
<head>
  <meta charset="utf-8">
  <title>Results</title>
  <meta content="Results" property="og:title">
  <meta content="Results" property="twitter:title">
  <meta content="width=device-width, initial-scale=1" name="viewport">
  <meta content="Webflow" name="generator">
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/tai-f43a49.webflow.css" rel="stylesheet" type="text/css">
  <!-- [if lt IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" type="text/javascript"></script><![endif] -->
  <script type="text/javascript">!function(o,c){var n=c.documentElement,t=" w-mod-";n.className+=t+"js",("ontouchstart"in o||o.DocumentTouch&&c instanceof DocumentTouch)&&(n.className+=t+"touch")}(window,document);</script>
  <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="images/webclip.png" rel="apple-touch-icon">
</head>
<body class="body results">
  <h1 class="heading">Crave</h1>
  <div class="w-row">
    <div class="w-col w-col-6">
      <div>
        <div class="text-block name">UberEats</div>
      </div>
    </div>
    <div class="w-col w-col-6">
      <div>
        <div class="text-block name">GrubHub</div>
      </div>
    </div>
  </div>
  
<?php
//start of card


$searchquery = $_GET['FoodSearchQuery'];

$conn=mysqli_connect("localhost","u719173039_xaaronao","Athletics12!","u719173039_All_Food_Lists");
if ($conn->connect_error){
  die("Connection failed: " . $conn->connect_error);
  //echo "Failed!";
}else{
  //echo "Connected Succesfully <br>";
}
//echo "POST(",json_encode($_POST),")<br>";


//UberEats list

$sql = "(SELECT * FROM `UE_all_food` WHERE `Dish_name` LIKE '%".$searchquery."%'  ORDER BY `Dish_price`) LIMIT 20";
$sql2 = "(SELECT * FROM `GH_all_food` WHERE `Dish_name` LIKE '%".$searchquery."%'  ORDER BY `Dish_price`) LIMIT 20";

$result= mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

while($row = $result->fetch_array(MYSQLI_ASSOC) AND $row2 = $result2->fetch_array(MYSQLI_ASSOC)){
    
    $UErestaurantName = $row["Restaurant_name"];
    $UEdishName = $row["Dish_name"];
    $UEdishPrice = $row["Dish_price"];
    $UEdeliveryFee = $row["Delivery_Fee"];
    $UEdeliveryTime = $row["Delivery_Time"];
 
 //while($row = $result2->fetch_array(MYSQLI_ASSOC)){

    $GHrestaurantName = $row2["Restaurant_name"];
    $GHdishName = $row2["Dish_name"];
    $GHdishPrice = $row2["Dish_price"];
    $GHdeliveryFee = $row2["Delivery_Fee"];
    $GHdeliveryTime = $row2["Delivery_Time"];
 
    echo '<div class="w-row">
        <div class="w-col w-col-6">
          <div class="div-block" style="margin-bottom:1px;">
            <div class="text-block">'.$UErestaurantName.'<br>‍</div>
            <div class="text-block">'.$UEdishName.'</div>
            <div class="text-block">'.$UEdishPrice.'<br>‍</div>
            <div class="text-block">'.$UEdeliveryFee.'<br>‍</div>
            <div class="text-block">'.$UEdeliveryTime.'<br></div>
          </div>
          </div>
          <div class="w-row">
          <div class="w-col w-col-6">
           <div class="div-block" style="margin-bottom:1px;">
            <div class="text-block">'.$GHrestaurantName.'<br>‍</div>
            <div class="text-block">'.$GHdishName.'</div>
            <div class="text-block">'.$GHdishPrice.'<br>‍</div>
            <div class="text-block">'.$GHdeliveryFee.'<br>‍</div>
            <div class="text-block">'.$GHdeliveryTime.'<br></div>
          </div>
          </div>
        </div>
      </div>';
 
        //}
    }if ($resutsisNone = "true"){
        echo '<div class="text-block">We could not find anymore matching food items to your search.</div>';
}



//GrubHub list
/*
$sql2 = "(SELECT * FROM `GH_all_food` WHERE `Dish_name` LIKE '%".$searchquery."%'  ORDER BY `Dish_price`) LIMIT 20";
$result2 = mysqli_query($conn, $sql2);


while($row = $result2->fetch_array(MYSQLI_ASSOC)){
    
 $GHrestaurantName = $row["Restaurant_name"];
 $GHdishName = $row["Dish_name"];
 $GHdishPrice = $row["Dish_price"];
 $GHdeliveryFee = $row["Delivery_Fee"];
 $GHdeliveryTime = $row["Delivery_Time"];
 
 echo '<div class="w-row">
    <div class="w-col w-col-6" style = "float: right; width: 45%;">
      <div class="div-block" style="margin-bottom:1px;">
        <div class="text-block">'.$GHrestaurantName.'<br>‍</div>
        <div class="text-block">'.$GHdishName.'</div>
        <div class="text-block">'.$GHdishPrice.'<br>‍</div>
        <div class="text-block">'.$GHdeliveryFee.'<br>‍</div>
        <div class="text-block">'.$GHdeliveryTime.'<br></div>
      </div>
    </div>
  </div>';
 
    }if ($resutsisNone = "true"){
    echo '<div class="text-block">We could not find anymore matching food items to your search.</div>';
} 
*/
 ?>
  

  
  <script src="https://d3e54v103j8qbb.cloudfront.net/js/jquery-3.5.1.min.dc5e7f18c8.js?site=639800bbbf0f8b9ef7c40436" type="text/javascript" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>
