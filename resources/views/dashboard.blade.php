<?php
    /** @var $org Organization */
    use App\Models\Organization;
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
</x-app-layout>
