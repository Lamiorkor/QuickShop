<?php
require('../classes/otp.php');
require ('../vendor/autoload.php'); // This automatically includes all the required files

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


    

    function validateOTPController($userId, $otp) {
        // Create an instance of the OTP class
        $newOtp = new OTP();
    
        // Call validateOTP function to check OTP validity
        $command = $newOtp->validateOTP($userId, $otp);
    
        // Check the result and return appropriate messages
        if ($command == "valid") {
            return true;
        } else {
            return false;
        } 
    }


function sendOTPController($email) {
    // Create an instance of the OTP class
    

    $mail = new PHPMailer(true);
    $ot = new Otp();
    $otp = $ot->generateOTP($email);

    if ($otp != false){
        try {
            // SMTP server configuration
            $mail->isSMTP();                                      
            $mail->Host = 'smtp.gmail.com';                       
            $mail->SMTPAuth = true;                               
            $mail->Username = 'jim200118@gmail.com';            
            $mail->Password = 'wdmq chpf hahi dthf';               
            $mail->SMTPSecure = 'tls';                            
            $mail->Port = 587;                                    
        
            // Sender and recipient settings
            $mail->setFrom('jim200118@gmail.com', 'Ashesi Saints');   
            $mail->addAddress($email);              
        
            // Subject and message body
                                 // Generate a random 4-digit number
            $mail->Subject = 'Your 6-digit verification code';
            $mail->Body    = "Hello,\n\nYour verification code is: " . $otp . "\n\nRegards,\n Ashesi Saints ";
        
            // Send the email
            $mail->send();
            return true;

        } catch (Exception $e) {
            // catch errors
            return false;
        }

    }

    return false;


}



?>