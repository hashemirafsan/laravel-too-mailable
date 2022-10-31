<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\Google;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class GoogleTransportTest extends TestCase 
{
    public function testGoogleTransport() 
    {
        $transport = new Google([
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(GmailSmtpTransport::class, $transport->build());
    }

    public function testGoogleTransportWithoutUsername() 
    {
        try {
            new Google([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }

    public function testGoogleTransportWithoutPassword() 
    {
        try {
            new Google([
                'username' => 'username',
            ]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}