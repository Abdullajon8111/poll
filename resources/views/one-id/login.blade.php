<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <div class="mb-3 text-center">
                <x-application-logo width="82" />
                <h3 class="text-center mt-3">
                    O‘ZBEKISTON RESPUBLIKASI <br>
                    OLIY TA’LIM, FAN VA INNOVATSIYALAR <br>
                    VAZIRLIGINING SO‘ROVNOMA TIZIMI
                </h3>
            </div>
        </x-slot>

        <div class="card-body">
            <a href="{{ route('one-id.login.redirect') }}" class="btn btn-info btn-block">
                <i class="la la-key"></i>
                {{ __('Login') }}
            </a>
        </div>
    </x-auth-card>
</x-guest-layout>
