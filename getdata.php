<?php
$host = "localhost";
$dbname = "gps";
$username = "root";
$password ="";
$con = mysqli_connect($host,$username,$password,$dbname);

$login_username ="username";
$loging_password ="password";

if (isset($_POST['details'])){
    $getdata =$con->query("select * from `gpsdata` order by id desc limit 1");
    while($row = $getdata->fetch_assoc()){
        echo $row['lati'];
        echo "_";
        echo $row['longt'];
    }
    exit;
}

if (isset($_POST['username']) && isset($_POST['password'])){
    if ($_POST['username']==$login_username && $_POST['password']==$loging_password){
        setcookie("logging_admin","admin loged",time() +3600,"/");
    }   
    
}
?>
<!doctype HTMl>
<html>
    <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
    </head>
    <body>
        <?php
            if (isset($_COOKIE['logging_admin'])== FALSE){
                echo "<form action='getdata.php' method='POST'>
                    <input type='text' name='username'><br><br>
                    <input type ='password' name ='password'> <br><br>
                    <input type ='submit' value='LOGIN'>
                    </FORM>
                ";
                die();
            }
        ?> 

        <div id="map" style="width:400px;height:400px"></div>
        <script>
            function myMap(lat,lang) {
                
                var curloc = {lat: lat, lng: lang};
                var map = new google.maps.Map(document.getElementById('map'), {
                  zoom: 15,
                  center: curloc
                });
                var marker = new google.maps.Marker({
                  position: curloc,
                  map: map
                });
              }
            
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1rnBeUoNVDBJN58gavZZ8_qG8y_IGCRM"></script>
        <?php
            if (isset($_COOKIE['logging_admin'])){
                echo "
                    <script>
                        $(document).ready(function(){
                            
                            setInterval(function(){
                                $.ajax({
                                    url:'getdata.php',
                                    type:'POST',
                                    data:{'details':'details'},
                                    success:function(result){

                                        result = result.split('_');
                                        myMap(parseFloat(result[0]), parseFloat(result[1]));
                                    }
                                });
                            },10000);
                        });
                    </script> 

                    <script>
                        
                    </script> 
                ";
            }
        ?> 
    </body>
</html> 
