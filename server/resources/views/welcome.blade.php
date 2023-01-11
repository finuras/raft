@extends('layouts.app')

@section('content')
    <div class="prose mx-auto card p-4">

        <h1 class="text-4xl font-bold"> Sidecar </h1>

        <div class="mt-8"></div>

        <livewire:cards.network></livewire:cards.network>

        <div class="mt-8"></div>

        <livewire:cards.traefik></livewire:cards.traefik>

{{--        <div class="mt-8"></div>--}}
{{--        <livewire:cards.run-custom-command--}}
{{--            :cwd="base_path()"--}}
{{--        ></livewire:cards.run-custom-command>--}}

    </div>
@endsection
