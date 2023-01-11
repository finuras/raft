<?php

namespace App\Http\Livewire\Cards;

use App\Concerns\RunsCommands;
use Livewire\Component;

class RunCustomCommand extends Component
{
    use RunsCommands;

    public $command = 'sudo docker ps';

    public $cwd;

    public function mount($cwd = null)
    {
        $this->cwd = $cwd;
    }

    public function run()
    {
        $this->runCommand($this->command, $this->cwd);
    }

    public function commandFinished($output)
    {
        //
    }
}
