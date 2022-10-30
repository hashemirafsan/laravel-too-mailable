<?php

namespace Hashemirafsan\TooMailable;

use Error;
use Illuminate\Support\Arr;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesSmtpTransport;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Bridge\Mailchimp\Transport\MandrillSmtpTransport;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class TooMailTransport extends Transport
{
    protected EsmtpTransport $transport;
    protected array $credentials;

    public function __construct(string|EsmtpTransport $transport, array $credentials = [])
    {
        $this->transport = $this->buildTransport($transport);
        $this->credentials = $credentials;
    }

    public function setTransport(string|EsmtpTransport $transport)
    {
        $this->transport = $this->buildTransport($transport);

        return $this;
    }

    public function setCredentials(array $credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    protected function buildTransport(string|EsmtpTransport $transport)
    {
        if ($transport instanceof EsmtpTransport) return $transport;

        if (! Arr::has(config('too-mailable.accepted_transport'), $transport)) {
            throw new Error("$transport is not acceptable by this package!");
        }

        return Arr::get($this->mapTransport(), $this->transport);
    }

    public function getTransport(): EsmtpTransport
    {
        return $this->transport;
    }

    private function mapTransport(): array
    {
        return [
            'amazon' => $this->amazonTransport()
        ];
    }

    private function amazonTransport(): EsmtpTransport
    {
        $username = Arr::get($this->credentials, 'username', '');
        $password = Arr::get($this->credentials, 'password', '');
        $region = Arr::get($this->credentials, 'region', null);

        return new SesSmtpTransport($username, $password, $region);
    }

    public function googleTransport(): EsmtpTransport
    {
        $username = Arr::get($this->credentials, 'username', '');
        $password = Arr::get($this->credentials, 'password', '');

        return new GmailSmtpTransport($username, $password);
    }

    public function mailchimpTransport(): EsmtpTransport
    {
        $username = Arr::get($this->credentials, 'username', '');
        $password = Arr::get($this->credentials, 'password', '');

        return new MandrillSmtpTransport($username, $password);
    }

    public function mailgunTransport(): EsmtpTransport
    {
        $username = Arr::get($this->credentials, 'username', '');
        $password = Arr::get($this->credentials, 'password', '');
        $region = Arr::get($this->credentials, 'region', null);

        return new MailgunSmtpTransport($username, $password, $region);
    }
}