<?php 
    
    error_reporting(E_ALL); ini_set('display_errors', 1);
    
    // Get settings.
    require_once('../../settings.php');

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
		$name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);

        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem.";
            exit;
        }

        // Set the email subject.
        $subject = "New contact from $name";

        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Message:\n$message\n";

        // Build the email headers.
        $email_headers = "From: $name <$email>";

        // Send the email.
        if (mail($contact['email'], $subject, $email_content, $email_headers)) {
        
            // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You!";
        } else {
        
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong.";
        }

    } else {
    
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Oops! There was a problem.";
    }

?>