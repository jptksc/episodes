<?php 
    
    error_reporting(E_ALL); ini_set('display_errors', 1);
    
    // Get settings.
    require_once('../../settings.php');

    // Get the MailChimp helper.
    require_once('../../assets/works/api-mailchimp.php');

    // Only process POST reqeusts.
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
        // Get the form fields and remove whitespace.
        $name = $_POST["mc-name"];
        $email = filter_var(trim($_POST["mc-email"]), FILTER_SANITIZE_EMAIL);

        // Check that data was sent to the mailer.
        if (empty($name) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem.";
            exit;
        }

        // Check that data was sent to the mailer.
        if ( !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            exit;
        }
        
        // Add the customer to MailChimp.
        $MailChimp = new MailChimp($mailchimp['api']);
        $MailChimp->call('lists/subscribe', array(
            'id' => $mailchimp['list'],
            'email' => array('email' => $email),
            'merge_vars' => array('FNAME' => $name, 'LNAME' => ''),
            'double_optin' => true,
            'update_existing' => true,
            'replace_interests' => false,
            'send_welcome' => false
        ));
        
        // Set a 200 (okay) response code.
        http_response_code(200);
        echo "Thank You! Check your mail.";

    } else {
    
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "Oops! Something went wrong.";
    }

?>