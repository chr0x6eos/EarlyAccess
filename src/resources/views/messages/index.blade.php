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
                        @if(Auth::user()->name == "admin")
                            @if(count(Auth::user()->received) > 0 )
                                @foreach(Auth::user()->received as $message)
                                    <div class="card header">
                                        <a class="p" href="{{route('messages.show',$message->id)}}">
                                            <div class="card-header">
                                                <p>Message from: {{$message->sender->name}}</p>
                                            </div>
                                        </a>
                                        <div class="card-body">
                                            <p>{{$message->body}}</p>
                                        </div>
                                        <br>
                                @endforeach
                            @endif
                        @else
                            @if(count(Auth::user()->received) > 0 )
                                @foreach(Auth::user()->received as $message)
                                    <div class="card header">
                                        <div class="card-header">
                                            <a class="p" href="{{route('messages.show',$message->id)}}">
                                                {{-- Make username vulnerable to XSS by using echo --}}
                                                <p>Message from: @php echo $message->sender->name; @endphp</p>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <p>{{$message->body}}</p>
                                        </div>
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
                        @endif
                        <br>
                        <div class="panel-heading"><h2>Your sent messages</h2></div>
                        <div class="panel-body">
                            @if(count(Auth::user()->sent) > 0)
                                @foreach(Auth::user()->sent as $message)
                                    <div class="card header">
                                        <div class="card-header">
                                            <p>Message to: {{$message->recipient->name}}</p>
                                        </div>
                                        <div class="card-body">
                                            {{-- Enable XSS using echo --}}
                                            <p>{{$message->body}}</p>
                                        </div>
                                        <form method="POST" action="{{ route('messages.destroy',$message->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                    <br>
                                @endforeach
                            @else
                                <div class="card-body">
                                    <h3>You have not sent any messages yet!</h3>
                                    <a href="{{route("contact.index")}}" class="btn btn-outline-success">Send a message</a>
                                </div>
                            @endif
                        </div>
            </div>
        </div>
    </div>
</x-app-layout>
