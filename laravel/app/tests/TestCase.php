<?php

use Laracasts\TestDummy\Factory as LFaker;


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
        LFaker::$factoriesPath = 'app/tests/factories';

        $unitTesting = true;
        $testEnvironment = 'testing';

        $_SERVER['LARAVEL_ENV'] = $testEnvironment;

        return require __DIR__ . '/../../bootstrap/start.php';
    }

    /**
     * @param \BaseModel $model
     * @param string $attribute
     * @param string $message
     */
    protected function assertModelHasError($model, $attribute, $message = ""){
        if($message == ""){
            $message = "Model has error " . get_class($model) . ':' . $attribute;
        }

        $hasError = false;

        $model->validateAttributes();
        $messages = $model->getValidationMessages();

        if($messages != null && $messages->has($attribute)){
            $hasError = true;
        }

        return $this->assertTrue($hasError, $message);
    }


}
