<?php

namespace App\Services\Message;

class MessageService
{
    private $message;
    public function __construct(MessageInterface $message)
    {
        $this->message = $message;
    }

    public function sendMessage() {
        $this->message->sendMessage();
    }
}
