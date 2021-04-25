<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Patch Notes') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading"><h2>Latest Patches</h2></div>
                    <div class="panel-body">
                        <div class="card header">
                            <div class="card-header">
                                <h3>Game-Version v0.1.2.733</h3>
                            </div>
                            <div class="card-body">
                                    <h5>Changes:</h5>
                                    <ul>
                                        <li></li>
                                        <li>B</li>
                                    </ul>
                            </div>
                        </div>
                        <div class="card-header">
                            <h3>Game-Version v0.1.2.732</h3>
                        </div>
                        <div class="card-body">
                            <h5>Changes:</h5>
                            <ul>
                                <li>Registration of usernames limited to alphanumeric characters</li>
                                <li></li>
                                <li>B</li>
                            </ul>
                        </div>
                        {{-- @for($i = 733; $i>728; $i--)
                            <div class="card header">
                                <div class="card-header">
                                    <h3>Game-Version v0.1.2.{{$i}}</h3>
                                </div>
                                <div class="card-body">
                                    @if($i % 3 == 0)
                                        <h5>New Features:</h5>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut condimentum ultricies sapien, vitae maximus libero pellentesque et. Nunc tempus nisi vitae tortor congue elementum. Mauris rutrum ut justo nec faucibus. Nullam pharetra neque non justo sagittis ullamcorper.</p>
                                    @else
                                        <h5>Bugfixes:</h5>
                                        <ul>
                                            <li>Vestibulum ut iaculis ligula.</li>
                                            <li>Pellentesque euismod in eros eu.</li>
                                            <li>Suspendisse placerat elementum.</li>
                                        </ul>
                                    @endif
                                </div>
                            </div>
                        @endfor
                        --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
