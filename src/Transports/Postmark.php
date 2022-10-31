<?php 

namespace Hashemi\TooMailable\Transports;

use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Postmark extends AbstractTransport implements TransportInterface
{
    protected string $id;

    public function __construct(array $credentials)
    {
        $this->validate($credentials);

        $this->id = $credentials['id'];
    }

    public function credentialRules(): array
    {
        return [
            'id' => ['required', 'string'],
        ];
    }

    public function build(): EsmtpTransport
    {
        return new PostmarkSmtpTransport($this->id);
    }
}