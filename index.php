<?php
    require_once 'vendor/autoload.php';
    use GuzzleHttp\Client;
    use GuzzleHttp\Exception\RequestException;

    require_once('appvars.php');
    require_once('connectvars.php');
    require_once('header.php');
    require_once('SunnyAura.php'); // Sunny Aura object
    require_once('CloudyAura.php'); // Cloudy Aura object
    require_once('indexSupport.php'); // supporting functions for this page

    // ************************************************************************
    //
    // This website shows an "aura" image that represents the amount of sun in
    // a day. The user inputs their zip code to determine the inputs of 
    // daylight hours and if it's sunny or cloudy.
    //
    // The aura images and their colors depend on the imputs of daylight hours
    // and if it's sunny or cloudy. There are four different categories of 
    // colors that include sets of colors. There are two different categories
    // of images that are either intened to be shown in pairs or threes. Images
    // are placed semi-randomly.
    //
    // If you click on the aura it generates another aura of the same type
    // (images and colors are randomly chosen from the same set).
    //
    // Please see the admin.php page for a description of all admin tools.
    //
    // Author: Sadie Sturgeon
    // Date: December 2020
    //
    // ************************************************************************

    // Declare variables
    $error = false;
    $error_msg = "";
    
    // Postal form was submitted
    if (isset($_POST['submit']) && isset($_POST['postal_code'])){
        
        // Get the zip code from the form
        $postal_code = trim($_POST['postal_code']);
        
        // VALIDATION
        if (!isValidPostalCode($postal_code)) {

            $error = true;
            $error_msg = 'Please enter a 5 digit US zip code.';
        }
        
        if (!$error) {

            // ************************************************************
            // ***** Get weather info from openweathermap.org *************
            // ************************************************************

            // Interpolate the postal code into our API url
            $api_key = ''; // insert API here
            $units = 'imperial'; // makes it so we use fareinheit instead of kelvin
            $url = "api.openweathermap.org/data/2.5/weather?zip=$postal_code,us&units=$units&appid=$api_key";
    
            $client = new Client();
    
            try{
                $response = $client->request('GET', $url, []);
                $response_body = $response->getBody();
                $decoded_body = json_decode($response_body);
            } 
            catch (RequestException $e){
                echo "HTTP Request failed\n";
                echo "<pre>";
                print_r($e->getRequest());
                echo "</pre>";
                if ($e->hasResponse()){
                    echo $e->getResponse();
                }
            }

            if(isset($decoded_body)) {

                // ***** Get inputs: id and daylight hours *****
        
                // ************************************************************
                // ***** Get weather id ***************************************
                // ************************************************************

                // If there's an error, then $weather_id will be empty string
                $weather_id = getWeatherId($response_body);
        
                // ************************************************************
                // ***** Get daylight hours ***********************************
                // ************************************************************

                $sunrise = $decoded_body->sys->sunrise;
                $sunset= $decoded_body->sys->sunset;
                
                // If there's an error, then $daylight_hours will be -1
                $daylight_hours = getDaylightHours($sunrise, $sunset);

                // ************************************************************
                // ***** Create Aura ******************************************
                // ************************************************************

                // Check for errors
                if (empty($weather_id) || ($daylight_hours == -1)) {
                    $error = true;
                    $error_msg = 'Error collecting weather data. ' . 
                            'Please try again.';
                }
                else {
                    $type_of_day = getTypeOfDay($weather_id, $daylight_hours);
                    createAura($type_of_day);
                }
                
            } // end if isset($decoded_body)
            else {
                $error = true;
                $error_msg = 'Error collecting weather data. ' . 
                        'Please try again.';
            }
        } // end if !$error
    } // end form submission

    // If the form hasn't been submitted or if there's an error, 
    // and if the refresh button hasn't been clicked
    if ((!isset($_POST['submit']) || $error) && !isset($_POST['refresh'])) {

        // Display error message
        if ($error) {
            $begin_error = '<div class="alert alert-danger">';
            $end_error = '</div>';
            echo $begin_error . $error_msg . $end_error;
        }
        displayInitialPage();
    }

    // If the aura was clicked then show another aura of the same type
    if (isset($_POST['refresh'])) {

        $type_of_day = $_POST['type'];
        createAura($type_of_day);
    }

    require_once('footer.php');
?>
