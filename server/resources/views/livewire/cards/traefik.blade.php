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
                wire:click="check"
            >
                Check
            </button>
        </div>

        <x-run-command-live-output
            :$activity
            :$isKeepAliveOn
            :$manualKeepAlive
            :showOutput="false"
        />

        <div>
            <iframe
                id="iframe"
                src="http://traefik.test"
                class="h-[600px] w-full max-w-[1200px] rounded-lg"
            ></iframe>

            <script>
                window.addEventListener('resize', () => {
                    document.getElementById('iframe').width = window.innerWidth
                })
            </script>
        </div>
    </div>
</div>
