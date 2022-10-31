<?php

namespace Hashemi\TooMailable;

use Illuminate\Mail\Mailable;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;


abstract class TooMailable extends Mailable 
{
    abstract public function transport(): string|EsmtpTransport;
    abstract public function credentials(): array;

    public function send($mailer)
    {
        $buildTransport = new TooMailableTransportFactory($this->transport(), $this->credentials());
        $mailer->setSymfonyTransport($buildTransport->getTransport());

        return parent::send($mailer);
    }
}