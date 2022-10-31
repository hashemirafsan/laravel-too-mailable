<?php 

namespace Hashemi\TooMailable\Transports;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\Valideto\Valideto;
use Symfony\Component\Mailer\Bridge\Mailgun\Transport\MailgunSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Mailgun implements TransportInterface
{
    protected string $username;
    protected string $password;
    protected ?string $region;

    public function __construct(array $credentials)
    {
        $this->validate($credentials);

        $this->username = $credentials['username'];
        $this->password = $credentials['password'];
        $this->region = $credentials['region'] ?? null;
    }

    public function validate(array $credentials)
    {
        $validator = new Valideto($credentials, [
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        $validator->validate();

        if ($validator->fails()) {
            throw new Exception("Credentials mismatched!");
        }
    }

    public function build(): EsmtpTransport
    {
        return new MailgunSmtpTransport($this->username, $this->password, $this->region);
    }
}