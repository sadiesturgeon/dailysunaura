<?php
    require_once('authorize.php');
    require_once('appvars.php');
    require_once('connectvars.php');
    // Insert the page header
    $page_title = 'Delete Colors';
    require_once('header.php');
    require_once('adminNav.php');

    // ************************************************************************
    //
    // This page allows the user to view all color sets in the database. Any 
    // of the sets can be selected for deletion, which sends the user to
    // deleteColorsConfirm.php.
    //
    // Please see admin.php for further information.
    //
    // ************************************************************************

    //
    // Displays the beginning of the container HTML. Basically contains the 
    // body of the page in order to create a row of columns.
    //
    // Return: none
    //
    function buildContainer() {

        ?>
            <div class="container" id="delete_page"> <!-- everything container -->
                <h1 class="delete_h1">Delete Colors</h1>
                <div class="row"> <!-- aura types row -->
        <?php
    }

    //
    // Displays the column header depending on which table/type of 
    // day it is (sunny or cloudy, long or short).
    //
    // Return: none
    //
    function makeColumnHeader($type) {

        if ($type == '1') {
            return 'Long Sunny Day';
        }
        elseif ($type == '2') {
            return 'Short Sunny Day';
        }
        elseif ($type == '3') {
            return 'Long Cloudy Day';
        }
        elseif ($type == '4') {
            return 'Short Cloudy Day';
        }
    }

    //
    // Displays the beginning of the column HTML.
    //
    // Return: none
    //
    function startColumn($type) {

        $columnHeader = makeColumnHeader($type);

        ?>
            <div class="col-sm"> <!-- column -->
                <div class="container-fluid">
                    <div class="row mt-4"> <!-- header row -->
                        <h2 class="delete_col_headers"><?php echo $columnHeader; ?></h2>
                    </div>
                    
        <?php
    }

    //
    // Displays the end of the column HTML.
    //
    // Return: none
    //
    function endColumn() {
        
        ?>
                    
                </div> <!-- fluid container -->
            </div> <!-- column -->
        <?php
    }

    //
    // Displays one table's worth of color sets in a column.
    //
    // Return: none
    //
    function buildColumn($color_data, $type) {

        startColumn($type);

        // Get the color data
        while ($row = mysqli_fetch_array($color_data)) {

            echo '<div class="row mt-4"> <!-- color row -->';

            $colorArray = explode(' ', $row['colors']); // Turns the string into an array
            $layer = IMAGES_UPLOADPATH . 'blacksquare1.png';

            // Outputs each color
            foreach ($colorArray as $color) {

                $style = 'background-image: url(' . $layer . '); ' . 
                        'background-size: cover; ' . 
                        'background-blend-mode: exclusion; ' . 
                        'mix-blend-mode: hard-light; ' . 
                        'background-color: #' . $color . ';';
                
                echo '<div class="col" style="' . $style . '"></div>';
            }

            // Button to delete color
            echo '<div class="col pl-0">';
            echo '<a href="deleteColorsConfirm.php' . 
                    '?id=' . $row['id'] . 
                    '&amp;type=' . $type . 
                    '&amp;colors=' . $row['colors'] . 
                    '" type="button" ' . 
                    'class="btn black_link">Remove';
            echo '</a></div>';

            echo '</div> <!-- color row -->';
        }
        endColumn();
    }

    //
    // Displays the end of the container HTML
    //
    // Return: none
    //
    function endContainer() {
        
        ?>
                </div> <!-- aura types row -->
            </div> <!-- everything container -->
        <?php
    }

    // ---------------------MAIN-----------------------------------------------

    // Connect to the database
    $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
            or die('<p class="alert alert-danger">Error connecting to ' . 
            'MySQL server.</p>');
        
    $query1 = "SELECT * FROM aura_color_longsunnyday " . 
            "ORDER BY id DESC"; // Shows newest colors first

    $query2 = "SELECT * FROM aura_color_shortsunnyday " . 
            "ORDER BY id DESC"; // Shows newest colors first

    $query3 = "SELECT * FROM aura_color_longcloudyday " . 
            "ORDER BY id DESC"; // Shows newest colors first

    $query4 = "SELECT * FROM aura_color_shortcloudyday " . 
            "ORDER BY id DESC"; // Shows newest colors first
    
    $color_data_longsunnyday = mysqli_query($dbc, $query1)
            or die('<p class="alert alert-danger">Error querying database.</p>');

    $color_data_shortsunnyday = mysqli_query($dbc, $query2)
            or die('<p class="alert alert-danger">Error querying database.</p>');

    $color_data_longcloudyday = mysqli_query($dbc, $query3)
            or die('<p class="alert alert-danger">Error querying database.</p>');

    $color_data_shortcloudyday = mysqli_query($dbc, $query4)
            or die('<p class="alert alert-danger">Error querying database.</p>');

    mysqli_close($dbc);

    // Create 4 Columns
    buildContainer();

    // Long Sunny Day - 1st Column
    buildColumn($color_data_longsunnyday, 1);

    // Short Sunny Day - 2nd Column
    buildColumn($color_data_shortsunnyday, 2);

    // Long Cloudy Day - 3rd Column
    buildColumn($color_data_longcloudyday, 3);

    // Short Cloudy Day - 4th Column
    buildColumn($color_data_shortcloudyday, 4);

    endContainer();

    require_once('footer.php');
?>
