<?php
    require_once('authorize.php');
    require_once('appvars.php');
    require_once('connectvars.php');
    // Insert the page header
    $page_title = 'Testing';
    require_once('header.php');
    require_once('adminNav.php');
    require_once('SunnyAura.php');
    require_once('CloudyAura.php');

    // ************************************************************************
    //
    // This page generates any type of Sun Aura. Can be used to see how the 
    // different images and colors get randomly displayed.
    // Also shows the type of Sun Aura, each image filename, and the hex color 
    // associated with each image.
    //
    // Please see admin.php for further information.
    //
    // ************************************************************************

    if (isset($_POST['submit']) || 
            isset($_POST['longsunnyday']) || 
            isset($_POST['shortsunnyday']) || 
            isset($_POST['longcloudyday']) || 
            isset($_POST['shortcloudyday'])) {

        // Declare variables
        $type = '';
        $aura = '';

        // Grab the value from the form
        if (isset($_POST['submit'])) {
            $type = $_POST['auraType'];
        }
        elseif (isset($_POST['longsunnyday'])) {
            $type = 'longsunnyday';
        }
        elseif (isset($_POST['shortsunnyday'])) {
            $type = 'shortsunnyday';
        }
        elseif (isset($_POST['longcloudyday'])) {
            $type = 'longcloudyday';
        }
        elseif (isset($_POST['shortcloudyday'])) {
            $type = 'shortcloudyday';
        }

        // Display the aura
        if (($type == "longsunnyday") || ($type == "shortsunnyday")) {

            $aura = new SunnyAura();
        }
        elseif (($type == "longcloudyday") || ($type == "shortcloudyday")) {

            $aura = new CloudyAura();
        }
        $aura->setColors($type);
        $aura->setLayers();
        $aura->displayAura();
        $aura->displayAuraInfo($type);

        // Display the buttons to test another type

?>
        <div class="container" id="second_testing_form">

        <div class="row">
            <div class="col text-center">

            <h2 id="another_test_h2">Test Another Aura:</h2>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" role="form">

                <button type="submit" name="longsunnyday" 
                        class="btn btn-outline-dark" 
                        id="test_type_button1">Long Sunny Day</button>
                <button type="submit" name="shortsunnyday" 
                        class="btn btn-outline-dark" 
                        id="test_type_button2">Short Sunny Day</button>
                <button type="submit" name="longcloudyday" 
                        class="btn btn-outline-dark" 
                        id="test_type_button3">Long Cloudy Day</button>
                <button type="submit" name="shortcloudyday" 
                        class="btn btn-outline-dark" 
                        id="test_type_button4">Short Cloudy Day</button>
            </form>

        </div></div></div>
<?php
    }
    else { // Display first form
?>

<div class="container" id="testing_form">
    <div class="row">
        <div class="col-sm"> <!-- column -->

            <h1 id="testing_h1"><?= $page_title ?></h1>

            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" role="form">

                <label for="form-check" id="radio_label">Please select a Sun Aura type:</label>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="longsunnyday" required>
                        Long Sunny Day
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="shortsunnyday" required>
                        Short Sunny Day
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="longcloudyday" required>
                        Long Cloudy Day
                    </label>
                </div>
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" 
                                name="auraType" value="shortcloudyday" required>
                        Short Cloudy Day
                    </label>
                </div>

                <button type="submit" name="submit" 
                        class="btn btn-outline-dark" 
                        id="select_type_button">Submit</button>

            </form>
        </div> <!-- end first column -->
    </div> <!-- end row of 1 column -->
</div> <!-- end container of 1 column -->

<?php
    }

    require_once('footer.php');
?>
