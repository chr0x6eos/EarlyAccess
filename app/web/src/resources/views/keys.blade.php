<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Bind Game-Key to your account') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>@if(Auth::User()->isAdmin()) Verify Game-Key @else Add Game-Key to your account @endif</h2></div>
                    <div class="panel-body">
                        @if(Auth::User()->isAdmin())
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
                                    <p>Verify a user's game-key using the API</p>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{route('key.verify')}}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                            <label for="subject" class="col-md-5 control-label">Enter game-key:</label>
                                            <div class="col-md-auto">
                                                <input class="input w-75" name="key" @if(session()->has('key'))value="{{session('key')}}"@endif placeholder="AAAAA-BBBBB-CCCC1-DDDDD-1234" required autofocus>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            Verify key
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <div class="card header">
                                @if(Auth::User()->key == "")
                                    <div class="card-header">
                                        <p>Register game-key to your account</p>
                                    </div>
                                    <div class="card-body">
                                        <p>You can register you early access key here. If you have not received an access key yet, you can message the administrator to be put on the wait-list.</p>
                                        <form class="form-horizontal" role="form" method="POST" action="{{route('key.create')}}">
                                            {{ csrf_field() }}
                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="subject" class="col-md-5 control-label">Enter game-key:</label>
                                                <div class="col-md-auto">
                                                    <input class="input w-75" name="key" @if(session()->has('key'))value="{{session('key')}}"@endif placeholder="AAAAA-BBBBB-CCCC1-DDDDD-1234" required autofocus>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">
                                                Add key
                                            </button>

                                        </form>
                                    </div>
                                @else
                                    <div class="card-header">
                                        <p>Update the game-key registered to your account</p>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" role="form" method="POST" action="{{route('key.create')}}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="subject" class="col-md-5 control-label">Enter your new game-key:</label>
                                                <div class="col-md-auto">
                                                    <input class="input w-75" name="key" placeholder="{{Auth::User()->key}}" required autofocus>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">
                                                Add key
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
