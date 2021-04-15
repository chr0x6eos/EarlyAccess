@extends('layouts.app')
@section('content')
<div class="container" >
    <div class="card">
        {{--@if(Auth::user()->solvedChallenge($challenge->id))
            <div class="card-header challenges-header bg-success">
                <p style="display: inline">{{$challenge->name}}</p>
                <p class="total_solves">Solved</p>
            </div>
        @else
            <div class="card-header font-weight-bold ">{{$challenge->name}}</div>
        @endif
        --}}
        <div class="card-header font-weight-bold ">{{$challenge->name}}</div>
        <div class="card-body">
            <div class="table">
                <table id="tablePreview" class="table table-borderless">
                    <tbody>
                    <tr>
                        <td class="table_01">Challenge Description:</td>
                        <td class="table_02">{{ $challenge->description}}</td>
                    </tr>
                    {{--
                    <tr>
                        <td class="table_01">Difficulty:</td>
                        <td class="table_02">{{ $challenge->difficulty}}</td>
                    </tr>
                    <tr>
                        <td class="table_01">Category:</td>
                        <td class="table_02">{{ $challenge->category}}</td>
                    </tr>
                    --}}
                    <tr>
                        <td class="table_01">Author:</td>
                        <td class="table_02">{{\Illuminate\Support\Facades\Auth::user()->findOrFail($challenge->author)->name }}</td>
                    </tr>
                    @if($challenge->images)
                        @if($challenge->container(\Illuminate\Support\Facades\Auth::user()->id))
                            @php($port = $challenge->container(\Illuminate\Support\Facades\Auth::user()->id)->port)
                                <tr>
                                    @php($server = env("APP_URL"))
                                    <td class="table_01">Container running on port:</td>
                                    <td class="table_02"><a class="btn btn-outline-success" href="{{$server}}:{{$port}}" target="_blank">{{$server}}:{{$port}}</a></td>
                                    <td></td>
                                </tr>
                            <tr>
                                <td><a class="btn btn-outline-danger" href="{{ route('containers.stop', $challenge->id) }}">Stop Container</a></td>
                            </tr>
                        @else
                            <tr>
                                <td>
                                    <a class="btn btn-outline-info" href="{{ route('containers.start', $challenge->id) }}">Start Container</a>
                                </td>
                            </tr>
                        @endif
                    @endif
                    {{--
                    <tr>
                        <td class="table_01">Status</td>
                        @if($challenge->active)
                            <td class="table_02">Enabled</td>
                        @endif
                        @if(!$challenge->active)
                            <td class="table_02">Disabled</td>
                        @endif
                    </tr>
                    @if($challenge->hint)
                        <tr>
                            <td class="table_01">Hint</td>
                            <td class="table_02">{{ $challenge->hint}}</td>
                        </tr>
                    @endif
                    @if($challenge->imageID)
                        <tr>
                            <td class="table_01">Docker Image ID:</td>
                            <td class="table_02">{{ $challenge->imageID}}</td>
                        </tr>
                    @endif
                    --}}
                    @if($challenge->files)
                        <tr>
                            <td class="table_01">Resource:</td>
                            <td class="table_02"><a href="{{route('challenges.download', $challenge->id)}}" class="btn btn-outline-light-green">Download</a></td>
                        </tr>
                    @endif
                    </tbody>
                    <!--Table body-->
                </table>
                @if(Auth::user()->hasRole("admin") || Auth::user()->isAuthor($challenge->author))
                    <a class="btn" href="{{ route('challenges.edit', $challenge->id) }}">Edit</a>
                    <a class="btn btn-outline-dark" href="{{ route('challenges.files', $challenge->id) }}">Upload Files</a>
                    <a class="btn btn-dark btn-outline-light" href="{{ route('challenges.images', $challenge->id) }}">Upload Docker-Images</a>
                    @if(!$challenge->active)
                        <form method="POST" action="{{ route('challenges.destroy', $challenge->id) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    @endif
                @endif
            </div>
            <div class="form-group row">
                <form method="POST" action="{{ route('challenges.flag', $challenge->id) }}" class="text-center p-5">
                    @csrf
                    <div class="md-form form-lg md-outline">
                        <input id="flag" data-test="input" name="flag" type="text" placeholder="WTH{EXAMPLE_FLAG}" class="form-control form-control-lg" value="" required autofocus>
                        <label class="label-form" data-error="" data-success="" id="">Flag</label>
                    </div>
                    <button type="submit"class="btn btn-success btn-block my-4">Submit flag</button>
                </form>
                {{--
                <div>
                    @if(isset($gifPath) && $gifPath != "")
                        <img src="{{ $gifPath }}" style="height: 250px">
                    @endif
                </div>
                --}}
            </div>
            {{--<a href="{{ route('support.create', $challenge->id) }}" class="btn btn-outline-dark">Report a problem</a>--}}
        </div>
    </div>
</div>
@endsection

