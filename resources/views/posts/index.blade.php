@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                <div class="card-header lead" id="header">Posts</div>
                    <div class="card-body">
                        @if(count($data) != 0)
                            @foreach ($data as $key)
                                Post by <a href="#"><b>{{ $key->user->name }}</b></a> on {{ \Carbon\Carbon::parse($key->created_at)->diffForHumans() }}
                                <h3 class="pt-3 text-uppercase">{{ $key->title }}</h3>
                                <p>{{ $key->description }}</p>
                                <form action="" method="post" class="pb-3"><b>
                                    <a href="/{{ $key->id }}" class="text-dark mr-3">Edit</a>
                                    <a href="/{{ $key->id }}" class="text-danger">Delete</a></b>
                                </form>
                                <hr>
                            @endforeach
                            <div class="row justify-content-center">{{ $data->links() }}</div>
                        @else
                            <div class="lead">There are no posts</div>
                        @endif
                    </div>
                </div>
                <p class="row justify-content-center">Total posts count is &nbsp;<b> {{ count($data) }} posts</b></p>
            </div>
        </div>
    </div>
@endsection