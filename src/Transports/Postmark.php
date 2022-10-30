<?php 

namespace Hashemirafsan\TooMailable\Transports;

use Hashemirafsan\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Postmark implements TransportInterface
{
    protected string $id;

    public function __construct(array $credentials = [])
    {
        $this->id = $credentials['id'] ?? '';
    }

    public function build(): EsmtpTransport
    {
        return new PostmarkSmtpTransport($this->id);
    }
}