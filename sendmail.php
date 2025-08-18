<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name    = strip_tags(trim($_POST["name"]));
    $email   = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["message"]);

    if (!$name || !$email || !$message) {
        echo "All fields are required.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format.";
        exit;
    }

    // Protect against header injection
    if (preg_match("/[\r\n]/", $name) || preg_match("/[\r\n]/", $email)) {
        echo "Invalid input detected.";
        exit;
    }

    $to = "piyushgoswami.innovatix@gmail.com";
    $subject = "New Contact Form Submission from $name";

    $body  = "Name: $name\n";
    $body .= "Phone: $email\n\n";
    $body .= "Message:\n$message\n";

    $headers  = "From: Your Website <no-reply@yourdomain.com>\r\n";
    $headers .= "Reply-To: $name <$email>\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if (mail($to, $subject, $body, $headers)) {
         echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Success</title>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
        </head>
        <body>
            <div class="form-group">
                <div style="background: #fff; padding-top:200px;color:#fff;">
                    <div class="container" style="position: static;max-width: 1200px;margin: 0 auto;background: #7ac788;padding: 100px 15px;text-align: center;font-family: sans-serif;">
                        <h1>Congratulations! Your Mail has been sent Successfully from '.$email.'</h1>
                        <a href="index.html" style="background: #ffffff;text-decoration: none;color: #000;font-weight: 700;padding: 15px 30px;margin-top: 10px;display: inline-block;">Back To Home</a>
                    </div>
                </div>
            </div>
        </body>
        </html>';
    } else {
        echo "Something went wrong. Please try again.";
    }
} else {
    echo "Invalid request.";
}
?>