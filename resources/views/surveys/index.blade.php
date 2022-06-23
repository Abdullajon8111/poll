<?php /** @var $surveys \App\Models\Survey[] */ ?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('home') }}
        </h2>
    </x-slot>

    <div class="list-group">
        @foreach($surveys as $survey)
            <a href="{{ route('survey.show', compact('survey')) }}" class="list-group-item list-group-item-action">{{ $survey->name }}</a>
        @endforeach
    </div>

</x-app-layout>
