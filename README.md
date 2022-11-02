# Laravel Too Mailable

A Laravel based package for changing `Mail` transport and it's credentials from application layer in runtime. Simple and easy abstraction `Mailable` layer will be provided with this package.

## Installation
You can start it from composer. Go to your terminal and run this command from your project root directory.

```php
composer require hashemi/laravel-too-mailable
```
- If you're using Laravel, then Laravel will automatically discover the package. In case it doesn't discover the package then add the following provider in your `config/app.php`'s **providers** array.
```php
Hashemi\TooMailable\TooMailableServiceProvider::class
```
## Usage
This package will be provide `TooMailable` abstract class and you need to use your mail class. This abstract class has two abstract method.

- `transport(): string|EsmtpTransport`
This method will be return package supported transport by string or custom transport class which will be `EsmtpTransport` inherited.

- `credentials(): array`
This method will be return necessary credentials of current transport.

Example:

```php
use Hashemi\TooMailable\TooMailable;

class SendVerificatioMail extends TooMailable
{
    //... 

    public function transport()
    {
        return 'amazon';
    }

    public function credentials()
    {
        return [
            'username' => 'my-user',
            'password' => 'password-123',
            'region' => 'us-east-2'
        ];
    }
}
