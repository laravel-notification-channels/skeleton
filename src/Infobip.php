<?php

namespace NotificationChannels\Infobip;

use NotificationChannels\Infobip\Exceptions\CouldNotSendNotification;
use infobip\api\client\SendSingleTextualSms as SmsSender;

class Infobip
{
    /**
     * @var smsSender
     */
    protected $smsSender;

    /**
     * Infobip constructor.
     *
     * @param  SmsSender $smsSender
     */
    public function __construct(SmsSender $smsSender)
    {
        $this->smsSender = $smsSender;
    }

    /**
     * Send an sms message using the SmsSender.
     *
     * @param InfobipSmsMessage $message
     * @return response
     */
    public function sendSmsMessage(InfobipSmsMessage $message)
    {
        return $this->smsSender->execute($message);
    }

}
