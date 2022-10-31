<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\Mailjet;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Mailjet\Transport\MailjetSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class MailjetTransportTest extends TestCase 
{
    public function testMailjetTransport() 
    {
        $transport = new Mailjet([
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(MailjetSmtpTransport::class, $transport->build());
    }

    public function testMailjetTransportWithoutUsername() 
    {
        try {
            new Mailjet([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }

    public function testMailjetTransportWithoutPassword() 
    {
        try {
            new Mailjet([
                'username' => 'username',
            ]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}