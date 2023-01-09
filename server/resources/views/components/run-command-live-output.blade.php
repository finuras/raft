<div
    @if($isKeepAliveOn || $manualKeepAlive)
        wire:poll.750ms="polling"
    @endif
></div>

@if($showOutput)
    <div>Activity ID: <span>{{ $activity?->id }}</span> </div>
    <pre
        style="
            background-color: #FFFFFF;
            width: 1200px;
            height: 600px;
            overflow-y: scroll;
            display: flex;
            flex-direction: column-reverse;
        "
        class="font-mono"
        placeholder="Build output"
    >
        {{ data_get($activity, 'description') }}
    </pre>

    @if($isKeepAliveOn || $manualKeepAlive) Checking for command... @endif

    <div>
        <input id="manualKeepAlive" name="manualKeepAlive" type="checkbox" wire:model="manualKeepAlive">
        <label for="manualKeepAlive"> Force polling </label>
    </div>
@endif
