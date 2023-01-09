<?php

namespace App\Http\Livewire\Cards;

use App\Concerns\RunsCommands;
use Livewire\Component;

class Network extends Component
{
    use RunsCommands;

    public $networkName = 'web';

    public $networkStatus;

    public function mount()
    {
        $this->check();
    }

    public function check()
    {
        $command = implode(' ', [
            "sudo docker network ls",
            "--filter name={$this->networkName}",
            "--filter driver=bridge",
            "-q",
        ]);

        $this->runCommand($command);
    }

    public function createNetwork()
    {
        $command = implode(' ', [
            "sudo docker network create",
            "{$this->networkName}",
        ]);

        $this->runCommand($command);
    }

    public function commandFinished($output)
    {
        // null output means that Network was not found
        // signal: 0 => all ok
        // signal: 1 => network not found
        if ($output === null) {
            $this->networkStatus = 1;
        } else {
            $this->networkStatus = 0;
        }

    }
}
