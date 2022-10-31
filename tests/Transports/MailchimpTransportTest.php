<?php

namespace Hashemi\TooMailable\Test;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\TooMailable\Transports\Mailchimp;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Mailer\Bridge\Mailchimp\Transport\MandrillSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class MailchimpTransportTest extends TestCase 
{
    public function testMailchimpTransport() 
    {
        $transport = new Mailchimp([
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(TransportInterface::class, $transport);
        $this->assertInstanceOf(EsmtpTransport::class, $transport->build());
        $this->assertInstanceOf(MandrillSmtpTransport::class, $transport->build());
    }

    public function testMailchimpTransportWithoutUsername() 
    {
        try {
            new Mailchimp([]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }

    public function testMailchimpTransportWithoutPassword() 
    {
        try {
            new Mailchimp([
                'username' => 'username',
            ]);
        } catch (\Throwable $th) {
            $this->assertInstanceOf(Exception::class, $th);
            $this->assertSame('Credentials mismatched!', $th->getMessage());
        }
    }
}