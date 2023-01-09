<div class="mx-auto card w-[1220px] my-20">

    <livewire:network></livewire:network>

{{--    <livewire:run-command :cwd="base_path()"></livewire:run-command>--}}

    <div class="h-24"></div>

    <iframe id="iframe" src="http://traefik.test" height="1200"></iframe>

    <script>
        window.addEventListener('resize', () => {
            document.getElementById('iframe').width = window.innerWidth
        })
    </script>
</div>
