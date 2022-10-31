<?php 

namespace Hashemirafsan\TooMailable\Transports;

use Exception;
use Hashemi\Valideto\Valideto;
use Hashemirafsan\TooMailable\Interfaces\TransportInterface;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesSmtpTransport;
use Symfony\Component\Mailer\Transport\Smtp\EsmtpTransport;

class Amazon implements TransportInterface
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
            'region' => ['nullable', 'string'],
        ]);

        $validator->validate();

        if ($validator->fails()) {
            throw new Exception("Credentials mismatched!");
        }
    }

    public function build(): EsmtpTransport
    {
        return new SesSmtpTransport($this->username, $this->password, $this->region);
    }
}