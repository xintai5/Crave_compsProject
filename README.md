# Replication Instructions and Code Architechure Overview

My web app is online and accessbile at: [https://xintaiao.online/]

# Replication Instructions

To replicate my senior comprehensive project in the instanse you change/add features to it, follow these steps:

- Download the SQL files "konbert-export-83ff7e1ec9784.sql" and "GH_all_food"
- Next you will have to mimci creating a host server and client using localhost and XAMPP
- Download the a version of XAMPP compatible with your device.
- Install and set up XAMPP
- On XAMPP create a MySQL database. Insert the downloaded SQL files into this database.
- Move all files downloaded from XAMPP into the htdocs solder where XAMPP was downlaoded.
- Then, in all the PHP pages that you downlaoded with ExploreLA, modify the MySQL login details to match your own account.
- Download all files in the "public_html" folder

# Code Architecture


'$sql = "SELECT * FROM `UE_all_food` WHERE `Dish_name` LIKE '%".$searchquery."%'  ORDER BY `Dish_price`";



$result= mysqli_query($conn, $sql);

$resutsisNone = "true";
while($row = $result->fetch_array(MYSQLI_ASSOC)){
    
$resutsisNone = "false";
 $restaurantName = $row["Restaurant_name"];
 $dishName = $row["Dish_name"];
 $dishPrice = $row["Dish_price"];
 $deliveryFee = $row["Delivery_Fee"];
 $deliveryTime = $row["Delivery_Time"];
 

 echo '<div class="w-row">
    <div class="w-col w-col-6">
      <div class="div-block" style="margin-bottom:10px;">
        <div class="text-block">'.$restaurantName.'<br>‍</div>
        <div class="text-block">'.$dishName.'</div>
        <div class="text-block">'.$dishPrice.'<br>‍</div>
        <div class="text-block">'.$deliveryFee.'<br>‍</div>
        <div class="text-block">'.$deliveryTime.'<br></div>
      </div>
    </div>
    <div class="w-col w-col-6">
      <div class="div-block" style="margin-bottom:10px;">
        <div class="text-block">'.$restaurantName.'<br>‍</div>
        <div class="text-block">'.$dishName.'</div>
        <div class="text-block">'.$dishPrice.'<br>‍</div>
        <div class="text-block">'.$deliveryFee.'<br>‍</div>
        <div class="text-block">'.$deliveryTime.'<br></div>
      </div>
    </div>
  </div>';
 
}
if ($resutsisNone = "true"){
    echo '<div class="text-block">We could not find anymore matching food items to your search.</div>';
}'

This function in the result.php file (lines 67-109) under the public_html folder is a very important function. This function takes the data within the phpMyAdmin page and  outputs the two lists of user search results in relation to the SQL files containing the large amount UberEats and GrubHub webscrapped data.

'  <p class="paragraph affwcrt">Please enter desired food item:</p>
  <div class="form-block w-form">
    <form id="email-form" name="email-form" data-name="Email Form" action="results.php" method="get"><input type="text" class="w-input" maxlength="256" name="FoodSearchQuery" data-name="Email" placeholder="Ex: Burrito, Pad Thai, etc." id="email" required=""><input type="submit" value="Submit" data-wait="Please wait..." class="submit-button w-button"></form>
    <div class="w-form-done">
      <div>Thank you! Your submission has been received!</div>
    </div>
    <div class="w-form-fail">
      <div>Oops! Something went wrong while submitting the form.</div>
    </div>'

This line of code within index.html (lines 19-27) output the intial text at the beginning of the web app before the user inputs their search key.


