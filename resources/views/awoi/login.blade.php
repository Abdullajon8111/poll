<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="mb-3">
                <x-application-logo width="82" />
            </a>
        </x-slot>

        <div class="card-body">
            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-3" :errors="$errors" />

            <form method="post" action="{{ route('awoi.login') }}">
                @csrf

                <div class="form-group">
                    <x-label for="stir" :value="__('STIR')" />
                    <x-input id="stir" type="text" name="stir" :value="old('stir')" required autofocus />
                </div>

                <div class="form-group">
                    <x-label class="m-0" for="ktut" :value="__('KTUT')" />
                    <p class="p-0 m-0">
                        <a href="http://web.stat.uz/search/ktut/uz/users.php" target="_blank">{{ __('How to determine?') }}</a>
                    </p>
                    <x-input id="ktut" type="text" name="ktut" :value="old('ktut')" required />
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-end align-items-baseline">

                        <x-button class="btn-block">
                            {{ __('Login') }}
                        </x-button>
                    </div>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
