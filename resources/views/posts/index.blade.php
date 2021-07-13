@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8" id="message">
                @if($success = Session::get('success'))
                    <b><p class="alert alert-success">{{ $success }}</p></b>
                @elseif($error = Session::get('error'))
                    <b><p class="alert alert-danger ">{{ $error }}</p></b>
                @endif
                <div class="card border-dark">
                    <div class="card-header border-dark lead" id="header">
                        Posts
                        <a href="{{ route('create') }}" class="d-inline float-right btn bt-sm btn-primary"><i class="fas fa-plus"></i> Create post</a>
                    </div>
                    <div class="card-body">
                        @if($data->count() != 0)
                            @foreach ($data as $key)
                                Post by <a href="#"><b>{{ $key->user->name }}</b></a> on {{ \Carbon\Carbon::parse($key->created_at)->diffForHumans() }}
                                <h3 class="pt-3 text-uppercase">{{ $key->title }}</h3>
                                <p>{{ $key->description }}</p>
                                    @if($key->user_id == auth()->user()->id)
                                        <a href="post/edit/{{ $key->id }}" class="text-dark mr-1">Edit</a>
                                        <button class="btn btn-link text-danger remove-user" data-id="{{ $key->id }}" data-action="{{ route('delete/{id}',$key->id) }}" onclick="deleteConfirmation({{$key->id}})"> Delete</button>
                                    @endif
                                <hr>
                            @endforeach
                            <div class="row justify-content-center">{{ $data->links() }}</div>
                        @else
                            <div class="lead text-danger">There are no posts</div>
                        @endif
                        <div class="row justify-content-center">Total posts count is &nbsp;<b> {{ count($data) }} posts</b></div>

                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteConfirmation(id) {
            Swal.fire({
                icon: 'warning',
                title: 'Delete post?',
                text: 'This action is irreversible?',
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                reverseButtons: true
            }).then(function(e){
                if (e.value === true) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

                $.ajax({
                    type: 'POST',
                    url: "post/delete/" + id,
                    data: {_token: CSRF_TOKEN},
                    dataType: 'JSON',
                    success: function (results) {
                        if (results.success === true) {
                            Swal.fire("Done!", results.message, "success");
                            location.reload();
                        } else {
                            Swal.fire("Error!", results.message, "error");
                        }
                    }
                });

            } else {
                e.dismiss;
            }

        }, function (dismiss) {
            return false;
        })
    }
    </script>

@endsection