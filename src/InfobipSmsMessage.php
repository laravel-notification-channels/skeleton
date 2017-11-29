<?php

namespace NotificationChannels\Infobip;

use infobip\api\model\sms\mt\send\textual\SMSTextualRequest;

class InfobipSmsMessage extends SMSTextualRequest
{
    /**
     * Create a message object.
     * @param string $content
     * @return static
     */
    public static function create($content = '')
    {
        return new static($content);
    }

    /**
     * Create a new message instance.
     *
     * @param  string $content
     */
    public function __construct($content = '')
    {
        $this->setText($content);
    }

    /**
     * Set the message content.
     *
     * @param  string $content
     * @return $this
     */
    public function content($content)
    {
        $this->setText($content);
        return $this;
    }

    /**
     * Set the phone number the message should be sent from.
     *
     * @param  string $from
     * @return $this
     */
    public function from($from)
    {
        $this->setFrom($this->from = $from);
        return $this;
    }

    /**
     * Get the from address.
     *
     * @return string
     */
    public function getFrom()
    {
        if ($this->from) {
            return $this->from;
        }
    }
}
