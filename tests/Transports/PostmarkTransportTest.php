<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\Postmark;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class PostmarkTransportTest extends TestCase 
{
    public function testPostmarkTransport() 
    {
        $transport = new Postmark([
            'id' => 'id',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(PostmarkSmtpTransport::class, $transport->build());
    }

    public function testPostmarkTransportWithoutId() 
    {
        try {
            new Postmark([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}