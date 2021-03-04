<?php
    require_once('authorize.php');
    require_once('appvars.php');
    require_once('connectvars.php');
    // Insert the page header
    $page_title = 'Admin';
    require_once('header.php');
    require_once('adminNav.php');

    // ************************************************************************
    //
    // Main Page for Admin Tools
    //
    // The Sun Auras use CSS styling to "colorize" images. However, I 
    // discovered during this project that there is no easy built in CSS way 
    // to "colorize" an image (like you can do with text and background 
    // colors). I found a hack way to "colorize" an image through CSS using a 
    // background color mask. 
    // (source: 
    // https://stackoverflow.com/questions/29458666/emulate-photoshops-color-
    // overlay-using-css-filters)
    // However, this CSS styling often results in a screen color that greatly
    // differs from the hex color. Consequently, I developed the addColors.php
    // page to solve this problem. Using developer tools in combination with 
    // the page, you can select a hex color that looks good when processed 
    // through the CSS code. 
    //
    // I realize this is a highly unconventional solution, but I think it is
    // best solution to this problem because it allows me to mix colors on the
    // screen similarly to mixing paints in real life. It's a fun process to 
    // get the color, and it allows you to select a specific color. I do 
    // consider this a personal "art" website, so this solution is perfect 
    // for me!
    //
    // All Admin Tools:
    //
    // Add Colors: add new color combinations to the database
    // Delete Colors: view and delete existing combinations of colors
    // Test Auras: generate any aura type to see how the images and colors look
    //
    // ************************************************************************
?>
    <div class="container" id="admin_container">
        <h1 id="admin_h1"><?php echo $page_title; ?></h1>

        <p class="alert alert-warning">All admin pages work best in a 
                full sized browser window.</p>

        <p id="select_task">Please select a task:</p>

        <a class="btn btn-outline-dark btn-lg" id="add_color_btn" 
                href="addColors.php" role="button">Add Colors</a>
        <br />
        <a class="btn btn-outline-dark btn-lg" id="delete_color_btn" 
                href="deleteColors.php" role="button">Delete Colors</a>
        <br />
        <a class="btn btn-outline-dark btn-lg" id="delete_color_btn" 
                href="testing.php" role="button">Test Auras</a>
    </div>

<?php
    require_once('footer.php');
?>
