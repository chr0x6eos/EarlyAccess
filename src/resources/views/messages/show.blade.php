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
                    <div class="panel-heading"><h2>{{$message->subject}}</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            <div class="card-header">
                                {{-- Echo username to allow XSS --}}
                                <p>Message from: @php echo $message->sender->name; @endphp</p>
                            </div>
                            <div class="card-body">
                                <p>{{$message->body}}</p>
                            </div>
                            <a class="btn btn-outline-success" href="{{route('contact.reply', $message->id)}}">Reply</a>
                            <form method="POST" action="{{ route('messages.destroy', $message->id)}}" class="btn btn-outline-danger">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                            <a class="btn btn-outline-dark" href="{{route('messages.index')}}">Go back</a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
