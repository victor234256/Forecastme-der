<?php
$result='';
$error='';
ini_set('user_agent', 'PHP');
if(isset($_GET['search'])){
$city = str_replace(' ','',$_GET['city']);
    
$header = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
    
if($header[0] != 'HTTP/1.1 404 Not Found'){
   


$forecast = file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
    
$weather = explode('(1&ndash;3 days)</span><p class="b-forecast__table-description-content"><span class="phrase">', $forecast);
    
$weather2 = explode('</span></p>', $weather[1]); 
    
$result = $weather2[0];
}
    else{
        
         $error = "City Name Could Not Be Found";
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Forcast</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <style>
        body{
            background: url(img/bg3.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        
        }
        .mx-6{
            margin-right: 10em!important;
            margin-left: 10em!important;
        }
        .mt-6{
            margin-top: 10em!important;
        }
        .strong{
            font-weight: 800!important;
            font-size: 32px!important;
            color: #fff;
        }
        p{ 
         color: #fff;
        }
    
    </style>
</head>
<body>
    <p class="text-right"><i>Designed by Jimoh Victor.</i></p>
   <div class="container" style="width:40%;">
       <div class="form text-center mt-6 mx-5">
           <h2 class="strong">Forcast Your Weather</h2>
           <p class="lead">Insert your City</p>
           <form action="index.php" method="get">
               <div class="form-action text-center">
                   <input type="search" class="form-control" name="city" placeholder="Eg. Ibadan,London" value="<?php echo $_GET['city']; ?>">
               </div>
               <div class="form-group pt-3 text-center">
                   <button type="submit" name="search" class="btn btn-secondary" id="Forcast">Forcast</button>
               </div>
           </form>
       </div>
       <div class="weather mx-5">
           <?php 
           if($result){
           echo '<div class="alert alert-success">'.$result;
           }
           else{ echo '<div class="alert alert-danger">'.$error;
           } 
           ?>
       </div>
   </div> 
</body>
</html>