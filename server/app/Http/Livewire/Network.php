<?php

namespace App\Http\Livewire;

use App\Concerns\RunsCommands;
use Livewire\Component;

class Network extends Component
{
    use RunsCommands;

    public $networkName = 'web';

    public $networkStatus = 'checking';

    public function mount()
    {
        $this->check();
    }

    public function check()
    {
        $command = [
            "sudo docker network ls",
            "--filter name={$this->networkName}",
            "--filter driver=bridge",
        ];

        $this->runCommand(implode($command));
    }

    public function commandFinished($output)
    {
        if ($output === null) {

        }
    }

    public function render()
    {
        return <<<'blade'
        <div>

            <div class="card w-96 bg-primary text-primary-content">
              <div class="card-body">
                <h2 class="card-title">Network</h2>
                <input
                    wire:model="networkName"
                    type="text"
                    placeholder="Network name"
                    class="input text-black w-full max-w-xs"
                 />

                 <div class="h-2"></div>

                <div class="card-actions justify-between items-center">
                    <p> Network OK </p>
                    <button
                        @class([
                            'btn',
                            'loading' => $isKeepAliveOn,
                        ])
                        wire:click="check"
                    >
                        Check
                    </button>
                </div>
              </div>
            </div>

            <x-run-command-live-output :$activity :$isKeepAliveOn :$manualKeepAlive :showOutput="false" />
        </div>

        blade;
    }
}
