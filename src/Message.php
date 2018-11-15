<?php
/**
 *
 */

namespace JPry\TwilioQuest;

final class Message
{
    const CHARACTER_LIMIT = 1600;

    private $message;

    public function __construct(string $message)
    {
        if (empty($message)) {
            throw new \InvalidArgumentException('Your message must not be empty.');
        }

        if (self::CHARACTER_LIMIT < strlen($message)) {
            throw new \InvalidArgumentException(
                sprintf('Your message cannot be more than %d characters.', self::CHARACTER_LIMIT)
            );
        }

        $this->message = $message;
    }

    public function __toString() : string
    {
        return $this->message;
    }
}
