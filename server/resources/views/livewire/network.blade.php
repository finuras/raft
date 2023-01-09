<div>

    <div class="card w-96 bg-primary text-primary-content">
        <div class="card-body">
            <h2 class="card-title">Network</h2>
            <input
                wire:model="networkName"
                type="text"
                readonly
                placeholder="Network name"
                class="input text-black w-full max-w-xs"
            />

            <div class="h-2"></div>

            <div class="card-actions justify-between items-center">
                @if($networkStatus === 1)
                <p> Network does not exist. Click to fix - It will create it for you </p>
                <button
                    @class([
                        'btn',
                        'loading' => $isKeepAliveOn,
                    ])
                    wire:click="createNetwork"
                >
                    Fix
                </button>
                @elseif($networkStatus === 0)
                <p> Network ok </p>
                @else
                <p> Checking... </p>
                @endif
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
