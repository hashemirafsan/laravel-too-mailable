<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\Sendgrid;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class SendgridTransportTest extends TestCase 
{
    public function testSendgridTransport() 
    {
        $transport = new Sendgrid([
            'key' => 'key',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(SendgridSmtpTransport::class, $transport->build());
    }

    public function testSendgridTransportWithoutKey() 
    {
        try {
            new Sendgrid([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}