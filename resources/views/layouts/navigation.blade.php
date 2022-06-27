<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="/">
            <img src="{{ asset('img/gerb.png') }}" alt="logo" width="46">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <x-nav-link class="nav-link" href="{{ route('dashboard') }}" :active="request()->segment(1) == 'dashboard'">
                    {{ __('Dashboard') }}
                </x-nav-link>

                <x-nav-link class="nav-link" href="{{ route('entry.index') }}" :active="request()->segment(1) == 'entry'">
                    {{ __('Entry') }}
                </x-nav-link>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Settings Dropdown -->
                @auth('org')
                    <x-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            {{ Auth::guard('org')->user()->name }}
                        </x-slot>

                        <x-slot name="content">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @endauth
            </ul>
        </div>
    </div>
</nav>
