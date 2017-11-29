<?php

namespace NotificationChannels\Infobip\Exceptions;

class InvalidConfiguration extends \Exception
{
    public static function configurationNotSet()
    {
        return new static("Invalid configuration.");
    }

}
