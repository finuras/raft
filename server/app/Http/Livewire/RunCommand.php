<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RunCommand extends Component
{
    public $activity;

    public $isKeepAliveOn = false;

    public $manualKeepAlive = false;

    public $command = 'sudo docker ps';

    public $cwd = null;

    public function render()
    {
        return view('livewire.run-command');
    }

    public function mount($cwd)
    {
        $this->cwd = $cwd;
//        $this->cwd = '/.config/finuras/raft';
//        $this->cwd = resource_path('library/traefik');

        $this->cwd = config('raft.cwd');


//        $this->command = 'ls -lah';
//        $this->command = 'sudo docker compose up -d --force-recreate';
//        $this->command = 'sudo docker compose stop';
        $this->command = 'sudo docker compose ps';
    }

    public function runCommand()
    {
        $this->activity = activity()
            ->withProperty('status', 'running')
            ->log("Running command...\n\n");

        $this->isKeepAliveOn = true;

        ray($this->cwd);

        dispatch(new \App\Jobs\ExecuteProcess($this->activity, $this->command, $this->cwd));
    }

    public function polling()
    {
        $this->activity?->refresh();

        if ($this->activity?->properties['status'] === 'finished') {
            $this->isKeepAliveOn = false;
        }
    }
}
