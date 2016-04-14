<?php

namespace Laravel\SparkInstaller\Installation;

use Symfony\Component\Process\Process;
use Laravel\SparkInstaller\NewCommand;

class RunGulp
{
    protected $command;

    /**
     * Create a new installation helper instance.
     *
     * @param  NewCommand  $command
     * @return void
     */
    public function __construct(NewCommand $command)
    {
        $this->command = $command;
    }

    /**
     * Run the installation helper.
     *
     * @return void
     */
    public function install()
    {
        if (! $this->command->output->confirm('Would you like to run Gulp?', true)) {
            return;
        }

        $this->command->output->writeln('<info>Running Gulp...</info>');

        (new Process('gulp', $this->command->path))->setTty(true)->setTimeout(null)->run(function ($type, $line) {
            $this->command->output->write($line);
        });
    }
}
