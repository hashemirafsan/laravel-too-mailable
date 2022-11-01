<?php

namespace Hashemi\TooMailable\Test;

use Hashemi\TooMailable\TooMailableServiceProvider;
use Hashemi\TooMailable\TooMailableTransportFactory;
use Orchestra\Testbench\TestCase;
use Symfony\Component\Mailer\Bridge\Amazon\Transport\SesSmtpTransport;

class TooMailableTransportFactoryTest extends TestCase 
{
    protected function getPackageProviders($app)
    {
        return [
            TooMailableServiceProvider::class
        ];
    }

    public function testFactoryInstance() 
    {
        $factory = new TooMailableTransportFactory('amazon', []);
        $this->assertInstanceOf(TooMailableTransportFactory::class, $factory);
    }

    public function testFactoryGetTransportMethod() 
    {
        $factory = new TooMailableTransportFactory('amazon', [
            'username' => 'username',
            'password' => 'password',
        ]);

        $this->assertInstanceOf(SesSmtpTransport::class, $factory->getTransport());
    }
}