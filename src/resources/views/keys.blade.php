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
                    <div class="panel-heading"><h2>Add Game-Key to your account</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            @if(Auth::User()->isAdmin())
                                <div class="card-header">
                                    <p class="Recipient">Verify game-key</p>
                                </div>
                                <div class="card-body">
                                    <form class="form-horizontal" role="form" method="POST" action="{{route('key.verify')}}">
                                        {{ csrf_field() }}

                                        <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                            <label for="subject" class="col-md-4 control-label">Enter game-key:</label>
                                            <div class="col-md-6">
                                                <input class="input" name="key" @if(session()->has('key'))value="{{session('key')}}"@endif placeholder="XXXX-XXXX-XXXX-XXXX" required></input>

                                                @if ($errors->has('key'))
                                                    <span class="help-block">
                                                    <strong>{{ $errors->first('key') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary">
                                            Verify key
                                        </button>
                                    </form>
                                </div>
                            @else
                                @if(Auth::User()->key == "")
                                    <div class="card-header">
                                        <p class="Recipient">Register game-key to your account</p>
                                    </div>
                                    <div class="card-body">
                                        <p>You can register you early access key here. If you have not received an access key yet, you can message the administrator to be put on the wait-list.</p>
                                        <form class="form-horizontal" role="form" method="POST" action="{{route('key.create')}}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="subject" class="col-md-4 control-label">Enter game-key:</label>
                                                <div class="col-md-6">
                                                    <input class="input" name="key" @if(session()->has('key'))value="{{session('key')}}"@endif placeholder="XXXX-XXXX-XXXX-XXXX" required></input>

                                                    @if ($errors->has('key'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('key') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">
                                                Add key
                                            </button>

                                        </form>
                                    </div>
                                @else
                                    <div class="card-header">
                                        <p class="Recipient">Update the game-key registered to your account</p>
                                    </div>
                                    <div class="card-body">
                                        <form class="form-horizontal" role="form" method="POST" action="{{route('key.create')}}">
                                            {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('key') ? ' has-error' : '' }}">
                                                <label for="subject" class="col-md-4 control-label">Enter your new game-key:</label>
                                                <div class="col-md-6">
                                                    <input class="input" name="key" placeholder="{{Auth::User()->key}}" required></input>

                                                    @if ($errors->has('key'))
                                                        <span class="help-block">
                                                        <strong>{{ $errors->first('key') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-primary">
                                                Add key
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
