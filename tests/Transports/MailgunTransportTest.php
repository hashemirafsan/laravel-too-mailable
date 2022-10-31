<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\Mailgun;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class MailgunTransportTest extends TestCase 
{
    public function testMailgunTransport() 
    {
        $transport = new Mailgun([
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(MailgunSmtpTransport::class, $transport->build());
    }

    public function testMailgunTransportWithoutUsername() 
    {
        try {
            new Mailgun([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }

    public function testMailgunTransportWithoutPassword() 
    {
        try {
            new Mailgun([
                'username' => 'username',
            ]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}