$secret = '0x4AAAAAAA0GG2cMvLMIQvaXhybK_bUEDVM'; // Your secret key from Cloudflare
$response = $_POST['cf-turnstile-response']; // The response token from the form

$verifyUrl = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';
$data = [
    'secret' => $secret,
    'response' => $response,
];

$options = [
    'http' => [
        'method' => 'POST',
        'content' => http_build_query($data),
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
    ]
];
$context = stream_context_create($options);
$result = file_get_contents($verifyUrl, false, $context);
$resultJson = json_decode($result);

if ($resultJson->success) {
    // CAPTCHA passed, process the form
} else {
    // CAPTCHA failed, show an error
}
