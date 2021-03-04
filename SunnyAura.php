<?php
    // ************************************************************************
    //
    // This class creates a Sunny Sun Aura object. It inlcudes 3 image layers 
    // and 3 colors. The images and colors are selected semi-randomly. The Aura
    // is displayed in the center of the screen as large as possible. It is 
    // cropped into a circle by two white image layers.
    //
    // ************************************************************************

    class SunnyAura {

        // Declare Properties
        protected $layer1; // Image layers: image.png string names
        protected $layer2;
        protected $layer3;
        protected $color1; // Image colors
        protected $color2;
        protected $color3;

        // Getter & Setters
        public function getLayer1() {
            return $this->layer1;
        }
        public function setLayer1($layer1) {
            $this->layer1 = $layer1;
        }
        public function getLayer2() {
            return $this->layer2;
        }
        public function setLayer2($layer2) {
            $this->layer2 = $layer2;
        }
        public function getLayer3() {
            return $this->layer3;
        }
        public function setLayer3($layer3) {
            $this->layer3 = $layer3;
        }
        public function getColor1() {
            return $this->color1;
        }
        public function setColor1($color1) {
            $this->color1 = $color1;
        }
        public function getColor2() {
            return $this->color2;
        }
        public function setColor2($color2) {
            $this->color2 = $color2;
        }
        public function getColor3() {
            return $this->color3;
        }
        public function setColor3($color3) {
            $this->color3 = $color3;
        }

        //
        // Gets the name of a color table in the sun_aura_db depending
        // on what type of day it is (long or short). Only selects from the 
        // tables that have sets of 3 colors stored together.
        //
        // IMP: Defaults to a long sunny day.
        //
        // Returns: string - either 'aura_color_longsunnyday' or 
        //                   'aura_color_shortsunnyday'
        //
        public function getTableName($type) {

            if ($type == 'shortsunnyday') {
                return 'aura_color_shortsunnyday';
            }
            else {
                return 'aura_color_longsunnyday';
            } 
        }

        //
        // Randomly selects a set of 3 colors from a table.
        // Table selection depends the type of day (long or short). 
        // Sets the color properties.
        //
        // Return: none
        //
        public function setColors($type) {
            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die('<div class="alert alert-danger">Error connecting to MySQL server.</div>');

            // Get the total number of color combinations and select a random one
            $tableName = $this->getTableName($type);
            $query = "SELECT COUNT(*) FROM $tableName";

            $data = mysqli_query($dbc, $query)
                    or die('<div class="alert alert-danger">Error querying database.</div>');

            $row = mysqli_fetch_array($data);
            $numberOfRows = $row[0]; // Total number of color combos

            // Generate a random number within the number of rows
            $randIndex = rand(1, $numberOfRows);

            // Grab a color trio string from the database
            $query = "SELECT * FROM $tableName LIMIT " . ($randIndex - 1) . ", 1";

            $data = mysqli_query($dbc, $query)
                    or die('<div class="alert alert-danger">Error querying database.</div>');
            mysqli_close($dbc);

            $row = mysqli_fetch_array($data);
            $colorTrio = explode(' ', $row['colors']); // Turns the string into an array

            // Set the colors
            $this->setColor1($colorTrio[0]);
            $this->setColor2($colorTrio[1]);
            $this->setColor3($colorTrio[2]);
        }

        //
        // Randomly selects 3 images from a "trio" images table.
        // Sets the layer properties.
        //
        // Return: none
        //
        public function setLayers() {
            // Connect to the database 
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die('<div class="alert alert-danger">Error connecting to MySQL server.</div>');

            // Get the total number of images and select 3 different random ones
            $query = "SELECT COUNT(*) FROM aura_image_trio";

            $data = mysqli_query($dbc, $query)
                    or die('<div class="alert alert-danger">Error querying database.</div>');

            $row = mysqli_fetch_array($data);
            $numberOfRows = $row[0]; // Total number of drawing layers

            // Get the first random index
            $randIndex1 = rand(1, $numberOfRows);

            // Get the second random index, and make sure it doesn't equal the first
            $randIndex2 = rand(1, $numberOfRows);
            if ($randIndex1 == $randIndex2) {
                while ($randIndex1 == $randIndex2) {
                    $randIndex2 = rand(1, $numberOfRows);
                }
            }

            // Get the third random index, and make sure it doesn't equal 
            // the first or second index
            $randIndex3 = rand(1, $numberOfRows);
            if (($randIndex1 == $randIndex3) || ($randIndex2 == $randIndex3)) {
                while ($randIndex1 == $randIndex3) {
                    $randIndex3 = rand(1, $numberOfRows);
                }
                while ($randIndex2 == $randIndex3) {
                    $randIndex3 = rand(1, $numberOfRows);
                }
            }

            // Grab the three layers from the database
            $query1 = "SELECT * FROM aura_image_trio LIMIT " . ($randIndex1 - 1) . ", 1";
            $query2 = "SELECT * FROM aura_image_trio LIMIT " . ($randIndex2 - 1) . ", 1";
            $query3 = "SELECT * FROM aura_image_trio LIMIT " . ($randIndex3 - 1) . ", 1";

            $data1 = mysqli_query($dbc, $query1)
                    or die('<div class="alert alert-danger">Error querying database.</div>');
            $data2 = mysqli_query($dbc, $query2)
                    or die('<div class="alert alert-danger">Error querying database.</div>');
            $data3 = mysqli_query($dbc, $query3)
                    or die('<div class="alert alert-danger">Error querying database.</div>');
            mysqli_close($dbc);

            // Set the layers
            $this->setLayer1(mysqli_fetch_array($data1)['layer']);
            $this->setLayer2(mysqli_fetch_array($data2)['layer']);
            $this->setLayer3(mysqli_fetch_array($data3)['layer']);
        }

        //
        // Displays an image layer on the screen.
        // Image is centered and is as big as the smallest viewport size.
        // Colors and rotates the image.
        //
        // Return: none
        //
        public function placeLayer($layer, $degrees, $color) {

            $style = 'width: 100vmin; ' . 
                    'height: 100vmin; ' . 
                    'position: fixed; ' . 
                    'top: 50%; ' . 
                    'left: 50%; ' . 
                    'transform: translate(-50%, -50%) rotate(' . $degrees . 'deg); ' . 
                    'background-image: url(' . (SUNNY_UPLOADPATH . $layer) . '); ' . 
                    'background-size: cover; ' . 
                    'background-blend-mode: exclusion; ' . 
                    'mix-blend-mode: hard-light; ' . 
                    'background-color: #' . $color . ';';

            // Checks that file exists and that the file isn't empty
            if (is_file(SUNNY_UPLOADPATH . $layer) && 
                    (filesize(SUNNY_UPLOADPATH . $layer) > 0)) {
                
                echo '<div style="' . $style . '"></div>';
            }
        }

        //
        // Displays a full aura to the screen.
        // Determines how to rotate layers (semi-randomly).
        // Places each image layer and two white frame images 
        // to crop the aura to a circle.
        //
        // Return: none
        //
        public function displayAura() {
            // Display the first layer at 60 degrees
            $degrees1 = 60;

            // Display the second layer at 180 degrees + or - 45 degrees
            $rand = rand(-45, 45);
            $degrees2 = 180 + $rand;

            // Display the third layer at 300 degrees + or - 45 degrees
            $rand = rand(-45, 45);
            $degrees3 = 300 + $rand;

            // Get a random number within +- 90 degrees and rotate all of 
            // the images that much
            $rand = rand(-360, 360);
            $degrees1 += $rand;
            $degrees2 += $rand;
            $degrees3 += $rand;

            // Display the images
            $this->placeLayer($this->getLayer1(), $degrees1, $this->getColor1());
            $this->placeLayer($this->getLayer2(), $degrees2, $this->getColor2());
            $this->placeLayer($this->getLayer3(), $degrees3, $this->getColor3());

            // Insert frames to hide colorful layer edges
            echo '<img src="' . IMAGES_UPLOADPATH . 'whiteframe.png" ' . 
                    'alt="frame around aura" class="circlecrop" />';
            echo '<img src="' . IMAGES_UPLOADPATH . 'whiteframe.png" ' . 
                    'alt="frame around aura" class="circlecrop" ' . 
                    'id="second_circlecrop"/>';
        }

        //
        // This function is used for testing. Outputs the aura's info:
        // the aura's type, and each image layer's color and image name.
        //
        // Return: none
        //
        public function displayAuraInfo($type) {

            echo '<div class="aura_info_div">';
            echo '<h2 class="aura_info">Aura Info</h2>';
            echo '<p class="text-secondary">' . $type . '</p>';
            echo '<p>Layer 1: <br />' . 
                    '- color: #' . $this->getColor1() . '<br />' . 
                    '- image: ' . $this->getLayer1() . '</p>';
            echo '<p>Layer 2: <br />' . 
                    '- color: #' . $this->getColor2() . '<br />' . 
                    '- image: ' . $this->getLayer2() . '</p>';
            echo '<p>Layer 3: <br />' . 
                    '- color: #' . $this->getColor3() . '<br />' . 
                    '- image: ' . $this->getLayer3() . '</p>';
            echo '</div>';
        }
    }
?>
