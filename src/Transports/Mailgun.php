<?php 

namespace Hashemi\TooMailable\Transports;

use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Mailgun implements TransportInterface
{
    protected string $username;
    protected string $password;
    protected ?string $region;

    public function __construct(array $credentials = [])
    {
        $this->username = $credentials['username'] ?? '';
        $this->password = $credentials['password'] ?? '';
        $this->region = $credentials['region'] ?? null;
    }

    public function build(): EsmtpTransport
    {
        return new MailgunSmtpTransport($this->username, $this->password, $this->region);
    }
}