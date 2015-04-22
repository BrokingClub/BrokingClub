<?php

/**
 * Class TestCase
 */
class TestCase extends Illuminate\Foundation\Testing\TestCase
{

    /**
     * @return mixed
     */
    public function createApplication()
    {
        $unitTesting = true;
        $testEnvironment = 'testing';

        $_SERVER['LARAVEL_ENV'] = $testEnvironment;

        return require __DIR__ . '/../../bootstrap/start.php';
    }


}
