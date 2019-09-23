<?php

namespace NotificationChannels\AwsPinpoint;

use Illuminate\Notifications\Notification;

class AwsPinpointChannel
{
    /**
     * @var \NotificationChannels\AwsPinpoint\AwsPinpointClient
     */
    protected $client;

    /**
     * Create a AwsPinpointChannel instance.
     *
     * @param \NotificationChannels\AwsPinpoint\AwsPinpointClient $client
     */
    public function __construct(AwsPinpointClient $client)
    {
        $this->client = $client;
    }

    /**
     * Send the given notification.
     *
     * @param mixed $notifiable
     * @param \Illuminate\Notifications\Notification $notification
     */
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toAwsPinpoint($notifiable);

        if (is_string($message)) {
            $message = AwsPinpointSmsMessage::create($message);
        }

        if ($to = $notifiable->routeNotificationFor('awspinpoint')) {
            $message->setRecipients($to);
        }

        $this->client->send($message);
    }
}
