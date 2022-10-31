<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\OhMySmtp;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class OhMySmtpTransportTest extends TestCase 
{
    public function testOhMySmtpTransport() 
    {
        $transport = new OhMySmtp([
            'id' => 'id',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(OhMySmtpSmtpTransport::class, $transport->build());
    }

    public function testOhMySmtpTransportWithoutId() 
    {
        try {
            new OhMySmtp([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}