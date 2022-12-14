<?php 

namespace Hashemi\TooMailable\Transports;

use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Sendgrid\Transport\SendgridSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Sendgrid extends AbstractTransport implements TransportInterface
{
    protected string $key;

    public function __construct(array $credentials)
    {
        $this->validate($credentials);

        $this->key = $credentials['key'];
    }

    public function credentialRules(): array
    {
        return [
            'key' => ['required', 'string'],
        ];
    }

    public function build(): EsmtpTransport
    {
        return new SendgridSmtpTransport($this->key);
    }
}