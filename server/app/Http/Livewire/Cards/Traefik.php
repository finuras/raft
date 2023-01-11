<?php

namespace App\Http\Livewire\Cards;

use App\Concerns\RunsCommands;
use Livewire\Component;

class Traefik extends Component
{
    use RunsCommands;

    public $composeFolder;

    public $serviceStatus;

    public function mount()
    {
        $this->composeFolder = resource_path('library/traefik');

        $this->check();
    }

    public function check()
    {
        $this->serviceStatus = null;

        $command = implode(' ', [
            "sudo docker container ps",
            "--filter name=^sidecar_traefik$",
            "-q",
        ]);

        $this->runCommand($command);
    }

    public function composeUp()
    {
        $this->runCommand('sudo docker compose up -d', $this->composeFolder);
    }

    public function composeDown()
    {
        $this->runCommand('sudo docker compose down', $this->composeFolder);
    }

    public function commandFinished($output)
    {
        // null output means that the container was not found
        if ($output === null) {
            // signal: 1 => service not found
            $this->serviceStatus = 1;
        } else {
            // signal: 0 => all ok
            $this->serviceStatus = 0;
        }
    }
}
