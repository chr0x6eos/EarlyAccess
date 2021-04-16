<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Contact') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Contact @if(session()->has('name')){{session('name')}} @else admin @endif</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            <div class="card-header">
                                <p class="Recipient">Send message to: @if(session()->has('name')){{session('name')}} @else admin @endif</p>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{route('contact.create')}}">
                                    {{ csrf_field() }}

                                    {{-- Allow users to change recipient to test messaging --}}
                                    <input type="hidden" id="name" name="name" @if(session()->has('name'))value="{{session('name')}}" @else value="admin" @endif>

                                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                        <label for="subject" class="col-md-4 control-label">Subject:</label>
                                        <div class="col-md-6">
                                        <input id="subject" class="input" name="subject" @if(session()->has('subject'))value="{{session('subject')}}"@endif placeholder="Some subject" required></input>

                                        @if ($errors->has('subject'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                        <label for="message" class="col-md-4 control-label">Type in your message:</label>
                                        <div class="col-md-6">
                                        <textarea id="message" class="form-control" name="message" placeholder="Some message" required></textarea>

                                        @if ($errors->has('message'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        Send
                                    </button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
