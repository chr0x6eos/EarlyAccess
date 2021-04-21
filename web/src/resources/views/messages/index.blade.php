<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Inbox') }}
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
                        <p>Please note that we currently delete read messages after some time, as a result of our limited storage.<br>We will upgrade our storage soon!</p>
                            @if(count(Auth::user()->received) > 0 )
                                @foreach(Auth::user()->received as $message)
                                    <div class="card header">
                                        <a name="inbox-header" href="{{route('messages.show', $message->id)}}">
                                            <div class="card-header {{-- @if($message->read)bg-success @endif--}}">
                                                <p>{{$message->subject}} @if($message->read) (Read) @endif</p>
                                            </div>
                                        </a>
                                        <div class="card-body" {{-- @if($message->read)style="background-color: white" @endif--}}>
                                            {{--
                                             <!--
                                                TODO: Research why some usernames cause strange behavior.
                                                Fix: Blacklist characters upon registration that can cause errors & show user-id instead of name
                                            -->
                                            {{-- Echo user-id to not distrupt all messages after this one --\}}
                                            <p>Message by (ID: @php echo $message->sender->id; @endphp)</p>
                                            --}}
                                            <p>Received at: {{$message->updated_at->toDateTimeString()}}</p>
                                        </div>
                                        <br>
                                    </div>
                                @endforeach
                            @else
                                <div class="card header">
                                    <div class="card-body">
                                        <h3>You currently have not received any messages yet!</h3>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
