<?php

namespace AmqpLib\Tests\Functional;

use AmqpLib\Connection\AMQPSocketConnection;
use AmqpLib\Exception\AMQPProtocolChannelException;

class ChannelTest extends AbstractPublishConsumeTest
{
    protected function createConnection()
    {
        return new AMQPSocketConnection(HOST, PORT, USER, PASS, VHOST);
    }

    public function testDeclaringExchangeOnChannelWithClosedConnectionThrowsException()
    {
        $connection = $this->createConnection();
        $channel = $connection->channel();

        try {
            $channel->exchange_declare('tst.exchange2', 'topic', true);
        } catch (AMQPProtocolChannelException $e) {
            // Do Nothing
        }

        $this->setExpectedException('\AmqpLib\Exception\AMQPRuntimeException', 'Channel connection is closed.');
        $channel->exchange_declare('tst.exchange2', 'topic', false, true, false);

        $channel->close();
        $connection->close();
    }
}
