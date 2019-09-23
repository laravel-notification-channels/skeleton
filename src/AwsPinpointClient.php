<?php

namespace NotificationChannels\AwsPinpoint;

use Aws\AwsClient;
use NotificationChannels\AwsPinpoint\Events\DeliveryFailed;
use NotificationChannels\AwsPinpoint\Exceptions\CouldNotSendNotification;

class AwsPinpointClient
{
    /**
     * @var AwsClient
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
            $result = $this->client->sendMessages([
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

            $output = $result->get('MessageResponse');

            foreach ($output['Result'] as $number => $res) {
                if ($res['DeliveryStatus'] !== 'SUCCESSFUL') {
                    // Trigger event for unsuccessful deliveries
                    event(new DeliveryFailed($number, $message->body, $res['StatusMessage']));
                }
            }
        } catch (Exception $exception) {
            throw CouldNotSendNotification::serviceRespondedWithAnError($exception);
        }
    }
}
