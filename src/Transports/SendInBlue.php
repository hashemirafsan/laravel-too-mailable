<?php 

namespace Hashemirafsan\TooMailable\Transports;

use Hashemirafsan\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Sendinblue\Transport\SendinblueSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class SendInBlue implements TransportInterface
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
        return new SendinblueSmtpTransport($this->username, $this->password);
    }
}