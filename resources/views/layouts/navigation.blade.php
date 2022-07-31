<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
{{--        <!-- Logo -->--}}
{{--        <a class="navbar-brand" href="/">--}}
{{--            <img src="{{ asset('img/gerb.png') }}" alt="logo" width="46">--}}
{{--        </a>--}}
{{--        --}}
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <x-nav-link class="nav-link" href="{{ route('dashboard') }}" :active="request()->segment(1) == 'dashboard'">
                    <i class="fa fa-home"></i>
                    {{ __('Home page') }}
                </x-nav-link>

                <x-nav-link class="nav-link" href="{{ route('entry.index') }}" :active="request()->segment(1) == 'entry'">
                    <i class="fa fa-list"></i>
                    {{ __('Participations') }}
                </x-nav-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Settings Dropdown -->
                @auth('org')

                    <form id="log-out-form" method="POST" action="{{ route('logout') }}">
                        @csrf
                    </form>

                    <span class="btn">{{ Auth::guard('org')->user()->name }}</span>

                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-globe"></i>
                            {{ config('backpack.crud.locales')[app()->getLocale()] }}
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach(config('backpack.crud.locales') as $id => $lang)
                                <a href="{{ route('change-lang', ['langcode' => $id]) }}" class="dropdown-item">{{ $lang }}</a>
                            @endforeach
                        </div>
                    </div>

                    <button class="btn btn-link" onclick="event.preventDefault(); $('#log-out-form').submit();">
                        <i class="fa fa-sign-out"></i>
                        {{ __('Log Out') }}
                    </button>
                @endauth
            </ul>
        </div>
    </div>
</nav>
