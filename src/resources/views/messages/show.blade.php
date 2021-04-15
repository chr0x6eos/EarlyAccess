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
                    <div class="panel-heading"><h2>Message</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            <a class="p" href="{{route('messages.show',$message->id)}}">
                                <div class="card-header">
                                    <p>Message from: @php echo $message->sender->name; @endphp</p>
                                </div>
                            </a>
                            <div class="card-body">
                                <p>{{$message->body}}</p>
                                <p><a class="btn btn-outline-success" href="{{route('contact.name', $message->sender)}}">Reply</a></p>
                                <form method="POST" action="{{ route('messages.destroy', $message->id)}}">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

