<?php
    require_once('authorize.php');
    require_once('appvars.php');
    require_once('connectvars.php');
    // Insert the page header
    $page_title = 'Add Colors';
    require_once('header.php');
    require_once('adminNav.php');
    require_once('ColorTrio.php'); // Color Trio Object
    require_once('ColorDuo.php'); // Color Duo Object

    // ************************************************************************
    //
    // This page allows the user to select a set of new hex colors and add
    // them to the database.
    //
    // Uses the ColorTrio and ColorDuo classes to display specific forms.
    // A ColorTrio form is shown if entering "Sunny Day" colors.
    // A ColorDuo form is shown if entering "Cloudy Day" colors.
    //
    // Please see admin.php for further information.
    //
    // ************************************************************************

    // Declare varaibles
    $type;
    $displayFirstForm = true;
    $displayThreeColorForm = false;
    $displayTwoColorForm = false;
    $error = false;

    if (isset($_POST['submit']) && !isset($_POST['type'])) { // First form was submitted

        // Grab the value from the form
        $type = $_POST['auraType'];

        // Display a 2 or 3 color form depending on the Aura type
        if (($type == 'LongSunny') || ($type == 'ShortSunny')) {

            // Display 3 color form
            $displayThreeColorForm = true;
        }
        elseif (($type == 'LongCloudy') || ($type == 'ShortCloudy')) {

            // Display 2 color form
            $displayTwoColorForm = true;
        }
        $displayFirstForm = false;
    }
    elseif (isset($_POST['type'])) { // Second form has been submitted

        // Grab the hidden type value from the form
        $type = $_POST['type'];

        if (($type == 'LongSunny') || ($type == 'ShortSunny')) {

            $colorForm = new ColorTrio();

            // Validate input
            if ($colorForm->validateAndSetColors($_POST['color1'], 
                    $_POST['color2'], $_POST['color3'])) {

                // Success! Add to database
                $colorForm->addColors($type);

                echo '<div class="alert alert-success">Success! Colors ' . 
                        'added.</div>';

                // Display form again to add another color
                $displayFirstForm = true;
            }
            else {
                $error = true;
            }
        }
        elseif (($type == 'LongCloudy') || ($type == 'ShortCloudy')) {

            $colorForm = new ColorDuo();

            if ($colorForm->validateAndSetColors($_POST['color1'], $_POST['color2'])) {

                // Success! Add to database
                $colorForm->addColors($type);

                echo '<div class="alert alert-success">Success! Colors added.</div>';

                // Display form again to add another color
                $displayFirstForm = true;
            }
            else {
                $error = true;
            }
        }
        if ($error) {
            // Error with input, try again!
            echo '<div class="alert alert-danger">Input error! Please 
                    enter six-character-long hex colors and try 
                    again.</div>';

            // Display second form again with sticky values
            if (($type == 'LongSunny') || ($type == 'ShortSunny')) {

                // Display 3 color form
                $displayThreeColorForm = true;
            }
            elseif (($type == 'LongCloudy') || ($type == 'ShortCloudy')) {

                // Display 2 color form
                $displayTwoColorForm = true;
            }
            $displayFirstForm = false;
        }
    }
    if ($displayThreeColorForm) {

        $colorForm = new ColorTrio();

        if (!$error) {
            $colorForm->displayInitialColorTrio($type);
        }
        else {
            // Get color values from the form
            $color1 = $_POST['color1'];
            $color2 = $_POST['color2'];
            $color3 = $_POST['color3'];

            $colorForm->displayStickyColorTrio($type, $color1, $color2, $color3);
        }
    }
    if ($displayTwoColorForm) {

        $colorForm = new ColorDuo();

        if (!$error) {
            $colorForm->displayInitialColorDuo($type);
        }
        else {
            // Get color values from the form
            $color1 = $_POST['color1'];
            $color2 = $_POST['color2'];

            $colorForm->displayStickyColorDuo($type, $color1, $color2);
        }
    }
    if (!isset($_POST['submit']) || $displayFirstForm) {
?>

<!-- Select Aura Type Form (First Form) --> 

<div class="container" id="add_color_form">
    <div class="row">

        <div class="col-sm"> <!-- column -->

            <h1 id="add_color_h1"><?= $page_title ?></h1>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" role="form">

                <label for="form-check" id="radio_label">Please select a Sun Aura type:</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="LongSunny" required>
                        Long Sunny Day
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="ShortSunny" required>
                        Short Sunny Day
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="LongCloudy" required>
                        Long Cloudy Day
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="ShortCloudy" required>
                        Short Cloudy Day
                    </label>
                </div>

                <button type="submit" name="submit" 
                        class="btn btn-outline-dark" id="select_type_button">Submit</button>

            </form>
        </div> <!-- end first column -->
    </div> <!-- end row of 1 column -->
</div> <!-- end container of 1 column -->

<?php
    }

    require_once('footer.php');
?>
