<?php
/**
 *
 */

namespace JPry\TwilioQuest;

use InvalidArgumentException;

final class ListHandler
{
    private $todoStorage;

    public function __construct(string $todoStorage)
    {
        if (!is_readable($todoStorage)) {
            throw new InvalidArgumentException('File provided is not readable.');
        }

        $this->todoStorage = $todoStorage;
    }

    public function getList(): ToDo
    {
        $this->maybeMakeFile();

        /** @var array $list */
        $list = include $this->todoStorage;
        return new ToDo($list);
    }

    public function writeList(ToDo $todo)
    {
        $list = $todo->list();
        $content = sprintf("<?php\n\nreturn %s;\n", var_export($list, true));
        file_put_contents($this->todoStorage, $content);
    }

    private function maybeMakeFile()
    {
        if (!file_exists($this->todoStorage)) {
            file_put_contents($this->todoStorage, "<?php\n\nreturn array();\n");
        }
    }
}
