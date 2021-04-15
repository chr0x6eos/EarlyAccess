@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold">{{$challenge->name}}</div>
            <div class="card-body">
                <div class="form-group row">
                    <form method="post" action="{{ route('challenges.update', $challenge)}}" id="challengeform">
                        @csrf
                        @method("patch")
                        <div class="form-group row">
                            <label for="name" class="col-sm-4 col-form-label text-md-right" >
                                {{ __('Challenge name:') }}
                            </label>
                            <div class="col-md-6">
                                <input id="challenge_name" type="text" class="form-control" name="name" required autofocus value="{{ $challenge->name }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Challenge description:') }}
                            </label>
                            <div class="col-md-6">
                                <textarea id="description "form="challengeform" name="description" class="form-control">{{ $challenge->description }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="flag" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Flag:') }}
                            </label>
                            <div class="col-md-6">
                                <input id="flag" type="text" class="form-control" name="flag" required autofocus value="{{ $challenge->flag }}">
                            </div>
                        </div>
                        {{--<div class="form-group row">
                            <label for="difficulty" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Difficulty:') }}
                            </label>
                            <div class="col-md-6">
                                <select id="difficulty "name="difficulty" class="form-control">
                                    <option value="tatu" @if($challenge->difficulty=="tatu") selected="selected" @endif>TaTü</option>
                                    <option value="easy" @if($challenge->difficulty=="easy") selected="selected" @endif>Easy</option>
                                    <option value="medium" @if($challenge->difficulty=="medium") selected="selected" @endif>Medium</option>
                                    <option value="hard" @if($challenge->difficulty=="hard") selected="selected" @endif>Hard</option>
                                    <option value="insane" @if($challenge->difficulty=="insane") selected="selected" @endif>Insane</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="category" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Category:') }}
                            </label>
                            <div class="col-md-6">
                                <select id="category "name="category" class="form-control">
                                    <option value="miscellaneous" @if($challenge->category=="miscellaneous")selected="selected"@endif>miscellaneous</option>
                                    <option value="web" @if($challenge->category=="web")selected="selected"@endif>web</option>
                                    <option value="forensic" @if($challenge->category=="forensic")selected="selected"@endif>forensic</option>
                                    <option value="reverse-engineering" @if($challenge->category=="reverse-engineering")selected="selected"@endif>reverse-engineering</option>
                                    <option value="cryptography" @if($challenge->category=="cryptography")selected="selected"@endif>cryptography</option>
                                    <option value="pwn" @if($challenge->category=="pwn")selected="selected"@endif>pwn</option>
                                </select>
                            </div>
                        </div>
                        --}}
                        <div class="form-group row">
                            <label for="author" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Author:') }}
                            </label>
                            <div class="col-md-6">
                                @if(Auth::user()->hasRole("admin"))<input id="author" type="text" name="author" class="form-control" value="{{ Auth::user()->username }}">
                                @else
                                    <input id="author" type="text" name="author" disabled class="form-control" value="{{ $challenge->author }}">
                                @endif
                            </div>
                        </div>
                        {{--
                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Status:') }}
                            </label>
                            <div class="col-md-6">
                                <select id="status" name="active" class="form-control">
                                    <option value="1" @if($challenge->active) selected="selected"@endif>Enabled</option>
                                    <option value="0" @if(!$challenge->active) selected="selected"@endif>Disabled</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="targetSolution" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Feasible Solution (optional:)') }}
                            </label>
                            <div class="col-md-6">
                                <textarea id="targetSolution "form="challengeform" name="targetSolution" class="form-control">{{ $challenge->targetSolution }}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="hint" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Hint:') }}
                            </label>
                            <div class="col-md-6">
                                <textarea id="hint "form="challengeform" name="hint" class="form-control">{{ $challenge->hint }}</textarea>
                            </div>
                        </div>
                        --}}
                        {{--
                        <div class="form-group row">
                            <label for="imageID" class="col-sm-4 col-form-label text-md-right">
                                {{ __('Docker Image ID (optional):') }}
                            </label>
                            <div class="col-md-6">
                                <input id="imageID" type="text" class="form-control" name="imageID" required autofocus value="{{ $challenge->imageID }}">
                            </div>
                        </div>
                        --}}

                        <div class="form-group row">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-info">Submit</button>
                                <a href="{{ route('challenges.show', $challenge->id) }} " class="btn btn-outline-danger">Cancel</a>
                            </div>
                        </div>
                    </form>
                    <div class="form-group">
                        @if(Auth::user()->hasRole("admin") || Auth::user()->isAuthor($challenge->author))
                            @if(!$challenge->active)
                                <form method="POST" action="{{ route('challenges.destroy',$challenge->id) }}">
                                    @csrf
                                    @method('delete')
                                    <div class="col-md-4">
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </div>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
@endsection
