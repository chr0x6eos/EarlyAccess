<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Under construction') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Admin panel</h2></div>
                    <div class="panel-body">
                        <div class="card header mb-2">
                            <ul class="nav">
                                <li>
                                    <a href="{{ route('admin.index') }}" class="nav-link @if(request()->routeIs('admin.index')) font-weight-bold @endif">
                                        {{ __('Admin panel') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link @if(request()->routeIs('users.index')) font-weight-bold @endif">
                                        {{ __('User management') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.backup') }}" class="nav-link @if(request()->routeIs('admin.backup')) font-weight-bold @endif">
                                        {{ __('Download backup') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('key.index') }}" class="nav-link @if(request()->routeIs('key.index')) font-weight-bold @endif">
                                        {{ __('Verify a game-key') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card header">
                            <div class="card-header">
                                <h2>This page is still under construction! <i class="fas fa-hammer"></i></h2>
                            </div>
                            <div class="card-body">
                                <h3>Please check back again another time!</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
