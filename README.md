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
