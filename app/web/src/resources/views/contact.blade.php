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
                    <div class="panel-heading"><h2>Messaging</h2></div>
                    <div class="panel-body">
                        <div class="card header mb-2">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a href="{{ route('messages.index') }}" class="nav-link @if(request()->routeIs('messages.index')) font-weight-bold @endif">
                                        {{ __('Inbox') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('messages.sent') }}" class="nav-link @if(request()->routeIs('messages.sent')) font-weight-bold @endif">
                                        {{ __('Outbox') }}
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('contact.index') }}" class="nav-link @if(request()->routeIs('contact.index')) font-weight-bold @endif">
                                        {{ __('Contact Us') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <br>
                        <h5>If you have any inquiry, please do not hesitate contacting us!</h5>
                        <div class="card header">
                            <div class="card-header">
                                <p class="Recipient">Send message to: <b>@if(session()->has('email')){{session('email')}} @else admin@earlyaccess.htb @endif</b></p>
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" role="form" method="POST" action="{{route('contact.create')}}">
                                    {{ csrf_field() }}

                                    {{-- Allow users to change recipient to test messaging --}}
                                    <input type="hidden" id="email" name="email" @if(session()->has('email'))value="{{session('email')}}" @else value="admin@earlyaccess.htb" @endif>

                                    <div class="form-group{{ $errors->has('subject') ? ' has-error' : '' }}">
                                        <label for="subject" class="col-md-4 control-label">Subject:</label>
                                        <div class="col-md-6">
                                        <input id="subject" class="input" name="subject" @if(session()->has('subject'))value="{{session('subject')}}"@endif placeholder="Issue with: XXX" required></input>

                                        @if ($errors->has('subject'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('message') ? ' has-error' : '' }}">
                                        <label for="message" class="col-md-4 control-label">Type in your message:</label>
                                        <div class="col-md-auto">
                                        <textarea id="message" class="form-control" rows="3" name="message" placeholder="I have an issue with XXX. When I did X the website crashed. Please fix that!" required></textarea>

                                        @if ($errors->has('message'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                        @endif
                                        </div>
                                    </div>
                                    <button id="contact" type="submit" class="btn btn-primary">
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
