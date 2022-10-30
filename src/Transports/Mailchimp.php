<?php 

namespace Hashemirafsan\TooMailable\Transports;

use Hashemirafsan\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Mailchimp\Transport\MandrillSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Mailchimp implements TransportInterface
{
    protected string $username;
    protected string $password;

    public function __construct(array $credentials = [])
    {
        $this->username = $credentials['username'] ?? '';
        $this->password = $credentials['password'] ?? '';
    }

    public function build(): EsmtpTransport
    {
        return new MandrillSmtpTransport($this->username, $this->password);
    }
}