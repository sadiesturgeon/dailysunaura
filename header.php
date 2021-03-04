<!doctype html>
<html lang="en">

    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" type="text/css" href="style.css">

        <?php
            // If the page title is empty, then just display "Daily Sun Aura"
            if (isset($page_title)) {
        
                echo '<title>&#9788' . $page_title . '&#9788</title>';
            }
            else {
                echo '<title>&#9788Daily Sun Aura&#9788</title>';
            }
        ?>
    </head>

    <body id="override-bootstrap">
        <div class="container-fluid">
            