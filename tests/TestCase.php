<?php

abstract class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Verify the number of DOM elements.
     *
     * @param  string   $selector the DOM selector (jquery style)
     * @param  int      $number   how many elements should be present in the DOM
     *
     * @return $this
     */
    public function seeTotalElements($selector, $total)
    {
        $this->assertCount($total, $this->crawler->filter($selector));

        return $this;
    }
}
