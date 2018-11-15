<?php

use JPry\TwilioQuest\ListHandler;
use JPry\TwilioQuest\ListItem;
use JPry\TwilioQuest\Message;
use JPry\TwilioQuest\Responder;
use Twilio\TwiML\MessagingResponse;

require_once dirname(__DIR__) . '/bootstrap.php';

function handleFromCountry()
{
    $fromCountry = $_REQUEST['FromCountry'] ?? '';

    $responder = new Responder();
    $responder->addMessage(new Message("FromCountry is {$fromCountry}"));
    $responder->respondAndExit();
}

function handleTodoList() {
    // Load the current todo list.
    $handler = new ListHandler(__DIR__ . '/todoList.php');
    $todo = $handler->getList();

    // Set up responder
    $responder = new Responder();

    // Determine what the message wants us to do.
    $body = $_REQUEST['Body'] ?? '';
    preg_match('#^(add|list|remove) *(.*)?$#i', $body, $matches);

    if (empty($matches[1])) {
        throw new InvalidArgumentException('Valid actions are "add", "list", and "remove".');
    }

    $action = strtolower($matches[1]);
    $data = $matches[2] ?? '';

    switch ($action) {
        case 'add':
            $todo->add(new ListItem($data));
            $handler->writeList($todo);
            $responder->addMessage(new Message(sprintf('Successfully added "%s" to your list.', $data)));
            break;

        case 'list':
            foreach ($todo->list() as $number => $item) {
                $responder->addMessage(new Message(sprintf('%d: %s', $number + 1, $item)));
            }
            break;

        case 'remove':
            $number = intval($data);
            $todo->remove($number - 1);
            $responder->addMessage(new Message(sprintf('Item #%d removed from the list', $number)));
            break;
    }

    $responder->respondAndExit();
}

try {
    handleTodoList();
} catch (Exception $e) {
    $response = new MessagingResponse();
    $response->message($e->getMessage());
    echo $response;
    error_log($e->getMessage(), 3, dirname(__DIR__) . '/log/error.log');
}

