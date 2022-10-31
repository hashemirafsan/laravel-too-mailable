<?php 

namespace Hashemi\TooMailable\Transports;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\Valideto\Valideto;
use Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Postmark implements TransportInterface
{
    protected string $id;

    public function __construct(array $credentials)
    {
        $this->validate($credentials);
        
        $this->id = $credentials['id'];
    }

    public function validate(array $credentials)
    {
        $validator = new Valideto($credentials, [
            'id' => ['required', 'string'],
        ]);

        $validator->validate();

        if ($validator->fails()) {
            throw new Exception("Credentials mismatched!");
        }
    }

    public function build(): EsmtpTransport
    {
        return new PostmarkSmtpTransport($this->id);
    }
}