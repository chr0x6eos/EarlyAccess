@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header font-weight-bold">{{$challenge->name}}</div>
            <div class="card-body">
                @if($challenge)
                    @if($challenge->files != "")
                        <div class="content">
                            <h1>Attention!</h1>
                            <p>Please note this challenge already has a file uploaded!</p>
                            <p>If you upload a new file the old one will be replaced!</p>
                        </div>
                    @endif
                    <div class="content">
                        <h1>Upload files here</h1>
                        <p>Please note that only .zip files are allowed!<br>
                            Furthermore, the maximum file size is 100MB.<br>
                            Uploading may take some time! Please wait once you pressed the upload button.</p>
                        <br>
                        <h4>Files for {{$challenge->name}}</h4>
                        <form action="{{ route('challenges.upload_file', $challenge->id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="file" class="custom-file-input" id="inputGroupFile04">
                                    <label class="custom-file-label" for="inputGroupFile04">Choose file</label>
                                </div>
                                <br>
                                <div class="input-group-append">
                                    <br>
                                    <button class="btn btn-outline-green" type="submit">Upload</button>
                                </div>
                            </div>
                            <br>
                            <div >
                                <a href="{{ route('challenges.edit', $challenge->id) }}" class="btn btn-outline-black">Go back</a>
                            </div>
                        </form>
                    </div>

                    {{--
                    <script>
                        var CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
                        Dropzone.autoDiscover = false;
                        var myDropzone = new Dropzone(".dropzone",{
                            maxFilesize: 100,
                            acceptedFiles: ".zip,.rar",
                        });
                        myDropzone.on("sending", function(file, xhr, formData) {
                            formData.append("_token", CSRF_TOKEN);
                        });
                    </script>
                    --}}
                @else
                    <h1>Error occurred!</h1>
                @endif
            </div>
        </div>
    </div>
@endsection
