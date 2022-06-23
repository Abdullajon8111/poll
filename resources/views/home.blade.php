<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('home') }}
        </h2>
    </x-slot>

    @include('survey::standard', ['survey' => $survey])

</x-app-layout>
