<div class="card bg-primary" >
    <div class="card-body">
        <h2 class="card-title text-primary-content">Run custom command</h2>
        <div class="flex gap-4">
            <input wire:model="command" type="text" class="input w-full max-w-xs text-black"/>

            <button
                wire:click="run"
                @class([
                    'btn btn-accent',
                    'loading' => $isKeepAliveOn,
                ])
                wire:click="createNetwork"
            >
                Run
            </button>
        </div>

        <x-run-command-live-output :$activity :$isKeepAliveOn :$manualKeepAlive :showOutput="true"/>
    </div>
</div>
