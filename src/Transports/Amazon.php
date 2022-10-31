<?php 

namespace Hashemi\TooMailable\Transports;

use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Amazon extends AbstractTransport implements TransportInterface
{
    protected string $username;
    protected string $password;
    protected ?string $region;

    public function __construct(array $credentials)
    {
        $this->validate($credentials);

        $this->username = $credentials['username'];
        $this->password = $credentials['password'];
        $this->region = $credentials['region'] ?? null;
    }

    public function credentialRules(): array
    {
        return [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
            'region' => ['nullable', 'string'],
        ];
    }

    public function build(): EsmtpTransport
    {
        return new SesSmtpTransport($this->username, $this->password, $this->region);
    }
}