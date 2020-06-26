<?php
require 'classes/UserInstagram.php';


$user = new UserInstagram(); 
// change value $username for your instagram user without @
$username = "elrubiuswtf";
echo $user->getDataUserInstagram($username)."<br/>";
$images =  $user->getImageInstagramUser($username);
$fecha = date_create();
foreach($images as $image){
    echo "<div style='width: 200px; margin: 10px; float: left; '>";
    echo "<div style='height: 200px;  text-align: center; overflow: hidden;width: 200px'>";
 
   echo "<img style='width: 200px; ' src='".$image[0]."'><br/>";
   echo "</div>";
   echo $image[1]." Likes<br/>";
   echo $image[2]." Comments<br/>";
   echo $image[3]." <br/>";
   date_timestamp_set($fecha, $image[4]);
    echo date_format($fecha, 'Y-m-d H:i:s') . "\n";
   echo "</div>";
}
?>