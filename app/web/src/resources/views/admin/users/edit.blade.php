<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>User: {{$user->name}} (ID: {{$user->id}})</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            <div class="card-header">
                                User Details
                            </div>
                            <form method="POST" action="{{ route('users.update', $user->id)}}">
                                @csrf
                                @method('patch')
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-md-right" >
                                            {{ __('User name:') }}
                                        </label>
                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control" name="name" required autofocus value="{{ $user->name }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-md-right" >
                                            {{ __('Email:') }}
                                        </label>
                                        <div class="col-md-6">
                                            <input id="email" type="text" class="form-control" name="email" required autofocus value="{{ $user->email }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="role" class="col-sm-4 col-form-label text-md-right">
                                            {{ __('Role:') }}
                                        </label>
                                        <div class="col-md-6">
                                            <select id="role" name="role" class="form-control">
                                                <option value="user" @if($user->role=="user") selected="selected" @endif>User</option>
                                                <option value="admin" @if($user->role=="admin") selected="selected" @endif>Admin</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-md-right" >
                                            {{ __('Game-Key:') }}
                                        </label>
                                        <div class="col-md-6">
                                            <input id="key" type="text" class="form-control" name="key" autofocus value="{{ $user->key }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-md-right" >
                                            {{ __('Created at:') }}
                                        </label>
                                        <div class="col-md-6">
                                            <input class="form-control" value="{{ $user->created_at->toDateTimeString() }}" readonly>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-4 col-form-label text-md-right" >
                                            {{ __('Last time updated at:') }}
                                        </label>
                                        <div class="col-md-6">
                                            <input class="form-control" value="{{ $user->updated_at->toDateTimeString() }}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <button id="submit" class="btn btn-outline-success w-100">Save</button>
                            </form>
                            <a class="btn btn-outline-dark" href="{{route('users.index')}}">Go back</a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
