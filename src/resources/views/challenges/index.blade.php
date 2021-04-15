@extends('layouts.app')
@section('content')
    <div id="landing" class="py-5">
        <div data-test="container" class="container">
            <div data-test="row" class="row">
                <div data-test="col" class="col-md-12 mb7">
                    <div class="card card_showChallenge">
                        <div data-test="card" class="card-body">
                            <p class="h2" style="display: inline">All available Challenges</p>
                            @foreach($challenges as $challenge)
                                <div class="card challenges-header">
                                    <a class="text" href="{{route('challenges.show', $challenge->id)}}">
                                        <div class="card-header">
                                            <p class="challenge_name">{{$challenge->name}}</p>
                                            {{--<p class="total_solves">Total solves: {{$challenge->solves($challenge->id)}}</p>--}}
                                        </div>
                                        <div class="card-body">
                                            {{--<p>Status: @if($challenge->active)Active @else Disabled @endif</p>--}}
                                            <p>Author: {{\Illuminate\Support\Facades\Auth::user()->findOrFail($challenge->author)->name}}</p>
                                            <p>{{$challenge->description}}</p>
                                        </div>
                                    </a>
                                </div>
                                <br>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
