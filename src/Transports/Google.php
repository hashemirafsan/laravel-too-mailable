<?php 

namespace Hashemirafsan\TooMailable\Transports;

use Hashemirafsan\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Google\Transport\GmailSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Google implements TransportInterface
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
        return new GmailSmtpTransport($this->username, $this->password);
    }
}