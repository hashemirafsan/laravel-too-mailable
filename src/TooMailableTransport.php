<?php

namespace Hashemirafsan\TooMailable;

use Error;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class TooMailableTransport
{
    protected string|EsmtpTransport $transport;
    protected array $credentials = [];

    public function __construct(string|EsmtpTransport $transport, array $credentials = [])
    {
        $this->transport = $transport;
        $this->credentials = $credentials;
    }

    public function setTransport(string|EsmtpTransport $transport)
    {
        $this->transport = $transport;

        return $this;
    }

    public function getTransport(): EsmtpTransport
    {
        return $this->buildTransport();
    }

    public function setCredentials(array $credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    protected function buildTransport(): EsmtpTransport
    {
        if ($this->transport instanceof EsmtpTransport) return $this->transport;

        if (! array_key_exists($this->transport, config('too-mailable.transports'))) {
            throw new Error("$this->transport is not acceptable by this package!");
        }

        $transport = config('too-mailable.transports.' . $this->transport);

        return (new $transport($this->credentials))->build();
    }
}