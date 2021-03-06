@extends('layouts.app')


@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <div>Username: <b>{{ auth()->user()->name }}</b></div>
                        <div>Email: <b>{{ auth()->user()->email }}</b></div><br>
                    <a href="{{ route('post') }}"><b>{{ __('You are logged in!') }}</b></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
