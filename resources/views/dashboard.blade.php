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

    <div class="row">

        <div class="col-7">
            @if($survey)
                <div class="card">
                    <div class="card-header bg-dark">
                        <div class="text-white">{{ Str::ucfirst($survey->name)  }}</div>
                    </div>
                    <div class="card-body mt-1 p-0">
                        <table class="table table-sm table-striped table-hover" style="cursor: pointer">
                            <thead>
                            <tr>
                                <th>{{ __('Universities') }}</th>
                                <th width="100">{{ __('Number of participation') }}</th>
                                <th>{{ __('backpack::crud.actions') }}</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($links as $link)
                                <tr ondblclick="window.location.href = '{{ $link['link'] }}'">
                                    <td>{{ $link['univer_name'] }}</td>
                                    <td>
                                        <div class="btn btn-dark">
                                            {{ $link['entry_count'] }}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ $link['link'] }}" class="btn btn-info text-white">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

            @endif
        </div>

        <div class="col-5">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="text-white">{{ $org->name }}</div>
                </div>
                <div class="card-body mt-1 p-0">
                    <table id="universities-table" class="table table-striped">
                        <tr>
                            <td><strong>{{ __('Ktut') }}:</strong></td>
                            <td>{{ $org->ktut }}</td>
                        </tr>

                        <tr>
                            <td><strong>{{ __('Stir') }}:</strong></td>
                            <td>{{ $org->stir }}</td>
                        </tr>

                        <tr>
                            <td><strong>{{ __('Address') }}:</strong></td>
                            <td>{{ $org->address }}</td>
                        </tr>

                    </table>
                </div>
            </div>
        </div>
    </div>


    <x-slot name="js">
        <script>
            $(document).ready( function () {
                $('#universities-table').DataTable();
            } );
        </script>

    </x-slot>

</x-app-layout>
