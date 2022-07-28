<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="mb-3">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">
            <div class="alert alert-danger text-center">
                <i class="la la-key"></i>
                {{ __('Organization') }} {{ __('Not fount') }}
            </div>
        </div>
    </x-auth-card>
</x-guest-layout>
