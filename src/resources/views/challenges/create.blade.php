@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold">{{ __('Add a new challenge') }}</div>
            <div class="card-body">
                <div class="form-group row ">
                    <form method="post" action="{{ route('challenges.store') }}" id="challengeform">
                        @csrf
                        <div class="form-group row" >
                            <label for="name" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Challenge name:') }}
                            </label>
                            <div class="col-mg-4">
                                <input id="challenge_name" type="text" class="form-control" name="name" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Challenge description:') }}
                            </label>
                            <div class="col-mg-4">
                                <textarea id="description "form="challengeform" name="description" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="flag" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Flag:') }}
                            </label>
                            <div class="col-mg-4">
                                <input id="flag" type="text" class="form-control" name="flag" required autofocus>
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label for="difficulty" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Difficulty:') }}
                            </label>
                            <div class="col-mg-4">
                                <select id="difficulty "name="difficulty" class="form-control">
                                    <option value="easy" selected="selected">Easy</option>
                                    <option value="medium">Medium</option>
                                    <option value="hard">Hard</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Category:') }}
                            </label>
                            <div class="col-mg-4">
                                <select id="category "name="category" class="form-control">
                                    <option value="miscellaneous" selected="selected">miscellaneous</option>
                                    <option value="web">web</option>
                                    <option value="forensic">forensic</option>
                                    <option value="reverse-engineering">reverse-engineering</option>
                                    <option value="cryptography">cryptography</option>
                                    <option value="pwn">pwn</option>
                                </select>
                            </div>
                        </div>
                        --}}
                        <div class="form-group row">
                            <label for="author" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Author:') }}
                            </label>
                            <div class="col-mg-4">
                                @if(Auth::user()->hasRole("admin"))<input id="author" type="text" name="author" class="form-control" value="{{ Auth::user()->name }}">
                                @else
                                    <input id="author" type="text" name="author" disabled class="form-control" value="{{ Auth::user()->name }}">
                                @endif
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Status:') }}
                            </label>
                            <div class="col-mg-4">
                                <select id="status" name="active" class="form-control">
                                    <option value="1" selected="selected">Enabled</option>
                                    <option value="0">Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="targetSolution" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Feasible Solution (optional:)') }}
                            </label>
                            <div class="col-mg-4">
                                <textarea id="targetSolution "form="challengeform" name="targetSolution" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hint" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Hint:') }}
                            </label>
                            <div class="col-mg-4">
                                <textarea id="hint "form="challengeform" name="hint" class="form-control"></textarea>
                            </div>
                        </div>
                        --}}
                        {{--
                        <div class="form-group row">
                            <label for="imageID" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Docker Image ID (optional):') }}
                            </label>
                            <div class="col-md-6">
                                <input id="imageID" type="text" class="form-control" name="imageID" autofocus>
                            </div>
                        </div>
                        --}}
                        <p>
                            <strong>Files (optional):</strong>
                            Please upload the files after creating the challenge.
                        </p>
                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">Submit</button>
                                <a href="{{ route('challenges.index') }} " class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <br>
    </div>
@endsection
