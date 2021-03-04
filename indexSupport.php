<?php
    // ************************************************************************
    //
    // This file includes supporting functions for index.php
    //
    // ************************************************************************

    //
    // Displays the zipcode entry form
    //
    // Return: none
    //
    function displayInitialPage() {
        ?>
          <div class="container pt-5" id="postal_code_form">

          <h1 id="index_h1">Daily Sun Aura</h1>

          <p class="text-secondary">An aura that illustrates the amount of 
              <br />daily sunlight in your location.</p>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" role="form">

              <div class="form-group">
                <label for="postal_code">Enter your US zip code:</label>
                <input type="text" name="postal_code" id="postal_code" 
                        class="form-control" required>
              </div>

              <button type="submit" name="submit" class="btn btn-dark">Create</button>
        
            </form>
          </div>
        <?php
    }

    //
    // Validates the postal code imput
    //
    // Return: boolean - true if zip code is 5 digits
    //
    function isValidPostalCode($postal_code) {

        $regex = '/^\d{5}$/';

        if (!preg_match($regex, $postal_code)) {
            return false;
        }
        else {
            return true;
        }
    }

    //
    // Gets the 3 digit weather id from the weather info
    //
    // Return: string - the 3 digit weather id
    //                  if an error arises returns an empty string
    //
    function getWeatherId($response_body) {

        // Declare variables
        $weather_id = '';
        $stringStart = '"weather":[{"id":';
        
        // returns false if string isn't in body
        if (strpos($response_body, $stringStart)) {
    
            $position = strpos($response_body, $stringStart);
            $icon_position = $position + strlen($stringStart);
            $weather_id = substr($response_body, $icon_position, 3);
        }

        return $weather_id;
    }

    //
    // Gets the number of daylight hours from the sunrise and sunset times
    //
    // Return: integer - total number of daylight hours
    //                   if an error arises returns -1
    //
    function getDaylightHours($sunrise, $sunset) {

        // Declare variables
        $daylight_hours = "";

        // Convert from UNIX time to hours
        if (is_numeric($sunrise) && is_numeric($sunset)) { // Convert to numbers

            $sunrise = (int) $sunrise;
            $sunset = (int) $sunset;

            $daylight_seconds = $sunset - $sunrise;
            $daylight_hours = $daylight_seconds / 3600; // 3600 seconds in an hour
        }
        else {
            $daylight_hours = -1;
        }
        return $daylight_hours;
    }

    //
    // Determines if it is a clear day or not. Defines a clear day as clear, 
    // few clouds (11-25%), or scattered clouds (25-50%).
    //
    // Id codes defined by openweathermap.org/weather-conditions#How-to-get-icon-URL
    //
    // Assumes weather id is numeric
    //
    // Return: boolean - true if the weather id matches 800, 801, or 802
    //
    function isClearSkies($weather_id) {

        if (($weather_id == 800) || ($weather_id == 801) || ($weather_id == 802)) {
            return true;
        }
        else {
            return false;
        }
    }

    //
    // Determines if it is a long or short day. Defines a long day as 
    // 12 hours or greater.
    //
    // Assumes daylight hours is numeric
    //
    // Return: boolean - true if daylight hours is equal to or greater than 12
    //
    function isLongDay($daylight_hours) {

        if ($daylight_hours >= 12) {
            return true;
        }
        else {
            return false;
        }
    }

    //
    // Determines the type of day - 4 options total:
    // - long sunny day
    // - short sunny day
    // - long cloudy day
    // - short cloudy day
    //
    // Return: string - string representation of one of the 4 types of days
    //
    function getTypeOfDay($weather_id, $daylight_hours) {

        // Declare variable
        $type_of_day;

        $clear_skies = isClearSkies($weather_id);

        $long_day = isLongDay($daylight_hours);

        if ($clear_skies && $long_day) {
            $type_of_day = 'longsunnyday';
        }
        elseif ($clear_skies && !$long_day) {
            $type_of_day = 'shortsunnyday';
        }
        elseif (!$clear_skies && $long_day) {
            $type_of_day = 'longcloudyday';
        }
        elseif (!$clear_skies && !$long_day) {
            $type_of_day = 'shortcloudyday';
        }
        return $type_of_day;
    }

    //
    // Displays a large invisible button over the Aura. When clicked, the 
    // button creates the same type of aura again.
    //
    // Return: none
    //
    function createAuraButton($type) {

        ?>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" role="form">

            <button type="submit" name="refresh" class="big_clear_button" ></button>

            <input type="hidden" name="type" value="<?php echo $type; ?>" />

          </form>
        <?php
    }

    //
    // Creates a button in the upper left corner to take the user back to 
    // the zip code entry form. It does this by setting the "name" to an 
    // empty string, which gets caught by !isset($_POST['submit'])
    //
    // Return: none
    //
    function createBackButton() {

        ?>
          <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" role="form">
            <div class="input-group mt-2" id="back_button_div">
              <button class="btn btn-light" type="submit" 
                      name="" id="back_button">Back</button>
            </div>
          </form>
        <?php
    }

    //
    // Displays the entire aura page, including the back button
    //
    // Return: none
    //
    function createAura($type_of_day) {

        if (($type_of_day == 'longsunnyday') || 
                ($type_of_day == 'shortsunnyday')) {

            $aura = new SunnyAura();
        }
        elseif (($type_of_day == 'longcloudyday') || 
                ($type_of_day == 'shortcloudyday')) {

            $aura = new CloudyAura();
        }
        $aura->setColors($type_of_day);
        $aura->setLayers();
        $aura->displayAura();

        createAuraButton($type_of_day); // When clicked shows another aura
        createBackButton(); // When clicked shows zipcode entry form
    }
?>
