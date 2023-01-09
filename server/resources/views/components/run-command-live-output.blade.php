<div
    @if($isKeepAliveOn || $manualKeepAlive)
        wire:poll.750ms="polling"
    @endif
></div>

@if($showOutput)
    <div class="text-primary-content">Activity ID: <span>{{ $activity?->id }}</span> </div>
    <pre
        style="
            background-color: #FFFFFF;
            overflow-y: scroll;
            display: flex;
            flex-direction: column-reverse;
        "
        class="font-mono h-[600px] w-[1100px]"
        placeholder="Build output"
    >
        {{ data_get($activity, 'description') }}
    </pre>

    @if($isKeepAliveOn || $manualKeepAlive) Checking for command... @endif

    <div>
        <input id="manualKeepAlive" name="manualKeepAlive" type="checkbox" wire:model="manualKeepAlive">
        <label class="text-primary-content" for="manualKeepAlive"> Force polling </label>
    </div>
@endif
