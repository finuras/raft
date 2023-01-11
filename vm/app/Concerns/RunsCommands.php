<?php

namespace App\Concerns;

trait RunsCommands
{
    public $activity;
    public $isKeepAliveOn = false;
    public $manualKeepAlive = false;

    public function runCommand($command, $cwd = null)
    {
        $this->isKeepAliveOn = true;

        $this->activity = activity()
            ->withProperty('status', 'running')
            ->log("Running command...\n\n");

        dispatch(new \App\Jobs\ExecuteProcess($this->activity, $command, $cwd));
    }

    public function polling()
    {
        $this->activity?->refresh();

        if (in_array($this->activity?->properties['status'], ['finished', 'failed'])) {
            $this->isKeepAliveOn = false;
            $this->commandFinished($this->activity->output);
        }
    }

    public function commandFinished()
    {
        //
    }
}
