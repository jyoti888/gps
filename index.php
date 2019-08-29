<!DOCTYPE html>
<html>
<head>
  <title> map </title>
   <body><br><br>     
 <center>  <form method = "POST" action = "" enctype="multipart/form-data" >
    Lat : <input type = "text" id="lat" name = "lat" value ="lat"><BR><BR>
    longi : <input type = "text" id="longi" name = "longi" value="longi"><BR><BR>
    Zoom : <input type = "text" name = "zoom"><BR><BR>
    description:<textarea name="description" height="250px"></textarea>
    <br><BR>
    <input type="file"  name = "image" ><BR><BR>
    <input type = "submit" name = "locate" value = "Locate"><BR><BR>
  </form>
  <button onclick="getLocation()">Try It</button><br></center>

<p id="demo1"></p>
<p id="demo2"></p>
</body>
</head>
</html>
<?php
require 'conn.php';
//error_reporting(E_ALL);
  if(isset($_POST['locate'])){
    $lat=$_POST['lat'];
    $longi=$_POST['longi'];
    $zoom=$_POST['zoom'];
    $description=addslashes($_POST['description']);

     $imgpath=$_FILES['image']['tmp_name'];
     if($imgpath){
          $img_binary = fread(fopen($imgpath, "r"), filesize($imgpath));
          $picture = base64_encode($img_binary);

          $insert=mysqli_query($conn,"INSERT INTO mymap (lat,longi,zoom,image,description) VALUES ('$lat','$longi','$zoom','$picture','$description')");
            if($insert){
               //echo "inserted successfully";
                echo"<script language='javascript'>";
                echo'document.location.replace("./map.php")';
                echo"</script>";
            }else{
                echo $conn->error;
            }
    }else{
      echo "insert image";
    }
  }
  ?>
<!--<script>
var x = document.getElementById("demo");

function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition);
  } else { 
    x.innerHTML = "Geolocation is not supported by this browser.";
  }
}

function showPosition(position) {
  x.innerHTML = "Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;
}

</script>-->
<script>
  var lat = document.getElementById("demo1");
  var longi=document.getElementById("demo2");


  function getLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function showPosition(position){
        lat.innerHTML =  position.coords.latitude;
        longi.innerHTML =  position.coords.longitude;
        document.getElementById("lat").value = position.coords.latitude;
        document.getElementById("longi").value = position.coords.longitude;
      }
      );
  } else { 
    lat.innerHTML = "Geolocation is not supported by this browser.";
    longi.innerHTML = "Geolocation is not supported by this browser.";
  }
}
</script>