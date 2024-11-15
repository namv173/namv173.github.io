<?php
// Your secret key from Cloudflare
$secret = '0x4AAAAAAA0GG2cMvLMIQvaXhybK_bUEDVM';
$response = $_POST['cf-turnstile-response']; // The response token from the form

// Send the POST request to the Turnstile verification endpoint
$verifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
$data = [
    'secret' => $secret,
    'response' => $response,
];

// Use cURL to send the POST request
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $verifyUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

// Execute the request and get the response
$result = curl_exec($ch);
curl_close($ch);

// Decode the response
$resultJson = json_decode($result);

// Check if the CAPTCHA verification is successful
if ($resultJson->success) {
    // CAPTCHA passed, process the form (e.g., save data, send email, etc.)
    echo "Form submitted successfully!";
} else {
    // CAPTCHA failed, show an error
    echo "Error: CAPTCHA verification failed.";
}
?>
