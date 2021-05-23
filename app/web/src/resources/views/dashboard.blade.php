<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="panel panel-default align-content-center">
                <div class="panel-body">
                    <img src="@php echo asset('storage/logo.png') @endphp">
                    <h2>Welcome to Mamba!</h2>
                    <p>Mamba is the newest upcoming release of the award winning indie-developer team EarlyAccess Studios.<br>
                    If you already received your Game-Key go ahead and register the key to your account to access the game.<br>
                    If you haven't registered for alpha-testing yet, please feel free to message the administrative staff to be put on the waiting list.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
