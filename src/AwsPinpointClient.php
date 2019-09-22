<?php

namespace NotificationChannels\AwsPinpoint;

use Aws\AwsClient;
use NotificationChannels\AwsPinpoint\AwsPinpointMessage;
use NotificationChannels\AwsPinpoint\Exceptions\CouldNotSendNotification;

class AwsPinpointClient
{
    /**
     * @var AwsClient $client
     */
    protected $client;

    /**
     * Create a AwsPinpointClient instance.
     *
     * @param AwsClient $client
     */
    public function __construct(AwsClient $client = null)
    {
        $this->client = $client;
    }

    /**
     * Send the Message.
     *
     * @param AwsPinpointMessage $message
     * @throws CouldNotSendNotification
     */
    public function send(AwsPinpointMessage $message)
    {
        try {
            $this->client->sendMessages([
                'ApplicationId' => config('aws.Pinpoint.application_id'),
                'MessageRequest' => [
                    'Addresses' => $message->recipients,
                    'MessageConfiguration' => [
                        'SMSMessage' => [
                            'Body' => $message->body,
                            'MessageType' => $message->messageType,
                            'SenderId' => config('aws.Pinpoint.sender_id'),
                        ],
                    ],
                ],
            ]);
        } catch (Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
