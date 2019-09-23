<?php

namespace NotificationChannels\AwsPinpoint;

class AwsPinpointSmsMessage
{
    public $body;
    public $messageType = 'TRANSACTIONAL';
    public $recipients;
    public $senderId;

    public function __construct($body = '')
    {
        if (! empty($body)) {
            $this->body = trim($body);
        }
    }

    public static function create($body = '')
    {
        return new static($body);
    }

    public function setBody($body)
    {
        $this->body = trim($body);

        return $this;
    }

    public function setMessageType($type)
    {
        $this->messageType = $type;

        return $this;
    }

    public function setRecipients($recipients)
    {
        if (is_string($recipients) === true || is_integer($recipients) === true) {
            $recipients = [$recipients];
        }

        $output = [];

        foreach ($recipients as $number) {
            $output[$number] = [
                'ChannelType' => 'SMS',
            ];
        }

        $this->recipients = $output;

        return $this;
    }
}
