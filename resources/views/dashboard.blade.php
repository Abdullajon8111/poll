<?php
/** @var $org Organization */
/** @var $survey Survey */

/** @var $links array */

use App\Models\Organization;
use App\Models\Survey;

$org = auth('org')->user();
?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="card my-4">
        <div class="card-body">
            <table class="table table-striped">
                <tr>
                    <td><strong>{{ __('Ktut') }}:</strong></td>
                    <td>{{ $org->ktut }}</td>
                </tr>

                <tr>
                    <td><strong>{{ __('Stir') }}:</strong></td>
                    <td>{{ $org->stir }}</td>
                </tr>

                <tr>
                    <td><strong>{{ __('Name') }}:</strong></td>
                    <td>{{ $org->name }}</td>
                </tr>

                <tr>
                    <td><strong>{{ __('Address') }}:</strong></td>
                    <td>{{ $org->address }}</td>
                </tr>

            </table>
        </div>
    </div>

    @if($survey)
        <div class="card my-4">
            <div class="card-body">
                <ul>
                    @foreach($links as $link)
                        <li>
                            <span>({{ $link['survey_name'] }})</span>
                            <span>{{ $link['univer_name'] }}</span>
                            <br>
                            <a href="{{ $link['link'] }}">{{ $link['link'] }}</a>
                            <br>
                            <br>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</x-app-layout>
