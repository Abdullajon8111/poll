<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="mb-3">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">
            <a href="{{ route('eds.login.redirect') }}" class="btn btn-info btn-block">
                <i class="la la-key"></i>
                {{ __('Login with EDS') }}
            </a>
        </div>
    </x-auth-card>
</x-guest-layout>
