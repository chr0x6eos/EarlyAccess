<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Your messages') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Message inbox</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            @if(count(Auth::user()->received) > 0 )
                                @foreach(Auth::user()->received as $message)
                                <a name="inbox-header" href="{{route('messages.show', $message->id)}}">
                                        <div class="card-header">
                                            <!-- TODO: Research why some usernames cause strange behavior.
                                                 Fix: Blacklist characters upon registration that can cause errors & show user-id instead of name
                                            -->
                                            <p>@php echo $message->sender->id; @endphp</p>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <p>{{$message->subject}}</p>
                                    </div>
                                    <br>
                                @endforeach
                            @else
                                <div class="card-body">
                                    <h3>You currently have not received any messages!</h3>
                                </div>
                            @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(Auth::user()->name != "admin")
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <br>
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Your sent messages</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            @if(count(Auth::user()->sent) > 0 )
                                @foreach(Auth::user()->sent as $message)
                                    <a class="p" href="{{route('messages.show',$message->id)}}">
                                        <div class="card-header">
                                            <p>Message to: {{$message->recipient->name}}</p>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <p>{{$message->subject}}</p>
                                    </div>
                                    <br>
                                @endforeach
                            @else
                            <div class="card-body">
                                    <h3>You have not send any messages yet!</h3>
                                    <a class="btn btn-outline-success" href="{{route('contact.index')}}">Send message</a>
                                </div>
                            @endif
                            <br>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    </div>
</x-app-layout>
