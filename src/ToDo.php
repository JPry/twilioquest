<?php
/**
 *
 */

namespace JPry\TwilioQuest;

final class ToDo
{
    private $list = [];

    public function __construct(array $list)
    {
        foreach ($list as $item) {
            if (!($item instanceof ListItem)) {
                throw new \InvalidArgumentException('Items in the list must be instances of ListItem.');
            }
        }

        $this->list = $list;
    }

    public function add(ListItem $item)
    {
        $this->list[] = $item;
    }

    public function list() : array
    {
        return $this->list;
    }


    public function remove(int $itemNumber)
    {
        unset($this->list[$itemNumber]);
        $this->list = array_values($this->list);
    }
}
