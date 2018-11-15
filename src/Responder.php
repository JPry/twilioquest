<?php
/**
 *
 */

namespace JPry\TwilioQuest;

use Twilio\TwiML\MessagingResponse;

final class Responder
{
    private $responder;

    public function __construct()
    {
        // No dependency inversion here! We've got tight coupling on purpose :)
        $this->responder = new MessagingResponse();
    }

    public function addMessage(Message $message)
    {
        $this->responder->message((string) $message);
    }

    public function respond()
    {
        echo $this->responder;
    }

    public function respondAndExit()
    {
        $this->respond();
        exit;
    }
}
