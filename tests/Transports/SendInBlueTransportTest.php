<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\SendInBlue;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Sendinblue\Transport\SendinblueSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class SendInBlueTransportTest extends TestCase 
{
    public function testSendInBlueTransport() 
    {
        $transport = new SendInBlue([
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(SendinblueSmtpTransport::class, $transport->build());
    }

    public function testSendInBlueTransportWithoutUsername() 
    {
        try {
            new SendInBlue([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }

    public function testSendInBlueTransportWithoutPassword() 
    {
        try {
            new SendInBlue([
                'username' => 'username',
            ]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}