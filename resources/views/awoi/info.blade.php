<?php /** @var $org Organization */

use App\Models\Organization; ?>

<x-guest-layout>
    <x-auth-card>
        @if($org)
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

                <form action="{{ route('awoi.auth') }}" method="post">
                    @csrf
                    <input type="hidden" name="stir" value="{{ request('stir') }}">
                    <input type="hidden" name="ktut" value="{{ request('ktut') }}">

                    <button class="btn btn-dark mt-3 btn-block">{{ __('Start') }}</button>
                </form>
            </div>


        @else
            <div class="card-body">
                <h3 class="text-center text-danger">
                    {{ __('Not found') }}
                </h3>
            </div>
        @endif
    </x-auth-card>
</x-guest-layout>
