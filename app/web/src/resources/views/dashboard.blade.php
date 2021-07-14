<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading" style="text-align: center;"><h2>Welcome to Mamba!</h2></div>
                    <div class="panel-body">
                        <div class="main-body">
                        <img style="display: block;margin-left: auto;margin-right: auto;width: 50%;" src="@php echo asset('storage/logo.png') @endphp">
                            <div class="inner-wrapper">
                                <div class="inner-main-body p-2 p-sm-3">
                                    <div class="card mb-2" style="text-align: center;">
                                        <p>
                                            If you already received your Game-Key go ahead and register the key to your account to access the game.<br>
                                            If you haven't registered for alpha-testing yet, please feel free to message the administrative staff to be put on the waiting list.
                                        </p>
                                        <p>
                                        Please note that this site is still under development. If you encounter any bugs please report them to admin@earlyaccess.htb.
                                    </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>
