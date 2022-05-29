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
        $this->taskFilesystemStack()
            ->copy('.env.example', '.env')
            ->run();
        $this->_exec('php artisan key:generate');
        $this->taskComposerInstall()->run();
        $this->test(true);
    }

    public function test($checkStyle = false)
    {
        $this->stopOnFail(false);
        $resultStatic = $this->testStatic($checkStyle);
        $resultPhpunit = $this->testPhpunit($checkStyle);

        if (!($resultStatic && $resultPhpunit)) {
            throw new \Exception('At least one test failed');
        }
    }

    public function testStatic($checkStyle = false)
    {
        $this->stopOnFail(false);
        $resultLint = $this->testLint($checkStyle);
        $resultPhpstan = $this->testPhpstan($checkStyle);

        if (!($resultLint && $resultPhpstan)) {
            $this->say('<error>At least one static test failed</error>');
            return false;
        }
        return true;
    }

    public function testLint($checkStyle = false)
    {
        $result = $this->taskExec('vendor/bin/phpcs -s'. ($checkStyle ? ' --report-full --report-checkstyle=./phpcs-report.xml' : ''))->run()->wasSuccessful();
        if ($checkStyle) {
            $this->_exec('vendor/bin/cs2pr ./phpcs-report.xml');
        }
        return $result;
    }

    public function testPhpstan($checkStyle = false)
    {
        return $this->taskExec('vendor/bin/phpstan' . ($checkStyle ? ' --error-format=checkstyle | vendor/bin/cs2pr' : ''))->run()->wasSuccessful();
    }

    public function testPhpunit()
    {
        return $this->taskExec('vendor/bin/phpunit')->run()->wasSuccessful();
    }
}
