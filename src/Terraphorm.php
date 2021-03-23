<?php
namespace Terraphorm;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * simple php and python wrapper on hazm persian text processor.
 */
class Terraphorm
{
    protected $process;
    protected $work_dir;
    protected $timeout;
    protected $base_cmd = 'terraform';

    public function __construct($work_dir, $timeout = 3600)
    {
        $this->work_dir = realpath($work_dir);
        $this->timeout = $timeout;
    }

    /**
     * Main commands
     */

    public function init(): bool
    {
        $results = $this->run('init', $this->work_dir);
        // Initializing an empty directory is acceptable (for now)
        $was_successful = 'Terraform has been successfully initialized!';
        $was_empty = 'Terraform initialized in an empty directory!';

        if (preg_match("/{$was_successful}/i", $results))
        {
            return true;
        } else {
            return false;
        }
    }

    public function validate()
    {
        $results = $this->run('validate');
    }

    public function plan()
    {
        $results = $this->run('plan');
    }

    public function apply()
    {
        $results = $this->run('apply');
    }

    public function destroy()
    {
        $results = $this->run('destroy');
    }

    /**
     * Extended / Other commands
     */
    public function show()
    {
        $results = $this->run('show');
    }

    public function taint()
    {
        $results = $this->run('taint');
    }

    public function untaint()
    {
        $results = $this->run('untaint');
    }

    public function version()
    {
        $results = $this->run('version', null, '-json');
        $version = json_decode($results, true);
        return $version['terraform_version'];
    }


    /**
     * Utility functions
     */

    function run($command, $cwd = null, $args = null)
    {
        $process = new Process($this->base_cmd  . ' ' . $command . ' ' . $args);
        $process->setTimeout($this->timeout);

        if ($cwd != null) {
            $process->setWorkingDirectory($cwd);
        }
    
        $process->run();

        if (! $process ->isSuccessful()) {
            throw new ProcessFailedException($process);
        }       

        return $process->getOutput();
    }

}