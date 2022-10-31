<?php 

namespace Hashemi\TooMailable\Transports;

use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Sendinblue\Transport\SendinblueSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class SendInBlue extends AbstractTransport implements TransportInterface
{
    protected string $username;
    protected string $password;

    public function __construct(array $credentials)
    {
        $this->validate($credentials);

        $this->username = $credentials['username'];
        $this->password = $credentials['password'];
    }

    public function credentialRules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    public function build(): EsmtpTransport
    {
        return new SendinblueSmtpTransport($this->username, $this->password);
    }
}