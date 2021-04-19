<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('User') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>User: {{$user->name}}</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            <div class="card-header">
                                Details
                            </div>
                            <div class="card-body">
                                {{-- Echo username to allow XSS --}}
                                <p>ID: {{$user->id}}</p>
                                <p>Name: @php echo $user->name; @endphp</p>
                                <p>E-Mail: {{$user->email}}</p>
                                <p>Role: {{$user->role}}</p>
                                <p>Game-key: {{$user->key}}</p>
                                <p>Created at: {{$user->created_at->toDateTimeString()}}</p>
                                <p>Last time updated at: {{$user->updated_at->toDateTimeString()}}</p>
                            </div>
                            @if(!$user->isAdmin())
                                <a class="btn btn-outline-info mb-1" href="{{route('users.edit', $user->id)}}">Edit user</a>
                                <form id="form" method="POST" action="{{ route('users.destroy', $user->id)}}" class="btn btn-outline-danger submit mb-1">
                                    @csrf
                                    @method('delete')
                                    <div>Delete</div>
                                </form>
                            <script>
                                const form = document.getElementById("form");
                                document.querySelector(".submit").addEventListener("click", function(){
                                form.submit();
                                });
                            </script>
                            @endif
                            <a class="btn btn-outline-dark" href="{{route('users.index')}}">Go back</a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
