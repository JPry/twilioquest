<?php
/**
 *
 */

use Twilio\Rest\Client;

require_once __DIR__ . '/bootstrap.php';

// Phone numbers
$from = '+18564946006';
$to = '+12092104311';

// Message
$content = sprintf(
    'Greetings! The current time is: %s %s',
    date('H:i:s'),
    '72X85ZHWTUQQ0BO'
);

// Don't accidentally send!
exit;

try {
    $client = new Client(TWILIO_SID, TWILIO_TOKEN);
    $client->messages->create(
        $to,
        [
            'from' => $from,
            'body' => $content,
        ]
    );
} catch (Exception $e) {
    print_r($e->getMessage());
    exit(1);
}
