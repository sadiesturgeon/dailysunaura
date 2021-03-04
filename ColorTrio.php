<?php
    // ************************************************************************
    //
    // This class is used by addColors.php to create and interact with a form 
    // that adds a set of three new colors into the database.
    //
    // ************************************************************************

    class ColorTrio {

        // Declare Properties
        protected $layer1;
        protected $layer2;
        protected $layer3;
        protected $color1;
        protected $color2;
        protected $color3;

        // Getters & Setters
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
        // Displays the form that accepts new hex colors.
        // Shows directions for how to use page.
        //
        // Return: none
        //
        public function buildForm($type, $color1, $color2, $color3) {
            ?>
              <div class="container">
                <div class="row">

                  <!-- FORM  -->

                  <div class="col-sm">

                    <h1 id="add_color_trio_h1">Add Colors
                        <?php 
                            // Finish the header
                            if ($type == 'LongSunny') {
                                echo ' - Long Sunny Day</h1>';
                                echo '<p class="text-secondary">Pastels ' . 
                                        '& Brights</p>';
                            }
                            elseif ($type == 'ShortSunny') {
                                echo ' - Short Sunny Day</h1>';
                                echo '<p class="text-secondary">Muted/Grey ' . 
                                        'Pastels & Brights - Decreasing ' . 
                                        'Saturation</p>';
                            }
                            else {
                                echo "</h1>";
                            }
                        ?>

                    <p>Open up the Chrome Web Dev Tools and find one of the 
                        divs associated with the image on the right.
                    </p>
                    <p>Select the color associated with the 
                        div, then use the color tool to select a new hex 
                        color. Copy the chosen hex color into the form.
                    </p>
                    <p class="last_paragraph">Repeat with each of the three 
                        images to see a new color trio!
                    </p>

                    <form action="<?= $_SERVER['PHP_SELF'] ?>" method="post" role="form">
            
                      <div class="form-group">
                        <label for="color1">Enter the first hex color:</label>
                        <input type="text" name="color1" id="color1" 
                            class="form-control" value="<?php echo $color1; ?>" required>
                      </div>

                      <div class="form-group">
                        <label for="color2">Enter the second hex color:</label>
                        <input type="text" name="color2" id="color2" 
                            class="form-control" value="<?php echo $color2; ?>" required>
                      </div>

                      <div class="form-group">
                        <label for="color3">Enter the third hex color:</label>
                        <input type="text" name="color3" id="color3" 
                            class="form-control" value="<?php echo $color3; ?>" required>
                      </div>

                      <input type="hidden" name="type" value="<?php echo $type; ?>" />

                      <button type="submit" name="submit" 
                          class="btn btn-outline-dark" 
                          id="add_colors_button">Add Colors</button>

                    </form>
                  </div> <!-- end first column -->

                  <!-- COLOR EXAMPLE (continued elsewhere) -->

                  <div class="col-sm">
            <?php
        }

        //
        // Finishes the form HTML
        //
        // Return: none
        //
        public function endForm() {
            ?>
                    </div> <!-- end second column -->
                  </div> <!-- end row of 2 columns -->
                </div> <!-- end container of 2 columns -->
            <?php
        }

        //
        // Places an image to a fixed position on the screen. 
        // Colors the image.
        //
        // Return: none
        //
        public function placeLayer($img, $color) {

            $style = 'width: 50vmin; ' . 
                    'height: 50vmin; ' . 
                    'position: fixed; ' . 
                    'top: 30%; ' . 
                    'left: 80%; ' . 
                    'transform: translate(-80%, -30%); ' . 
                    'background-image: url(' . $img . '); ' . 
                    'background-size: cover; ' . 
                    'background-blend-mode: exclusion; ' . 
                    'mix-blend-mode: hard-light; ' . 
                    'background-color: #' . $color . ';';

            echo '<div style="' . $style . '"></div>';
        }

        //
        // Uses regex to see if the color is a 6-length hex color. If leading 
        // hash is attatched, then trims it off. 
        //
        // Return: string - a 6-length hex color without the leading hash.
        //         If not a valid hex color, then returns an empty string.
        //
        public function regexValidate($color) {

            $regex1 = '/^[0-9a-fA-F]{6}$/';
            $regex2 = '/^#?[0-9a-fA-F]{6}$/'; // starts with hash

            if (preg_match($regex1, $color)) {
                return $color;
            }
            elseif (preg_match($regex2, $color)) {
                
                // Remove leading hash
                return trim($color, '#');
            }
            else { // Else error! Return empty string
                return "";
            }  
        }

        //
        // Validates colors. If colors are valid, then sets them too.
        //
        // Return: boolean - true if colors are valid hex colors
        //
        public function validateAndSetColors($color1, $color2, $color3) {
            
            // Trim whitespace and regex validate
            $color1 = $this->regexValidate(trim($color1));
            $color2 = $this->regexValidate(trim($color2));
            $color3 = $this->regexValidate(trim($color3));

            // Will be empty string if didn't match regex validation
            if (!empty($color1) && !empty($color2) && !empty($color3)) {

                // Success! Set colors
                $this->setColor1($color1);
                $this->setColor2($color2);
                $this->setColor3($color3);
                return true;
            }
            else {
                return false; // Input error!
            }
        }

        //
        // Gets a color table name depending on day length (short or long).
        //
        // Return: string - the color table name
        //
        public function getTableName($type) {
            if ($type == 'LongSunny') {
                return 'aura_color_longsunnyday';
            }
            elseif ($type == 'ShortSunny') {
                return 'aura_color_shortsunnyday';
            }
        }

        //
        // Adds Colors to the Database. Uses the type to insert into the 
        // correct color table (for a short or long day).
        //
        // Return: none
        //
        public function addColors($type) {

            // Get the table name to insert the color into
            $tableName = $this->getTableName($type);

            // Create the color string
            $colorString = $this->getColor1() . ' ' . 
                    $this->getColor2() . ' ' . 
                    $this->getColor3();

            // Connect to the database
            $dbc = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
                    or die('<p class="alert alert-danger">Error connecting ' . 
                    'to MySQL server.</p>');

            $query = "INSERT INTO " . $tableName . 
                    " (colors) VALUES ('" . $colorString . "')";

            mysqli_query($dbc, $query)
                    or die('<div class="alert alert-danger">Error querying ' . 
                    'database.</div>');
            
            mysqli_close($dbc);
        }

        //
        // Displays a form for entering 3 hex colors into the database.
        // Is used the first time the page is loaded.
        //
        // Return: none
        //
        public function displayInitialColorTrio($type) {

            // Starts the form's text input boxes as empty strings
            $this->buildForm($type, '', '', '');

            $this->setLayer1('third1.png');
            $this->setLayer2('third2.png');
            $this->setLayer3('third3.png');

            // Initially sets the colors to red, blue, and yellow
            $this->setColor1('d51212');
            $this->setColor2('c2cd16');
            $this->setColor3('163ecd');

            $this->placeLayer(IMAGES_UPLOADPATH . $this->getLayer1(), $this->getColor1());
            $this->placeLayer(IMAGES_UPLOADPATH . $this->getLayer2(), $this->getColor2());
            $this->placeLayer(IMAGES_UPLOADPATH . $this->getLayer3(), $this->getColor3());

            $this->endForm();
        }

        //
        // Displays a form for entering 3 hex colors into the database.
        // Is used when there's an error submitting the previous form. 
        // If any colors are valid, then displays them in the image, otherwise
        // image colors default to original.
        // Makes all form inputs sticky.
        //
        // Return: none
        //
        public function displayStickyColorTrio($type, $color1, $color2, $color3) {

            $this->buildForm($type, $color1, $color2, $color3);

            $this->setLayer1('third1.png');
            $this->setLayer2('third2.png');
            $this->setLayer3('third3.png');

            // Sets any colors that pass validation
            // Else defults colors to red, yellow, and blue
            if (!empty($this->regexValidate($color1))) {
                $this->setColor1($color1);
            }
            else {
                $this->setColor1('d51212'); // red
            }
            if (!empty($this->regexValidate($color2))) {
                $this->setColor2($color2);
            }
            else {
                $this->setColor2('c2cd16'); // yellow
            }
            if (!empty($this->regexValidate($color3))) {
                $this->setColor3($color3);
            }
            else {
                $this->setColor3('163ecd'); // blue
            }

            $this->placeLayer(IMAGES_UPLOADPATH . $this->getLayer1(), $this->getColor1());
            $this->placeLayer(IMAGES_UPLOADPATH . $this->getLayer2(), $this->getColor2());
            $this->placeLayer(IMAGES_UPLOADPATH . $this->getLayer3(), $this->getColor3());

            $this->endForm();
        }
    }
?>
