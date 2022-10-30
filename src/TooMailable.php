<?php

namespace Hashemirafsan\TooMailable;

use Hashemirafsan\TooMailable\Interfaces\TooMailableTransportInterface;
use Illuminate\Mail\Mailable;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;


abstract class TooMailable extends Mailable 
{
    abstract public function transport(): string|EsmtpTransport;
    abstract public function credentials(): array;

    public function send($mailer)
    {
        $buildTransport = new TooMailableTransport($this->transport(), $this->credentials());
        $mailer->setSymfonyTransport($buildTransport->getTransport());

        return parent::send($mailer);
    }
}