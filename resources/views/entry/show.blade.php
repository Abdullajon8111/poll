<?php

/** @var $answers Answer[] */

use App\Models\Answer;

?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Entry') }}
        </h2>
    </x-slot>

    <div class="card my-4">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="bg-dark text-white">
                <tr>
                    <th>{{ __('ID') }}</th>
                    <th>{{ __('Question') }}</th>
                    <th>{{ __('Answer') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($answers as $item)
                    <tr style="cursor:pointer;">
                        <td>{{  $item->id }}</td>
                        <td>{!! $item->question->content !!}</td>
                        <td>{{  $item->value }} </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>
