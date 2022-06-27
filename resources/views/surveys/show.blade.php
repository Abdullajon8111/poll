<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ $survey->name }}
        </h2>
    </x-slot>

    <form action="{{ route('survey-entry.store', compact('university', 'survey')) }}" method="post">
        @csrf
        @include('survey::standard', ['survey' => $survey])
    </form>

</x-app-layout>
