<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div>
        @if(Auth::User()->isAdmin())
            <h1>Admin user cannot be edited!</h1>
            <a href="{{ route('dashboard') }}">Go back</a>
        @else
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-jet-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                @livewire('profile.update-password-form')

                <x-jet-section-border />
            @endif

            @livewire('profile.logout-other-browser-sessions-form')

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-jet-section-border />

                @livewire('profile.delete-user-form')
            @endif
        @endif
    </div>
</x-app-layout>
