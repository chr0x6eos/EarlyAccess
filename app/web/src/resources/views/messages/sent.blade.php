<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Outbox') }}
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
                                        Inbox @if(count(Auth::user()->received) > 0) ({{count(Auth::user()->received)}}) @endif
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
                        <p>Please note that it may take a couple of minutes for the message to be read by the admin!<br>Read messages will be marked.</p>
                            @if(count(Auth::user()->sent) > 0 )
                                @foreach(Auth::user()->sent as $message)
                                    <div class="card header">
                                        <a href="{{route('messages.show',$message->id)}}">
                                            <div class="card-header">
                                                Message to: {{$message->recipient->name}} @if($message->read) (Read) @endif
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <p>{{$message->subject}}</p>
                                            <p>Sent at: {{$message->created_at->toDateTimeString()}}</p>
                                        </div>
                                        <br>
                                    </div>
                                @endforeach
                            @else
                                <div class="card-body">
                                    <h3>You have not send any messages yet!</h3>
                                    {{--<a class="btn btn-outline-success" href="{{route('contact.index')}}">Send message</a>--}}
                                </div>
                            @endif
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
