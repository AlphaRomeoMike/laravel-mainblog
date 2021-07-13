@extends('layouts.app')
@section('title', 'Create Post')

@section('content')
   
<div class="container">
   <div class="row justify-content-center">
       <div class="col-md-8">
           <div class="card mb-5">
              <div class="card-header lead">Create Post</div>
              <div class="card-body">
                 <form action="{{ route('create') }}" method="post">
                  @csrf
                     <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                     <div class="form-group">
                        <label for="title">Title</label>
                           @error('title')
                           <div class="text-danger">{{ $message }} *</div>
                           @enderror
                        <input type="text" name="title" id="title" class="form-control @error('description') is-invalid @enderror" placeholder="Enter your post title">
                        <small><b>Post title of your choice</b></small>
                        
                     </div>
                     <div class="form-group">
                        <label for="description">Description</label>
                           @error('description')
                           <div class="text-danger">{{ $message }} *</div>
                           @enderror
                        <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror" placeholder="Enter your post description">
                        <small><b>Post description of your choice</b></small>
                     </div>
                     <div class="row">
                        <button type="submit" name="submit" id="submit" class="btn btn-primary ml-3 mr-2"><i class="fas fa-envelope-open"></i> Create post</button>
                        <button type="reset" name="reset" id="reset" class="btn btn-danger mr-2"><i class="fas fa-trash"></i> Clear post</button>
                        <a href="{{ route('post') }}" class="btn btn-success"><i class="fas fa-th-list"></i> Back to index</a>
                     </div>
                  </form>
              </div>
           </div>
       </div>
   </div>
</div>

@endsection