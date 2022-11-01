<?php

namespace Hashemi\TooMailable;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class TooMailableTransportFactory
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
            throw new Exception("$this->transport is not supported by this package!");
        }

        $transportNamespace = config('too-mailable.transports.' . $this->transport);
        
        $transport = (new $transportNamespace($this->credentials));

        if (! ($transport instanceof TransportInterface)) {
            throw new Exception("$transport is not acceptable by this package!");
        }

        return $transport->build();
    }
}