<?php 

namespace Hashemi\TooMailable\Transports;

use Exception;
use Hashemi\TooMailable\Interfaces\TransportInterface;
use Hashemi\Valideto\Valideto;
use Symfony\Component\Mailer\Bridge\Mailjet\Transport\MailjetSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Mailjet implements TransportInterface
{
    protected string $username;
    protected string $password;

    public function __construct(array $credentials)
    {
        $this->validate($credentials);

        $this->username = $credentials['username'];
        $this->password = $credentials['password'];
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
        return new MailjetSmtpTransport($this->username, $this->password);
    }
}