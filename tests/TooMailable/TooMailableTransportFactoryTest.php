<?php

namespace Hashemi\TooMailable\Test;

use Hashemi\TooMailable\TooMailableServiceProvider;
use Hashemi\TooMailable\TooMailableTransportFactory;
use Orchestra\Testbench\TestCase;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesSmtpTransport;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Bridge\Mailchimp\Transport\MandrillSmtpTransport;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunSmtpTransport;
use Symfony\Component\Mailer\Bridge\Mailjet\Transport\MailjetSmtpTransport;
use Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpSmtpTransport;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridSmtpTransport;
use Symfony\Component\Mailer\Bridge\Sendinblue\Transport\SendinblueSmtpTransport;

class TooMailableTransportFactoryTest extends TestCase 
{
    protected function getPackageProviders($app)
    {
        return [
            TooMailableServiceProvider::class
        ];
    }

    public function testFactoryInstance() 
    {
        $factory = new TooMailableTransportFactory('amazon', []);
        $this->assertInstanceOf(TooMailableTransportFactory::class, $factory);
    }

    public function testFactoryGetTransportMethodForAmazon() 
    {
        $factory = new TooMailableTransportFactory('amazon', [
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(SesSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForGoogle() 
    {
        $factory = new TooMailableTransportFactory('google', [
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(GmailSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForMailchimp() 
    {
        $factory = new TooMailableTransportFactory('mailchimp', [
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(MandrillSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForMailgun() 
    {
        $factory = new TooMailableTransportFactory('mailgun', [
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(MailgunSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForMailjet() 
    {
        $factory = new TooMailableTransportFactory('mailjet', [
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(MailjetSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForOhMySmtp() 
    {
        $factory = new TooMailableTransportFactory('oh-my-smtp', [
            'id' => 'id',
        ]);

        $this->assertInstanceOf(OhMySmtpSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForPostMark() 
    {
        $factory = new TooMailableTransportFactory('oh-my-smtp', [
            'id' => 'id',
        ]);

        $this->assertInstanceOf(OhMySmtpSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForSendgrid() 
    {
        $factory = new TooMailableTransportFactory('sendgrid', [
            'key' => 'key',
        ]);

        $this->assertInstanceOf(SendgridSmtpTransport::class, $factory->getTransport());
    }

    public function testFactoryGetTransportMethodForSendinblue() 
    {
        $factory = new TooMailableTransportFactory('sendinblue', [
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(SendinblueSmtpTransport::class, $factory->getTransport());
    }
}