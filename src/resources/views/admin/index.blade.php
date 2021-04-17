<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Your messages') }}
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
                                <li class="nav-item">
                                    <a href="{{ route('users.index') }}" class="nav-link @if(request()->routeIs('users.index')) font-weight-bold @endif">
                                        {{ __('User management') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.download') }}" class="nav-link @if(request()->routeIs('admin.download')) font-weight-bold @endif">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
