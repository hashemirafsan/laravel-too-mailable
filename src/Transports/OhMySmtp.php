<?php 

namespace Hashemi\TooMailable\Transports;

use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\OhMySmtp\Transport\OhMySmtpSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class OhMySmtp implements TransportInterface
{
    protected string $id;

    public function __construct(array $credentials = [])
    {
        $this->id = $credentials['id'] ?? '';
    }

    public function build(): EsmtpTransport
    {
        return new OhMySmtpSmtpTransport($this->id);
    }
}