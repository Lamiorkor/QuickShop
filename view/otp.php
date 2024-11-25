<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Input Form</title>
    
    <!-- CSS for formatting the form -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        
        .container {
            width: 100%;
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #45a049;
            color: white;
            padding: 10px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #399640;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: -10px;
            margin-bottom: 10px;
        }

        #request-new-otp {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f44336;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        
        #request-new-otp:hover {
            background-color: #d32f2f;
        }
        #countdown {
            margin-top: 10px;
            font-size: 14px;
            color: #555;
        }
    </style>

    <!-- JavaScript for form validation and new OTP logic -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function validateOTP() {
            var otp = document.getElementById("otp").value;

            // Clear previous error message
            document.getElementById("error").innerHTML = "";

            // Ensure the OTP contains only numbers and is exactly 6 digits
            if (!/^\d{6}$/.test(otp)) {
                document.getElementById("error").innerHTML = "Please enter a valid 6-digit OTP.";
                return false;
            }
            return true; // Allow form submission
        }

        function requestNewOTP() {

            var requestOtpButton = document.getElementById("request-new-otp");
            requestOtpButton.disabled = true;
            startCountdown(); // Start the countdown
    $.ajax({
        url: '../actions/otp_action.php', // This is the path to your otp_action.php file
        type: 'POST',
        data: { action: 'regenerate_otp' }, // Sending an action to identify the OTP regeneration
        dataType: 'json',
        success: function(response) {
            if (response.status === 'success') {
                alert(response.message); // Alert success message
            } else {
                alert(response.message); // Alert error message
            }
        },
        error: function(xhr, status, error) {
            // Handle any AJAX errors here
            alert("An error occurred while processing the request. Please try again.");
        }
    });
}   

function startCountdown() {
            var countdownTime = 120; // 2 minute countdown
            var countdownElement = document.getElementById("countdown");

            countdownElement.innerHTML = "Please wait " + countdownTime + " seconds before requesting a new OTP.";

            var countdownInterval = setInterval(function() {
                countdownTime--;
                countdownElement.innerHTML = "Please wait " + countdownTime + " seconds before requesting a new OTP.";

                // Re-enable button and stop countdown when it reaches 0
                if (countdownTime <= 0) {
                    clearInterval(countdownInterval);
                    countdownElement.innerHTML = "";
                    document.getElementById("request-new-otp").disabled = false; // Enable the button
                }
            }, 1000); // Update every second
        }

    
    </script>
</head>
<body>
    
    <div class="container">
        <h2>Enter Your OTP</h2>
        
        <form action="../actions/otp_action.php" method="POST" onsubmit="return validateOTP();">
            <label for="otp">Enter the OTP sent to your email here:</label>
            <input type="text" id="otp" name="otp" maxlength="6" placeholder="Enter 6-digit OTP" required>

            <div class="error" id="error">
                <?php
                // Display error message if OTP validation meaning OTP is wrong or expired fails
                if (isset($_GET['error'])) {
                    echo htmlspecialchars($_GET['error']);
                }
                ?>
            </div>

            <input type="submit" value="Submit">
        </form>

        <!-- New OTP Button -->
        <button id="request-new-otp" onclick="requestNewOTP()">Request New OTP</button>

        <div id="countdown"></div>
    </div>

    <script>
        
        if (document.getElementById("error").innerHTML != "") {
            document.getElementById("request-new-otp").style.display = "block";
        }
    </script>

</body>
</html>
