<?php
/**
 *
 */

namespace JPry\TwilioQuest;

final class ListItem
{
    private $item;

    public function __construct(string $item)
    {
        if (empty($item)) {
            throw new \InvalidArgumentException('Your item must not be empty.');
        }

        $this->item = $item;
    }

    public static function __set_state(array $properties) : self
    {
        return new self($properties['item']);
    }

    public function __toString() : string
    {
        return $this->item;
    }
}
