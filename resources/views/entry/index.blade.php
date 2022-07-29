<?php

use App\Models\Entry;
use App\Models\Organization;
use App\Models\Survey;
use App\Models\University;

/** @var $org Organization */
/** @var $entries Entry[] */
/** @var $surveys Survey[] */
/** @var $universities University[] */

?>


<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Entry') }}
        </h2>
    </x-slot>

    <form action="{{ route('entry.index') }}" method="get">
        <div class="row">
            <div class="form-group col-md-3">
                <label>{{ __('Survey') }}</label>
                <select class="custom-select form-control select2" name="survey">
                    <option value="">{{ __('Select') }}</option>
                    @foreach($surveys as $survey)
                        <option value="{{ $survey->id }}" {{ request('survey') == $survey->id ? 'selected' : '' }}>
                            {{ $survey->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-md-3">
                <label>{{ __('Universities') }}</label>
                <select class="custom-select form-control select2" name="university">
                    <option value="">{{ __('Select') }}</option>
                    @foreach($universities as $university)
                        <option
                            value="{{ $university->id }}" {{ request('university') == $university->id ? 'selected' : '' }}>
                            {{ $university->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="">&ensp;</label><br>
                    <button class="btn btn-dark ml-auto">
                        {{ __('Search') }}
                    </button>
                </div>
            </div>
        </div>

    </form>

    <div class="card my-4">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="bg-dark text-white">
                <tr>
                    <th>{{ __('#') }}</th>
                    <th>{{ __('Survey') }}</th>
                    <th>{{ __('University') }}</th>
                    <th>{{ __('Time') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($entries as $entry)
                    <tr style="cursor:pointer;" ondblclick="window.location.href = '{{ route('entry.show', compact('entry')) }}'">
                        <td>{{ $entries->firstItem() + $loop->index }}</td>
                        <td>{{ $entry->survey->name }}</td>
                        <td>{{ $entry->university->name ?? '' }}</td>
                        <td>{{ $entry->created_at->format('d.m.Y H:i:s') ?? '' }}</td>
                    </tr>
                @endforeach
                </tbody>

            </table>

            {{ $entries->links() }}
        </div>
    </div>
</x-app-layout>
