<?php

namespace Hashemirafsan\TooMailable\Test;

use Exception;
use Hashemirafsan\TooMailable\Interfaces\TransportInterface;
use Hashemirafsan\TooMailable\Transports\Amazon;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class AmazonTransportTest extends TestCase 
{
    public function testAmazonTransport() 
    {
        $transport = new Amazon([
            'username' => 'username',
            'password' => 'password',
            'region' => 'us-east-2'
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(SesSmtpTransport::class, $transport->build());
    }

    public function testAmazonTransportWithoutUsername() 
    {
        try {
            new Amazon([
                'region' => 'us-east-2'
            ]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }

    public function testAmazonTransportWithoutPassword() 
    {
        try {
            new Amazon([
                'username' => 'username',
                'region' => 'us-east-2'
            ]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}