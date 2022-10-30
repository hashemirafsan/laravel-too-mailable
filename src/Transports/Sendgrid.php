<?php 

namespace Hashemirafsan\TooMailable\Transports;

use Hashemirafsan\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Sendgrid implements TransportInterface
{
    protected string $key;

    public function __construct(array $credentials = [])
    {
        $this->key = $credentials['key'] ?? '';
    }

    public function build(): EsmtpTransport
    {
        return new SendgridSmtpTransport($this->key);
    }
}