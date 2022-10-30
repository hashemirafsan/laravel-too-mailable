<?php

namespace Hashemirafsan\TooMailable;

use Error;
use Illuminate\Support\Arr;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class TooMailableTransport
{
    protected EsmtpTransport $transport;
    protected array $credentials;

    public function __construct(string|EsmtpTransport $transport, array $credentials = [])
    {
        $this->transport = $this->buildTransport($transport);
        $this->credentials = $credentials;
    }

    public function setTransport(string|EsmtpTransport $transport)
    {
        $this->transport = $this->buildTransport($transport);

        return $this;
    }

    public function getTransport(): EsmtpTransport
    {
        return $this->transport;
    }

    public function setCredentials(array $credentials)
    {
        $this->credentials = $credentials;

        return $this;
    }

    protected function buildTransport(string|EsmtpTransport $transport): EsmtpTransport
    {
        if ($transport instanceof EsmtpTransport) return $transport;

        if (! Arr::has(array_keys(config('too-mailable.transports')), $transport)) {
            throw new Error("$transport is not acceptable by this package!");
        }

        $transport = config('too-mailable.transports.' . $transport);

        return (new $transport($this->credentials))->build();
    }
}