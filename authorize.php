<?php
    // User name and password for authentication
    // Ideally this wouldn't be stored in the code
    $username = 'meow';
    $password = 'meow';
    
    if (!isset($_SERVER['PHP_AUTH_USER']) || 
            !isset($_SERVER['PHP_AUTH_PW']) ||
            ($_SERVER['PHP_AUTH_USER'] != $username) || 
            ($_SERVER['PHP_AUTH_PW'] != $password)) {
            
        // The user name/password are incorrect so send the authentication headers
        header('HTTP/1.1 401 Unauthorized');
        header('WWW-Authenticate: Basic realm="Daily Sun Aura"');
        exit('<h2>Daily Sun Aura</h2>Sorry, you must enter a valid user ' . 
                'name and password to access this page.');
    }
?>
