<?php

  $weather = "";
  $error = "";
  if($_GET['city']){

  
    $urlContents = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=". urlencode($_GET['city']) ."&APPID=d8995d3940d80930c574526626aaeb4c");
    $weatherArray = json_decode($urlContents, true);  
    if($weatherArray['cod'] == 200){

      $weather = " The weather in ". $_GET['city'] ." is currently '". $weatherArray['weather'][0]['description'] ."'. ";
      $tempCelsius = intval($weatherArray['main']['temp'] - 273 );
      $weather .= " The temperature is ". $tempCelsius ."&deg;C and the wind speed is ". $weatherArray['wind']['speed'] ."m/s. ";

    }else {

      $error = "Could not find the city you entered!";
    }


  }    

?>
<!doctype html>
<html lang="en">
  <head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Info-City!</title>

    <style type="text/css">

     html { 
      background: url(img.jpg) no-repeat center center fixed; 
      -webkit-background-size: cover;
     -moz-background-size: cover;
     -o-background-size: cover;
     background-size: cover;
    } 
    body{

      background: none;
      color: white;

    }
    .container{
 
       text-align: center;
       margin-top: 200px;
       color: white;
       width: 450px;

    }
    input{

      margin-top: 20px;
    }
    button{

      margin-bottom: 20px;
    }

    </style>
  </head>
  <body>
    
    <div class="container">

   <h1>What's the info?</h1>
   <form >
  <div class="mb-3">
    <label for="city" class="form-label">Enter the name of a city.</label>
    <input type="text" class="form-control" name="city" id="text"  placeholder="London, Tokyo" value ="<?php echo $_GET['city'] ?>">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
  </form>

   <div id="weather"><?php
   
   if($weather){

     echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';

   }else{
      if($error){

      echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
      }
   }

?></div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type="text/javascript">
   </script>

  </body>
</html>