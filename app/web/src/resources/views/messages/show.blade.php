<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Message') }}
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>{{$message->subject}}</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            <div class="card-header">
                                {{-- Echo username to allow XSS --}}
                                Message from: @php echo $message->sender->name; @endphp
                            </div>
                            <div class="card-body">
                                <p>{{$message->body}}</p>
                            </div>
                            <form method="POST" action="{{ route('messages.destroy', $message->id)}}" class="btn mb-1">
                                <a class="btn btn-outline-success" id="reply" href="{{route('contact.reply', $message->id)}}">Reply</a>
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                                @if(Auth::user()->isRecipient($message->id))
                                    <a class="btn btn-outline-dark" href="{{route('messages.index')}}">Go back</a>
                                @else
                                    <a class="btn btn-outline-dark" href="{{route('messages.sent')}}">Go back</a>
                                @endif
                            </form>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
