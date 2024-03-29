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
                {{ __('Stir') }} {{ __('Not found') }}
            </div>

            <a href="{{ route('one-id.login.redirect') }}" class="btn btn-info btn-block mt-3">
                <i class="la la-key"></i>
                {{ __('Login') }}
            </a>
        </div>
    </x-auth-card>
</x-guest-layout>
