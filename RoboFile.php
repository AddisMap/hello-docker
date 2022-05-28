<?php
/**
 * This is project's console commands configuration for Robo task runner.
 *
 * @see http://robo.li/
 */
class RoboFile extends \Robo\Tasks
{
    public function test()
    {
        $this->taskComposerInstall()->run();
        $this->testStatic();
    }

    public function testStatic()
    {
        $this->testLint();
    }

    public function testLint()
    {
        $this->_exec('vendor/bin/phpcs');
    }
}
