<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('All Users') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>All users</h2></div>
                    <div class="panel-body">
                            @if(count($users) > 0 )
                                @foreach($users as $user)
                                <div class="card header">
                                    <a class="p" href="{{route('users.show',$user->id)}}">
                                        <div class="card-header">
                                            <p>{{$user->email}}</p>
                                        </div>
                                    </a>
                                    <div class="card-body">
                                        <form method="POST" action="{{ route('users.destroy', $user->id)}}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                    <br>
                                </div>
                                <br>
                                @endforeach
                            @else
                                <div class="card-body">
                                    <h3>No users registered yet!</h3>
                                </div>
                            @endif
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
