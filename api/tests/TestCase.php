<?php

namespace Tests;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $ptBrFaker;
    protected $url;

    public function setup(): void
    {
        parent::setUp();        

        $this->ptBrFaker = \Faker\Factory::create('pt_BR');
    }
}
