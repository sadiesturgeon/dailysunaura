<?php
    require_once('authorize.php');
    require_once('appvars.php');
    require_once('connectvars.php');
    // Insert the page header
    $page_title = 'Confirm Delete';
    require_once('header.php');
    require_once('adminNav.php');

    // ************************************************************************
    //
    // This page shows the color set selected for deletion and a button to
    // confirm the deletion. If the button is clicked, then the colors are 
    // permanently deleted from the appropriate table. Displays confirmaion of
    // deletion.
    //
    // Please see admin.php for further information.
    //
    // ************************************************************************

    echo '<h1 class="delete_h1">' . $page_title . '</h1>';

    function getTableName($type) {

        if ($type == '1') {
            return 'aura_color_longsunnyday';
        }
        elseif ($type == '2') {
            return 'aura_color_shortsunnyday';
        }
        elseif ($type == '3') {
            return 'aura_color_longcloudyday';
        }
        elseif ($type == '4') {
            return 'aura_color_shortcloudyday';
        }
    }
    
    if (isset($_GET['id']) && isset($_GET['type']) && isset($_GET['colors'])) {

        // Get the color info
        $id = $_GET['id'];
        $type = $_GET['type'];
        $colors = $_GET['colors'];

        ?>
            <p class="alert alert-warning" id="confirm_delete">Are you sure 
                    you want to delete the following colors?</p>
        <?php

        // Display the colors
        $colorArray = explode(' ', $colors); // Turns the string into an array

        foreach ($colorArray as $color) {

            $layer = IMAGES_UPLOADPATH . 'blacksquare1.png';

            $style = 'width: 11.326em; ' . // golden ratio to 7
                    'height: 7em; ' . 
                    'margin: 0 auto; ' . 
                    'background-image: url(' . $layer . '); ' . 
                    'background-size: cover; ' . 
                    'background-blend-mode: exclusion; ' . 
                    'mix-blend-mode: hard-light; ' . 
                    'background-color: #' . $color . ';';
                
            echo '<div class="border border-dark" style="' . $style . '"></div>';
        }

        // Confirm button
        ?>
            <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" 
                    role="form" id="confirm_delete_form">

                <input type="hidden" name="type" value="<?php echo $type; ?>"/>
                <input type="hidden" name="id" value="<?php echo $id; ?>"/>

                <button type="submit" name="submit" 
                        class="btn btn-outline-dark btn-lg">Delete</button>

            </form>
        <?php  
    }

    if (isset($_POST['submit'])) { // Confirm button has been selected

        // Get the color info
        if (isset($_POST['id']) && isset($_POST['type'])) {
            $id = $_POST['id'];
            $type = $_POST['type'];
        }
        else {
            // Error!
            echo '<div class="alert alert-danger">Error selecting color! ' . 
            'Please try again.</div>';
        }

        // Delete from database
        $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                or die('<div class="alert alert-danger">Error connecting to ' . 
                'MySQL server.</div>');

        $tableName = getTableName($type);

        $query = "DELETE FROM $tableName WHERE id = $id";

        mysqli_query($dbc, $query)
                or die('<div class="alert alert-danger">Error querying ' . 
                'database.</div>');
            
        mysqli_close($dbc);

        //Confirm success to user!
        echo '<div class="alert alert-success">Sucess - colors deleted!</div>';
    }

    require_once('footer.php');
?>
