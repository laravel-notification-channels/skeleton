<?php

namespace NotificationChannels\Messagebird\Test;

use PHPUnit\Framework\TestCase;
use NotificationChannels\AwsPinpoint\AwsPinpointSmsMessage;

/**
 * phpcs:disable PSR1.Methods.CamelCapsMethodName.
 */
class AwsPinpointSmsMessageTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $message = new AwsPinpointSmsMessage;
        $this->assertInstanceOf(AwsPinpointSmsMessage::class, $message);
    }

    /** @test */
    public function it_can_accept_body_content_when_created()
    {
        $message = new AwsPinpointSmsMessage('Test');
        $this->assertEquals('Test', $message->body);
    }

    /** @test */
    public function it_supports_create_method()
    {
        $message = AwsPinpointSmsMessage::create('Test');
        $this->assertInstanceOf(AwsPinpointSmsMessage::class, $message);
        $this->assertEquals('Test', $message->body);
    }

    /** @test */
    public function it_can_set_body()
    {
        $message = (new AwsPinpointSmsMessage)->setBody('Test');
        $this->assertEquals('Test', $message->body);
    }

    /** @test */
    public function it_can_set_message_type()
    {
        $message = (new AwsPinpointSmsMessage)->setMessageType('PROMOTIONAL');
        $this->assertEquals('PROMOTIONAL', $message->messageType);
    }

    /** @test */
    public function it_can_set_recipients_from_array()
    {
        $message = (new AwsPinpointSmsMessage)->setRecipients([6421222333, 6421333444]);
        $this->assertEquals('6421222333', array_keys($message->recipients)[0]);
        $this->assertEquals('6421333444', array_keys($message->recipients)[1]);
    }

    /** @test */
    public function it_can_set_recipients_from_integer()
    {
        $message = (new AwsPinpointSmsMessage)->setRecipients(6421222333);
        $this->assertEquals('6421222333', array_keys($message->recipients)[0]);
    }

    /** @test */
    public function it_can_set_recipients_from_string()
    {
        $message = (new AwsPinpointSmsMessage)->setRecipients('6421222333');
        $this->assertEquals('6421222333', array_keys($message->recipients)[0]);
    }
}
