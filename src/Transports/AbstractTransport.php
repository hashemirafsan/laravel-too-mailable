<?php

namespace Hashemi\TooMailable\Transports;

use Exception;
use Hashemi\Valideto\Valideto;

abstract class AbstractTransport 
{
    abstract public function credentialRules(): array;
    
    public function validate(array $credentials)
    {
        $validator = new Valideto($credentials, $this->credentialRules());

        $validator->validate();

        if ($validator->fails()) {
            throw new Exception("Credentials mismatched!");
        }
    }
}