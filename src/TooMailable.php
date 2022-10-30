<?php

namespace Hashemirafsan\TooMailable;

use Illuminate\Mail\Mailable;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;


abstract class TooMailable extends Mailable 
{
    abstract public function credentials(): array;
    abstract public function transport(): string|EsmtpTransport;

    public function send($mailer)
    {
        $buildTransport = new TooMailTransport($this->transport(), $this->credentials());
        $mailer->setSymfonyTransport($buildTransport->getTransport());

        return parent::send($mailer);
    }
}