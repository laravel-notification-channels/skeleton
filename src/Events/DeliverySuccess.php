<?php

namespace NotificationChannels\AwsPinpoint\Events;

class DeliverySuccess
{
    public $number;
    public $message;
    public $statusMessage;

    /**
     * Create a new event instance.
     *
     * @param string $number
     * @param string $message
     * @param string $statusMessage
     */
    public function __construct($number, $message, $statusMessage)
    {
        $this->number = $number;
        $this->message = $message;
        $this->statusMessage = $statusMessage;
    }
}
