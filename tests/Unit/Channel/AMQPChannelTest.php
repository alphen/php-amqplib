<?php

namespace AmqpLib\Tests\Unit\Channel;

class AMQPChannelTest extends \PHPUnit_Framework_TestCase
{
    public function testCloseDoesNotEmitUndefinedPropertyWarningWhenSomeMethodsAreMocked()
    {
        $mockChannel = $this->getMockBuilder('\AmqpLib\Channel\AMQPChannel')
            ->setMethods(array('queue_bind'))
            ->disableOriginalConstructor()
            ->getMock();

        /* @var $mockChannel \AmqpLib\Channel\AMQPChannel */
        $mockChannel->close();
    }
}
