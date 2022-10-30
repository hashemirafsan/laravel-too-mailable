<?php

namespace Hashemirafsan\TooMailable\Interfaces;

use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

interface TransportInterface {
    public function build(): EsmtpTransport;
}