<?php

/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function __construct()
    {
        $this->stopOnFail();
    }

    public function testCi()
    {
        $this->_exec('php artisan key:generate');
        $this->taskComposerInstall()->run();
        $this->test();
    }

    public function test()
    {
        $this->stopOnFail(false);
        $resultStatic = $this->testStatic();
        $resultPhpunit = $this->testPhpunit();

        if (!($resultStatic && $resultPhpunit)) {
            throw new \Exception('At least one test failed');
        }
    }

    public function testStatic()
    {
        $this->stopOnFail(false);
        $resultLint = $this->testLint();
        $resultPhpstan = $this->testPhpstan();

        if (!($resultLint && $resultPhpstan)) {
            $this->say('<error>At least one static test failed</error>');
            return false;
        }
        return true;
    }

    public function testLint()
    {
        return $this->taskExec('vendor/bin/phpcs -s')->run()->wasSuccessful();
    }

    public function testPhpstan()
    {
        return $this->taskExec('vendor/bin/phpstan')->run()->wasSuccessful();
    }

    public function testPhpunit()
    {
        return $this->taskExec('vendor/bin/phpunit')->run()->wasSuccessful();
    }
}
