<?php

namespace App\Http\Livewire\Cards;

use App\Concerns\RunsCommands;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Traefik extends Component
{
    use RunsCommands;

    public $composeFolder;

    public $serviceStatus;

    public $isTraefikDashboardUp = false;

    public function mount()
    {
        $this->composeFolder = resource_path('library/traefik');

        $this->checkTraefikService();
    }

    public function checkTraefikDashboard()
    {
        try {
            $response = Http::get('http://host.docker.internal:5679/dashboard');

            if($response->ok()) {
                return $this->isTraefikDashboardUp = true;
            }

        } catch (\Throwable $th) {}

        $this->isTraefikDashboardUp = false;
    }

    public function checkTraefikService()
    {
        $this->serviceStatus = null;

        $command = implode(' ', [
            "sudo docker container ps",
            "--filter name=^sidecar_traefik$",
            "-q",
        ]);

        $this->runCommand($command);

        $this->checkTraefikDashboard();
    }

    public function composeUp()
    {
        $this->runCommand('sudo docker compose up -d', $this->composeFolder);

        $this->checkTraefikService();
    }

    public function composeDown()
    {
        $this->runCommand('sudo docker compose down', $this->composeFolder);

        $this->checkTraefikService();
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
