<?php

	$weather = "";
	$error = "";

	if ($_GET["city"]){

		$urlContents = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q='.urlencode($_GET["city"]).',uk&appid=769bceb411dad80e20276adade90bf5f');

		$weatherArray = json_decode($urlContents, true);

		if ($weatherArray["cod"] == 200){

		$weather = "The weather in ".$_GET["city"]." is currently '".$weatherArray["weather"][0]["description"]."'. ";

		$temInCelcius = intval($weatherArray["main"]["temp"] - 273);

		$windSpeed = $weatherArray["wind"]["speed"]."m/s.";

		$weather .= "The temperature is ".$temInCelcius."&deg;C"." and the wind speed is ".$windSpeed;


		} else {
			$error = "could not find city - please try again!";
		}

	}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>Weather forecast</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/css/bootstrap.min.css" integrity="sha384-AysaV+vQoT3kOAXZkl02PThvDr8HYKPZhNT5h/CXfBThSRXQ6jW5DO2ekP5ViFdi" crossorigin="anonymous">

    <style type="text/css">

    	body {
    		background: none;
    	}
    	
    	html { 
		  background: url(background.jpg) no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}

		.container {
			text-align: center;
			margin-top: 100px;
		}

		h1 {
			color: #BCEB4E;
		}

		label {
			color: #BCEB4E;
		}

		input {
			margin-top: 20px 0;
		}


		#weather {
			margin-top: 15px;
		}



    </style>


  </head>
  <body>
  <div class="container">
    <h1>What's The Weather?</h1>
<form>
  <fieldset class="form-group">
    <label for="city">Enter the name of a city</label>
    <input type="text" class="form-control" id="city" value="<?php 
   
    if (array_key_exists('city', $_GET)){

    		echo $_GET["city"];  

		}


     ?>" name="city" placeholder="Eg. London, Tokyo">
    
  </fieldset>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

<div id="weather"><?php

if ($weather){
	echo '<div class="alert alert-success" role="alert">'
  	.$weather.'</div>';
} else if ($error) {
	echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
}

?></div>

</div>








    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" integrity="sha384-3ceskX3iaEnIogmQchP8opvBy3Mi7Ce34nWjpBIwVTHfGYWQS9jwHDVRnpKKHJg7" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.3.7/js/tether.min.js" integrity="sha384-XTs3FgkjiBgo8qjEjBk0tGmf3wPrWtA6coPfQDfFEY8AnYJwjalXCiosYRBIBZX8" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.5/js/bootstrap.min.js" integrity="sha384-BLiI7JTZm+JWlgKa0M0kGRpJbF2J8q+qreVrKBC47e3K6BW78kGLrCkeRX6I9RoK" crossorigin="anonymous"></script>
  </body>
</html>