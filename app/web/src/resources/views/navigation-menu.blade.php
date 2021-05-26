<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand mr-4" href="/">
            <x-jet-application-mark width="36" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <x-jet-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                    {{ __('Home') }}
                </x-jet-nav-link>

                <x-jet-dropdown id="adminPanel">
                    <x-slot name="trigger">
                        {{ __('Messaging') }}
                    </x-slot>

                    <x-slot name="content">
                        <x-jet-dropdown-link href="{{ route('messages.index') }}">
                            {{ __('Message inbox') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('messages.sent') }}">
                            {{ __('Message outbox') }}
                        </x-jet-dropdown-link>

                        <x-jet-dropdown-link href="{{ route('contact.index') }}">
                            {{ __('Contact Us') }}
                        </x-jet-dropdown-link>
                    </x-slot>
                </x-jet-dropdown>

                @if(Auth::user()->isAdmin())
                    <x-jet-dropdown id="adminPanel">
                        <x-slot name="trigger">
                            {{ __('Admin') }}
                        </x-slot>

                        <x-slot name="content">
                            <x-jet-dropdown-link href="{{ route('admin.index') }}">
                                {{ __('Admin panel') }}
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('users.index') }}">
                                {{ __('User management') }}
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('admin.backup') }}">
                                {{ __('Download backup') }}
                            </x-jet-dropdown-link>

                            <x-jet-dropdown-link href="{{ route('key.index') }}">
                                {{ __('Verify a key') }}
                            </x-jet-dropdown-link>
                        </x-slot>
                    </x-jet-dropdown>

                    <x-jet-nav-link href="http://dev.earlyaccess.htb/" target="_blank">
                        {{ __('Dev') }}
                    </x-jet-nav-link>

                @else
                    {{--
                    <x-jet-nav-link href="{{ route('notes') }}" :active="request()->routeIs('notes')">
                        {{ __('Patch Notes') }}
                    </x-jet-nav-link>
                    --}}
                    <x-jet-nav-link href="{{ route('forum') }}" :active="request()->routeIs('forum')">
                        {{ __('Forum') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('store') }}" :active="request()->routeIs('store')">
                        {{ __('Store') }}
                    </x-jet-nav-link>

                    <x-jet-nav-link href="{{ route('key.index') }}" :active="request()->routeIs('key.index')">
                        {{ __('Register key') }}
                    </x-jet-nav-link>
                @endif
                @if(Auth::user()->isAdmin() || Auth::user()->key != "")
                    <x-jet-nav-link href="http://game.earlyaccess.htb/" target="_blank">
                        {{ __('Game') }}
                    </x-jet-nav-link>
                @endif

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto align-items-baseline">
                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <x-jet-dropdown id="teamManagementDropdown">
                        <x-slot name="trigger">
                            {{ Auth::user()->currentTeam->name }}

                            <svg class="ml-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </x-slot>

                        <x-slot name="content">
                            <!-- Team Management -->
                            <h6 class="dropdown-header">
                                {{ __('Manage Team') }}
                            </h6>

                            <!-- Team Settings -->
                            <x-jet-dropdown-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}">
                                {{ __('Team Settings') }}
                            </x-jet-dropdown-link>

                            @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                                <x-jet-dropdown-link href="{{ route('teams.create') }}">
                                    {{ __('Create New Team') }}
                                </x-jet-dropdown-link>
                            @endcan

                            <hr class="dropdown-divider">

                            <!-- Team Switcher -->
                            <h6 class="dropdown-header">
                                {{ __('Switch Teams') }}
                            </h6>

                            @foreach (Auth::user()->allTeams() as $team)
                                <x-jet-switchable-team :team="$team" />
                            @endforeach
                        </x-slot>
                    </x-jet-dropdown>
                @endif

                <!-- Settings Dropdown -->
                @auth
                    <x-jet-dropdown id="settingsDropdown">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="rounded-circle" width="32" height="32" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            @else
                                {{ Auth::user()->name }}

                                <svg class="ml-2" width="18" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 3a1 1 0 01.707.293l3 3a1 1 0 01-1.414 1.414L10 5.414 7.707 7.707a1 1 0 01-1.414-1.414l3-3A1 1 0 0110 3zm-3.707 9.293a1 1 0 011.414 0L10 14.586l2.293-2.293a1 1 0 011.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            @if(!Auth::User()->isAdmin())
                                <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                    {{ __('Profile') }}
                                </x-jet-dropdown-link>

                                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                                    <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                        {{ __('API Tokens') }}
                                    </x-jet-dropdown-link>
                                @endif

                                <hr class="dropdown-divider">
                            @endif

                            <!-- Authentication -->
                            <x-jet-dropdown-link href="{{ route('logout') }}"
                                                 onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                {{ __('Log out') }}
                            </x-jet-dropdown-link>
                            <form method="POST" id="logout-form" action="{{ route('logout') }}">
                                @csrf
                            </form>
                        </x-slot>
                    </x-jet-dropdown>
                @endauth
            </ul>
        </div>
    </div>
</nav>
