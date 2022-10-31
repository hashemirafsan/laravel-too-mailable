<?php 

namespace Hashemi\TooMailable\Transports;

use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Mailjet\Transport\MailjetSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Mailjet implements TransportInterface
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
        return new MailjetSmtpTransport($this->username, $this->password);
    }
}