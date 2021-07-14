@extends('layouts.app')

@section('title', 'User Posts')

@section('content')
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <div class="card border-dark">
               <div class="card-header border-dark lead">
                  {{ auth()->user()->name }}'s Posts
                  <a href="{{ route('create') }}" class="d-inline float-right btn bt-sm btn-primary"><i class="fas fa-plus"></i> Create post</a>
               </div>
               <div class="card-body">
                  @if($data->count() != 0)
                            @foreach ($data as $key)
                                Post by <a href="#"><b>{{ $key->user->name }}</b></a> on {{ \Carbon\Carbon::parse($key->created_at)->diffForHumans() }}
                                <h3 class="pt-3 text-uppercase">{{ $key->title }}</h3>
                                <p>{{ $key->description }}</p>
                                    @if($key->user_id == auth()->user()->id)
                                          <a href="{{ route('edit/{id}', $key->id) }}" class="text-dark mr-1">Edit</a>
                                          <button class="btn btn-link text-danger remove-user" data-id="{{ $key->id }}" data-action="{{ route('delete/{id}',$key->id) }}" onclick="deleteConfirmation({{$key->id}})"> Delete</button>
                                    @endif
                                <hr>
                            @endforeach
                            <div class="row justify-content-center">{{ $data->links() }}</div>
                        @else
                            <div class="text-danger text-center">There are no posts</div>
                            <hr>
                        @endif
                        <div class="row justify-content-center">Total posts count is &nbsp;<b> {{ count($data) }} posts</b></div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection