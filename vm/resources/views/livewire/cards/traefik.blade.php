<div class="card bg-primary">
    <div class="card-body">
        <h2 class="card-title text-primary-content">Traefik Proxy</h2>

        <div class="card-actions text-primary-content justify-between items-center">
            @if($serviceStatus === 1)
                <p> Service not running. Click to fix - It will create it for you </p>
                <button
                    @class([
                        'btn',
                        'loading' => $isKeepAliveOn,
                    ])
                    wire:click="composeUp"
                >
                    Fix
                </button>
            @elseif($serviceStatus === 0)
                <p> Service ok </p>
            @else
                <p> Checking... </p>
            @endif
            <button
                @class([
                    'btn btn-accent',
                    'loading' => $isKeepAliveOn,
                ])
                wire:click="checkTraefikService"
            >
                Check
            </button>


            <button
                @class([
                    'btn btn-error',
                    'loading' => $isKeepAliveOn,
                ])
                wire:click="composeDown"
            >
                Stop
            </button>
        </div>

        <x-run-command-live-output
            :$activity
            :$isKeepAliveOn
            :$manualKeepAlive
            :showOutput="false"
        />

        <div>
            <div>
                @if($isTraefikDashboardUp)
                    <iframe
                        id="iframe"
                        src="http://localhost:5679"
                        class="h-[600px] w-full rounded-lg"
                    ></iframe>
                @endif
            </div>

            <script>
                const traefikFrame = document.getElementById('iframe');
                window.addEventListener('resize', () => {
                    if (traefikFrame) {
                        traefikFrame.width = window.innerWidth
                    }
                })
            </script>
        </div>
    </div>
</div>
